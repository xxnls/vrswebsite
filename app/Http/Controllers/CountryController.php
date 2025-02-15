<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CountryApiService;

class CountryController extends BaseApiController
{
    public function __construct(CountryApiService $service)
    {
        $this->service = $service;
    }

    protected function getEndpoint(): string
    {
        return 'Vehicles';
    }
}
