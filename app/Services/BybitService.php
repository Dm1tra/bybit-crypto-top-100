<?php

namespace App\Services;

use GuzzleHttp\Client;

class BybitService
{
    protected $client;
    protected $apiKey;
    protected $apiSecret;

    public function __construct()
    {
        $this->apiKey    = config('services.bybit.api_key');
        $this->apiSecret = config('services.bybit.api_secret');
        $baseUri         = config('services.bybit.base_url', 'https://api.bybit.com');

        $this->client = new Client([
            'base_uri' => $baseUri,
        ]);
    }

    /**
     * Получаем данные о криптовалютах с Bybit
     *
     * @param string $sortField Поле, по которому будем сортировать. 
     *                          Допустим, варианты: 'marketCap', 'volume24h' и пр.
     *                          Добавим 'popularity' (по 24-часовому объёму).
     * @return array
     */
    public function getTop100Cryptos($sortField = 'marketCap')
    {
        try {
            $response = $this->client->get('/v5/market/tickers', [
                'query' => [
                    'category' => 'spot',
                ]
            ]);

            $result = json_decode($response->getBody(), true);

            if (isset($result['result']['list']) && is_array($result['result']['list'])) {
                $allTickers = $result['result']['list'];

                $sortFieldMap = [
                    'marketCap'   => 'marketCap',
                    'popularity'  => 'turnover24h',
                ];

                $bybitField = $sortFieldMap[$sortField] ?? 'marketCap';

                usort($allTickers, function ($a, $b) use ($bybitField) {
                    $valA = isset($a[$bybitField]) ? (float)$a[$bybitField] : 0;
                    $valB = isset($b[$bybitField]) ? (float)$b[$bybitField] : 0;
                    return $valB <=> $valA;
                });

                $top100 = array_slice($allTickers, 0, 100);

                return $top100;
            }

            return [];
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return [];
        }
    }
}
