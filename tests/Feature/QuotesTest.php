<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuotesTest extends TestCase
{
    /**
     * Test fetching random quotes.
     *
     * @return void
     */
    public function testGetRandomQuotes()
    {
        $response = $this->get('/api/quotes', [
            'Authorization' => 'my_anonymous_api_token',
        ]);

        $response->assertStatus(200)
            ->assertJsonCount(5);
    }

    /**
     * Test refreshing quotes.
     *
     * @return void
     */
    public function testRefreshQuotes()
    {
        // Get the initial set of quotes
        $initialResponse = $this->get('/api/quotes', [
            'Authorization' => 'my_anonymous_api_token',
        ]);

        $initialQuotes = json_decode($initialResponse->getContent());

        // Refresh the quotes
        $refreshResponse = $this->get('/api/quotes/refresh', [
            'Authorization' => 'my_anonymous_api_token',
        ]);

        $refreshResponse->assertStatus(200)
            ->assertJsonCount(5);
        
        $refreshedQuotes = json_decode($refreshResponse->getContent());

        // Ensure the refreshed quotes are different from the initial quotes
        $this->assertNotEquals($initialQuotes, $refreshedQuotes);
    }

    /**
     * Test API token validation.
     *
     * @return void
     */
    public function testApiTokenValidation()
    {
        $response = $this->get('/api/quotes', [
            'Authorization' => 'InvalidToken',
        ]);

        $response->assertStatus(401)
            ->assertJson(['error' => 'Invalid API token']);
    }
}
