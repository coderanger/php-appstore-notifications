<?php
declare(strict_types=1);

namespace AppStoreNotifications;

class RenewalInfo {
    public int $expirationIntent;
    public string $autoRenewProductId;
    public string $productId;
    public int $autoRenewStatus;
    public bool $isInBillingRetryPeriod;
    public int $signedDate;
    public string $environment;

    public function __construct(array $payload) {
        $this->notificationType = $payload['notificationType'];
        $this->autoRenewProductId = $payload['autoRenewProductId'];
        $this->productId = $payload['productId'];
        $this->autoRenewStatus = $payload['autoRenewStatus'];
        $this->isInBillingRetryPeriod = $payload['isInBillingRetryPeriod'];
        $this->signedDate = $payload['signedDate'];
        $this->environment = $payload['environment'];
    }
}
