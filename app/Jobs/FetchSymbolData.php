<?php

namespace App\Jobs;

use App\Models\SymbolData;
use App\Repository\SymbolDataRepository;
use App\Services\BitFinexApiService;
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
            $dataSaved = (new SymbolDataRepository())->saveSymbolData($symbolData);

            if ($dataSaved) {
                Log::info('Symbol data saved to DB');
            } else {
                Log::info('Symbol data could not be saved to DB');
            }
        } catch (\Exception $exception) {
            Log::error('Unknown error occurred. See debug log for details');
            Log::debug($exception);
        }
    }
}
