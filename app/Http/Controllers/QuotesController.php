<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\KanyeQuotesManager;

class QuotesController extends Controller
{
    protected $quotesManager;

    public function __construct(KanyeQuotesManager $quotesManager)
    {
        $this->middleware('api.token');
        $this->quotesManager = $quotesManager;
    }

    public function getRandomQuotes()
    {
        try {
            $quotes = $this->quotesManager->getRandomQuotes();
            return response()->json($quotes);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch quotes.'], 500);
        }
    }

    public function refreshQuotes()
    {
        try {
            $quotes = $this->quotesManager->refreshQuotes();
            return response()->json($quotes);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to refresh quotes.'], 500);
        }
    }
}