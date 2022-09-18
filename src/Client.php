<?php
declare(strict_types=1);

namespace AppStoreNotifications;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use phpseclib3\File\X509;

class Client {
    public static function decode(string $input): Payload {
        $payload = self::decodeInner($input);
        $transactionInfo = self::decodeInner($payload['data']['signedTransactionInfo']);
        $renewalInfo = $payload['data']['signedRenewalInfo'] != null ? self::decodeInner($payload['data']['signedRenewalInfo']) : null;
        return new Payload($payload, $transactionInfo, $renewalInfo);
    }

    public static function decodeInner(string $input): array {
        // Initial parsing of the responsebodyv2 struct.
        $responseBody = json_decode($input);
        if (!isset($responseBody['signedPayload'])) {
            throw new Error('No signedPayload in input');
        }
        // Manually parse the header of the payload JWS to find the signing key info.
        $header = self::parseHeader($responseBody['signedPayload']);
        if ($header['alg'] != 'ES256') {
            throw new Error('Unexpected signing algorithm '.$header['alg'].' used for payload');
        }
        $x5c = self::verifyCertChain($header['x5c']);
        // Use the first pubkey to check the signature. From here we can trust the decoding.
        return JWT::decode($responseBody['signedPayload'], new Key($x5c[0], 'ES256'));
    }

    public static function parseHeader(string $token): array {
        $segments = explode('.', $token);
        if (count($segments) != 3) {
            throw new Error('Wrong number of segments');
        }
        $header = JWT::jsonDecode(JWT::urlsafeB64Decode($segments[0]));
        if ($header === null) {
            throw new Error('Unable to decode header');
        }
        return $header;
    }

    public static function verifyCertChain(array $certs): array {
        // Sanity check the certs list.
        if ($certs === null || $certs === '' || count($certs) === 0) {
            throw new Error('x5c signing certificates are not present');
        }
        // Confirm the provided cert chain is trusted from the Apple G3 root.
        $x509 = new X509();
        $x509->loadCA(Constants::APPLE_G3_CERT);
        foreach ($certs as $cert) {
            $x509->loadX509($cert);
        }
        if (!$x509->validateSignature() || !x509->validateDate()) {
            throw new Error('Certificate chain is not valid');
        }
        return $certs;
    }
}
