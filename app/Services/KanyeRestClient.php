<?php

namespace App\Services;

use GuzzleHttp\Client;

class KanyeRestClient
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.kanye.rest/',
        ]);
    }

    public function getRandomQuote()
    {
        $response = $this->client->get('');

        $data = json_decode($response->getBody(), true);

        return $data['quote'] ?? null;
    }
}