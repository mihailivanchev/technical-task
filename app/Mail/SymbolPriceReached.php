<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SymbolPriceReached extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var float
     */
    private float $symbolPrice;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($symbolPrice)
    {
        $this->symbolPrice = $symbolPrice;
    }

    /**
     * Get the message envelope.
     *
     * @return Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Symbol Price Reached',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return Content
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.symbolPriceReached',
            with: [
                'symbolPrice' => $this->symbolPrice,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments(): array
    {
        return [];
    }
}
