<?php

namespace Tests\Unit;

use App\Http\Middleware\ApiTokenMiddleware;
use App\Http\Controllers\QuotesController;
use App\Services\KanyeQuotesManager;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;
use Illuminate\Testing\TestResponse;
use Faker\Factory;
use Mockery;

class QuotesTest extends TestCase
{
    /**
     * Test fetching random quotes.
     *
     * @return void
     */
    public function testGetRandomQuotes()
    {
        $faker = Factory::create();
        $quotes = [
            $faker->sentence,
            $faker->sentence,
            $faker->sentence,
            $faker->sentence,
            $faker->sentence,
        ];

        // Mock the KanyeQuotesManager and its getRandomQuotes method
        $quotesManagerMock = $this->createMock(KanyeQuotesManager::class);
        $quotesManagerMock->expects($this->once())
            ->method('getRandomQuotes')
            ->willReturn($quotes);

        // Create a new QuotesController instance
        $quotesController = new QuotesController($quotesManagerMock);

        // Call the getRandomQuotes method
        $response = $quotesController->getRandomQuotes();

        // Assertions
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($quotes, $response->getData(true));
    }
    
    /**
     * Test refreshing quotes.
     *
     * @return void
     */
    public function testRefreshQuotes()
    {
        $faker = Factory::create();
        $quotes = [
            $faker->sentence,
            $faker->sentence,
            $faker->sentence,
            $faker->sentence,
            $faker->sentence,
        ];

        // Mock the KanyeQuotesManager and its getRandomQuotes method
        $quotesManagerMock = $this->createMock(KanyeQuotesManager::class);
        $quotesManagerMock->expects($this->once())
            ->method('refreshQuotes')
            ->willReturn($quotes);
            
        // Create a new QuotesController instance
        $quotesController = new QuotesController($quotesManagerMock);

        $initialResponse = $quotesController->getRandomQuotes();
        // Call the refreshQuotes method
        $refreshResponse = $quotesController->refreshQuotes();


        // Assertions
        $this->assertInstanceOf(JsonResponse::class, $refreshResponse);
        $this->assertEquals(200, $refreshResponse->getStatusCode());
        $this->assertEquals($quotes, $refreshResponse->getData(true));

        // Ensure the refreshed quotes are different from the initial quotes
        $this->assertNotEquals($refreshResponse->getData(true), $initialResponse->getData(true));
    }

    /**
     * Test API token validation.
     *
     * @return void
     */
    public function testApiTokenValidation()
    {
        // Create a new ApiTokenMiddleware instance
        $middleware = new ApiTokenMiddleware();

        // Mock the Request object with an invalid API token
        $request = $this->createMock(Request::class);
        $request->expects($this->once())
            ->method('header')
            ->with('Authorization')
            ->willReturn('InvalidToken');

        // Create a new TestResponse instance with the mocked request
        $response = TestResponse::fromBaseResponse($middleware->handle($request, function () {}));

        // Assertions
        $response->assertStatus(401)
            ->assertJson(['error' => 'Invalid API token']);
    }
}