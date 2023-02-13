<?php

namespace App\Models;

use App\Jobs\SendEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SymbolData extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'symbol_id',
        'mid',
        'bid',
        'ask',
        'last_price',
        'low',
        'high',
        'volume',
        'timestamp',
    ];

    protected $casts = [
        'timestamp' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($record) {
            $matchingEmails = EmailNotification::where('symbol_price', '<=', $record->mid)->get();
            if ($matchingEmails->count() >= 1) {
                SendEmail::dispatch($matchingEmails);
            }
        });
    }
}
