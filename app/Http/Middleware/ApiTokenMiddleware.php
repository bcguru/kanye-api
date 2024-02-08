<?php

namespace App\Http\Middleware;

use Closure;

class ApiTokenMiddleware
{
    public function handle($request, Closure $next)
    {
        $apiToken = $request->header('Authorization');
        $validToken = 'my_anonymous_api_token';

        if (!$this->validateApiToken($apiToken, $validToken)) {
            return response()->json(['error' => 'Invalid API token'], 401);
        }

        return $next($request);
    }

    private function validateApiToken($apiToken, $validToken)
    {
        // Return true if the token is valid, or false otherwise
        return hash_equals($validToken, (string) $apiToken);
    }
}