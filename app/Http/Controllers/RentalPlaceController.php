<?php

namespace App\Http\Controllers;

use App\Services\RentalPlaceApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RentalPlaceController extends Controller
{
    protected $service;

    public function __construct(RentalPlaceApiService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of rental places.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch rental places from the API
        $response = $this->service->getRentalPlaces();

        if ($response['success']) {
            $rentalPlaces = $response['data'];
        } else {
            $rentalPlaces = [];
            Log::info('rentalplace', $rentalPlaces);
        }

        // Log info of rental places


        // Pass the rental places data to the view
        return view('contact', compact('rentalPlaces'));
    }
}
