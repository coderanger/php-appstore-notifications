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

    public function __construct(object $payload) {
        $this->expirationIntent = $payload->expirationIntent ?? 0;
        $this->autoRenewProductId = $payload->autoRenewProductId ?? "";
        $this->productId = $payload->productId ?? "";
        $this->autoRenewStatus = $payload->autoRenewStatus ?? 0;
        $this->isInBillingRetryPeriod = $payload->isInBillingRetryPeriod ?? false;
        $this->signedDate = $payload->signedDate ?? 0;
        $this->environment = $payload->environment ?? "";
    }
}
