<?php

namespace App\Jobs;

use App\Models\SymbolData;
use App\Services\BitFinexApiService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class FetchSymbolData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    const DEFAULT_SYMBOL_ID = 1;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        Log::info('Fetching symbol data');
        try {
            $api = new BitFinexApiService();
            $symbolData = $api->getInstrumentData();
            // Fetch id of desired symbol. I commented this out as we're working with just 1 symbol
//            $symbol = Symbol::where('name', 'BTCUSD')->first();
//            $symbolData['symbol_id'] = $symbol->getAttribute('id');
            $symbolData['symbol_id'] = self::DEFAULT_SYMBOL_ID;
            $symbolDataRecord = new SymbolData();
            foreach ($symbolDataRecord->getFillable() as $column) {
                $symbolDataRecord->{$column} = $symbolData[$column];
            }
            $dataSaved = $symbolDataRecord->save();
            if ($dataSaved) {
                Log::info('Symbol data saved to DB');
            } else {
                Log::info('Symbol data could not be saved to DB');
            }
        } catch (GuzzleException $exception) {
            Log::error('Request for fetching symbol data failed. See debug log for details');
            Log::debug($exception);
        } catch (ModelNotFoundException $exception) {
            Log::error('Could not find symbol. See debug log for details');
            Log::debug($exception);
        } catch (\ErrorException $exception) {
            Log::error('Unknown error occurred. See debug log for details');
            Log::debug($exception);
        }
    }
}
