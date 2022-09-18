<?php
declare(strict_types=1);

namespace AppStoreNotifications;

// Struct for easy access to responseBodyV2DecodedPayload properties.
class Payload {
    public string $notificationType;
    public string $subtype;
    public string $notificationUUID;
    public string $notificationVersion;
    public string $appAppleId;
    public string $bundleId;
    public string $bundleVersion;
    public string $environment;
    public ?RenewalInfo $renewalInfo;
    public TransactionInfo $transactionInfo;

    public function __construct(array $payload, array $transactionInfo, ?array $renewalInfo) {
        $this->notificationType = $payload['notificationType'];
        $this->subtype = $payload['subtype'];
        $this->notificationUUID = $payload['notificationUUID'];
        $this->notificationVersion = $payload['notificationVersion'];
        $data = $payload['data'];
        $this->appAppleId = $data['appAppleId'];
        $this->bundleId = $data['bundleId'];
        $this->bundleVersion = $data['bundleVersion'];
        $this->environment = $data['environment'];
        if ($renewalInfo != null) {
            $this->renewalInfo = new RenewalInfo($renewalInfo);
        }
        $this->transactionInfo = new TransactionInfo($transactionInfo);
    }
}
