<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\ResponseInterface;

class BitFinexApiService
{
    private Client $client;

    const BASE_URL = 'https://api.bitfinex.com/v1';

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getResponse(): ResponseInterface
    {
        return $this->client->get(self::BASE_URL . '/pubticker/btcusd');
    }

    /**
     * @return array
     */
    public function getInstrumentData(): array
    {
        try {
            $response = $this->getResponse();

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $exception) {
            Log::error('Request for fetching symbol data failed. See debug log for details');
            Log::debug($exception);

            return [];
        }
    }
}
