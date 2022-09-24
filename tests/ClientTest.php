<?php

declare(strict_types=1);

namespace AppStoreNotifications\Tests;

use PHPUnit\Framework\TestCase;
use AppStoreNotifications\Client;

final class ClientTest extends TestCase {
    public function testDecode(): void
    {
        $input = file_get_contents(__DIR__ . "/example.json");
        $decoded = Client::decode($input);
        $this->assertEquals($decoded->notificationType, 'CONSUMPTION_REQUEST');
        $this->assertEquals($decoded->subtype, "");
        $this->assertEquals($decoded->notificationUUID, "40caeaab-e6a2-47aa-9813-b9338d5e73f8");
        $this->assertEquals($decoded->bundleId, "com.firestream.Farm-RPG");
        $this->assertEquals($decoded->bundleVersion, "7");
        $this->assertEquals($decoded->environment, "Production");
        $this->assertEquals($decoded->renewalInfo, null);
        $this->assertEquals($decoded->transactionInfo->transactionId, "330001192637554");
        $this->assertEquals($decoded->transactionInfo->purchaseDate, 1663540370000);
    }

}
