<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class KanyeQuotesManager 
{
    protected $client;

    public function __construct(KanyeRestClient $client)
    {
        $this->client = $client;
    }

    public function getRandomQuotes()
    {
        return $this->getRandomQuotesFromCache();
    }

    private function getRandomQuotesFromCache()
    {
        return Cache::remember('kanye_quotes', 60, function () {
            $quotes = [];

            for ($i = 0; $i < 5; $i++) {
                $quotes[] = $this->client->getRandomQuote();
            }

            return $quotes;
        });
    }

    public function refreshQuotes()
    {
        Cache::forget('kanye_quotes');

        return $this->getRandomQuotesFromCache();
    }
}