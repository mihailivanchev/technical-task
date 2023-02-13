<?php

namespace Tests\Unit;

use App\Models\Symbol;
use App\Models\SymbolData;
use App\Repository\SymbolDataRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SymbolDataRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function testGetChartDataIsArray()
    {
        $repo = new SymbolDataRepository();

        $this->assertIsArray($repo->getChartData());
    }

    public function testGetChartDataHasProperStructure()
    {
        $repo = new SymbolDataRepository();
        Symbol::factory()->create();
        SymbolData::factory()->count(3)->create();
        $chartData = $repo->getChartData();

        $this->assertGreaterThanOrEqual(1, $chartData);
        foreach ($chartData as $record) {
            $this->assertArrayHasKey('timestamp', $record);
            $this->assertArrayHasKey('value', $record);
        }
    }
}
