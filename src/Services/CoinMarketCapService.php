<?php

namespace Insanetlabs\CryptoEvaluator\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class CoinMarketCapService
{
    private $endpointUrl = 'https://pro-api.coinmarketcap.com/v1/';


    public function getListings()
    {
        return Http::withHeaders([
            'X-CMC_PRO_API_KEY' => env('CMC_API_KEY'),
            'Accept' => 'application/json',
            'Accept-Encoding' => 'deflate, gzip'
        ])->get("{$this->endpointUrl}cryptocurrency/listings/latest")->object()->data;
    }
}
