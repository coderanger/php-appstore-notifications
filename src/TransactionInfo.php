<?php
declare(strict_types=1);

namespace AppStoreNotifications;

class TransactionInfo {
    public string $transactionId;
    public string $originalTransactionId;
    public string $webOrderLineItemId;
    public string $bundleId;
    public string $productId;
    public string $subscriptionGroupIdentifier;
    public int $purchaseDate;
    public int $originalPurchaseDate;
    public int $expiresDate;
    public string $type;
    public string $inAppOwnershipType;
    public int $signedDate;
    public string $environment;

    public function __construct(object $payload) {
        $this->transactionId = $payload->transactionId ?? "";
        $this->originalTransactionId = $payload->originalTransactionId ?? "";
        $this->webOrderLineItemId = $payload->webOrderLineItemId ?? "";
        $this->bundleId = $payload->bundleId ?? "";
        $this->productId = $payload->productId ?? "";
        $this->subscriptionGroupIdentifier = $payload->subscriptionGroupIdentifier ?? "";
        $this->purchaseDate = $payload->purchaseDate ?? 0;
        $this->expiresDate = $payload->expiresDate ?? 0;
        $this->type = $payload->type ?? "";
        $this->inAppOwnershipType = $payload->inAppOwnershipType ?? "";
        $this->signedDate = $payload->signedDate ?? 0;
        $this->environment = $payload->environment ?? "";
    }
}
