<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuotesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/quotes', [QuotesController::class, 'getRandomQuotes']);

Route::get('/quotes/refresh', [QuotesController::class, 'refreshQuotes']);