<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Log;

class VehicleController extends Controller
{
    public function getVehicles()
    {
        $url = 'https://localhost:7230/api/Vehicles';
        $queryParams = [
            'page' => request('page', 1),
            'pageSize' => request('pageSize', 11),
        ];

        // Include the JWT token in the request headers
        $response = Http::withoutVerifying()
            ->withHeaders([
                'Authorization' => 'Bearer ' . $this->getJwtToken(),
            ])
            ->get($url, $queryParams);

            // Log the API response
            //Log::info('API Response:', $response->json());

        if ($response->successful()) {
            $vehicles = $response->json();
            return view('vehicles', ['vehicles' => $vehicles]);
        } else {
            return view('vehicles', ['error' => 'Failed to fetch data from the API']);
        }
    }

    private function getJwtToken()
    {
        // Retrieve JWT configuration
        $key = config('services.jwt.key');
        $issuer = config('services.jwt.issuer');
        $audience = config('services.jwt.audience');

        // Create the token payload
        $payload = [
            'iss' => $issuer, // Issuer
            'aud' => $audience, // Audience
            'iat' => time(), // Issued at
            'exp' => time() + 3600, // Expiration time (1 hour)
        ];

        // Generate the JWT token
        return JWT::encode($payload, $key, 'HS256');
    }
}
