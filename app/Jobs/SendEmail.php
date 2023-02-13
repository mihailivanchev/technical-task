<?php

namespace App\Jobs;

use App\Mail\SymbolPriceReached;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Collection $emailData;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($emailData)
    {
        $this->emailData = $emailData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        foreach ($this->emailData as $emailData) {
            Log::debug('Queuing email message to address '. $emailData->email);
            Mail::to($emailData->email)
                ->queue(new SymbolPriceReached($emailData->symbol_price));
        }
    }
}
