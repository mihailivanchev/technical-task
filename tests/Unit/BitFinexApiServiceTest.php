<?php

namespace Tests\Unit;

use App\Services\BitFinexApiService;
use PHPUnit\Framework\TestCase;

class BitFinexApiServiceTest extends TestCase
{
    public function testGetResponse()
    {
        $apiService = new BitFinexApiService();

        $response = $apiService->getResponse();

        $this->assertSame(200, $response->getStatusCode());
    }

    public function testGetInstrumentData()
    {
        $apiService = new BitFinexApiService();
        $instrumentData = $apiService->getInstrumentData();
        $this->assertIsArray($instrumentData);
        $this->assertGreaterThanOrEqual(1, count($instrumentData));
        $this->assertIsArray($instrumentData);

        $this->assertArrayHasKey('mid', $instrumentData);
        $this->assertArrayHasKey('bid', $instrumentData);
        $this->assertArrayHasKey('ask', $instrumentData);
        $this->assertArrayHasKey('last_price', $instrumentData);
        $this->assertArrayHasKey('low', $instrumentData);
        $this->assertArrayHasKey('high', $instrumentData);
        $this->assertArrayHasKey('volume', $instrumentData);
        $this->assertArrayHasKey('timestamp', $instrumentData);
    }
}
