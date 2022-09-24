<?php
declare(strict_types=1);

namespace AppStoreNotifications;

// TODO Via https://developer.apple.com/forums/thread/697721 a lot of these fields might actually be optional.

// Struct for easy access to responseBodyV2DecodedPayload properties.
class Payload {
    public string $notificationType;
    public string $subtype;
    public string $notificationUUID;
    public string $notificationVersion;
    public int $appAppleId;
    public string $bundleId;
    public string $bundleVersion;
    public string $environment;
    public ?RenewalInfo $renewalInfo;
    public TransactionInfo $transactionInfo;

    public function __construct(object $payload, object $transactionInfo, ?object $renewalInfo) {
        $this->notificationType = $payload->notificationType ?? "";
        $this->subtype = $payload->subtype ?? "";
        $this->notificationUUID = $payload->notificationUUID ?? "";
        $this->notificationVersion = $payload->notificationVersion ?? "";
        $data = $payload->data;
        $this->appAppleId = $data->appAppleId ?? 0;
        $this->bundleId = $data->bundleId ?? "";
        $this->bundleVersion = $data->bundleVersion ?? "";
        $this->environment = $data->environment ?? "";
        $this->renewalInfo = isset($renewalInfo) ? new RenewalInfo($renewalInfo) : null;
        $this->transactionInfo = new TransactionInfo($transactionInfo);
    }
}
