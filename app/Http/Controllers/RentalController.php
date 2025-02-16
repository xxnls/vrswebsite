<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RentalApiService;
use Illuminate\Support\Facades\Session;

class RentalController extends BaseApiController
{
    public function __construct(RentalApiService $service)
    {
        $this->service = $service;
    }

    protected function getEndpoint(): string
    {
        return 'Rentals';
    }

    public function indexCustomerRentals()
    {
        $token = Session::get('token');

        if (!$token) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to view rental requests.']);
        }

        $customerId = Session::get('customer.id');

        // Fetch rental requests for the logged-in user
        $response = $this->service->getUserRentals($customerId);
        if ($response['success']) {
            $rentals = $response['data']['items'];
            return view('rentals.index', compact('rentals'));
        }

        return back()->withErrors(['error' => 'Failed to fetch rental requests. Please try again.']);
    }
}
