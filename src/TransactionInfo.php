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

    public function __construct(array $payload) {
        $this->transactionId = $payload['transactionId'];
        $this->originalTransactionId = $payload['originalTransactionId'];
        $this->webOrderLineItemId = $payload['webOrderLineItemId'];
        $this->bundleId = $payload['bundleId'];
        $this->productId = $payload['productId'];
        $this->subscriptionGroupIdentifier = $payload['subscriptionGroupIdentifier'];
        $this->purchaseDate = $payload['purchaseDate'];
        $this->expiresDate = $payload['expiresDate'];
        $this->type = $payload['type'];
        $this->inAppOwnershipType = $payload['inAppOwnershipType'];
        $this->signedDate = $payload['signedDate'];
        $this->environment = $payload['environment'];
    }
}
