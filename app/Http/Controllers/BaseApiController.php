<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class BaseApiController extends Controller
{
    protected $service;

    /**
     * Get all records with pagination.
     *
     * @param Request $request
     * @return array|null
     */
    // public function index(Request $request): ?array
    // {
    //     $page = $request->query('page', 1); // Default to page 1
    //     $pageSize = $request->query('pageSize', 10); // Default to 10 items per page

    //     $data = $this->service->getAllVehicles($this->getEndpoint(), $page, $pageSize);

    //     if ($data === null) {
    //         return ['error' => 'Failed to fetch data'];
    //     }

    //     return $data;
    // }

    /**
     * Get a specific record by ID.
     *
     * @param int $id
     * @return array|null
     */
    public function show(int $id): ?array
    {
        $data = $this->service->getVehicleById($this->getEndpoint(), $id);

        if ($data === null) {
            return ['error' => 'Record not found'];
        }

        return $data;
    }

    /**
     * Get the endpoint for the API requests.
     *
     * @return string
     */
    abstract protected function getEndpoint(): string;
}
