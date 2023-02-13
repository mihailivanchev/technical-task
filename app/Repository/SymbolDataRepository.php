<?php

namespace App\Repository;

use App\Models\SymbolData;
use Illuminate\Support\Facades\Log;

class SymbolDataRepository
{
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
}
