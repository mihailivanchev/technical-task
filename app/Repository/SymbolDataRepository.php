<?php

namespace App\Repository;

use App\Models\SymbolData;
use Illuminate\Support\Facades\Log;

class SymbolDataRepository
{
    const DEFAULT_SYMBOL_ID = 1;

    /**
     * @return array
     */
    public function getChartData(): array
    {
        $chartData = [];
        try {
            $symbolsData = SymbolData::all()->sortBy('timestamp');
            foreach ($symbolsData as $item) {
                $chartData[] = [
                    'timestamp' => $item->getAttribute('timestamp'),
                    'value' => $item->getAttribute('mid')
                ];
            }

        } catch (\Exception $exception) {
            Log::error($exception);
        }

        return $chartData;
    }

    public function saveSymbolData(array $symbolData): bool
    {
        // Fetch id of desired symbol. I commented this out as we're working with just 1 symbol
//            $symbol = Symbol::where('name', 'BTCUSD')->first();
//            $symbolData['symbol_id'] = $symbol->getAttribute('id');
        $symbolData['symbol_id'] = self::DEFAULT_SYMBOL_ID;
        $symbolDataRecord = new SymbolData();
        foreach ($symbolDataRecord->getFillable() as $column) {
            $symbolDataRecord->{$column} = $symbolData[$column];
        }

        return $symbolDataRecord->save();
    }
}
