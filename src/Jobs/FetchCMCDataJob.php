<?php

namespace Insanetlabs\CryptoEvaluator\Jobs;

use Insanetlabs\CryptoEvaluator\Models\Coin;
use Insanetlabs\CryptoEvaluator\Models\CoinChange;
use Insanetlabs\CryptoEvaluator\Services\CoinMarketCapService;

class FetchCMCDataJob
{
    private $service;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(CoinMarketCapService $service)
    {
        $this->service = $service;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $coins = $this->service->getListings();
        foreach ($coins as $coin) {
            $dbCoin = Coin::where('remote_id', $coin->id)->firstOrNew();
            $dbCoin->name = $coin->name;
            $dbCoin->symbol = $coin->symbol;
            $dbCoin->remote_id = $coin->id;
            $dbCoin->save();

            $coinChange = new CoinChange();
            $coinChange->percent_change = $coin->quote->USD->percent_change_1h;
            $coinChange->price = $coin->quote->USD->price;
            $coinChange->positive = $coinChange->percent_change > 0;
            $dbCoin->coinChanges()->save($coinChange);
        }
    }
}