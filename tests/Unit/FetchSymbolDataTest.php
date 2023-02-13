<?php

namespace Tests\Unit;

use App\Repository\SymbolDataRepository;
use App\Services\BitFinexApiService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class FetchSymbolDataTest extends TestCase
{
    use RefreshDatabase;
    public function testFetchSymbolData()
    {
        $api = new BitFinexApiService();
        $symbolData = $api->getInstrumentData();
        $symbolDataRepo = new SymbolDataRepository();

        $this->assertTrue($symbolDataRepo->saveSymbolData($symbolData));
    }
}
