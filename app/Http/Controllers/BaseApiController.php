<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class BaseApiController extends Controller
{
    protected $service;

    /**
     * Get all records.
     *
     * @param Request $request
     * @return \Illuminate\View\View|array|null
     */
    public function index(Request $request)
    {
        $page = $request->query('page', 1); // Default to page 1
        $pageSize = $request->query('pageSize', 10); // Default to 10 items per page

        // Fetch data from the service
        $data = $this->service->getAll($this->getEndpoint(), $page, $pageSize);

        if ($data === null) {
            return ['error' => 'Failed to fetch data'];
        }

        // Return a view if the request expects HTML
        if ($request->wantsJson()) {
            return $data;
        }

        return view('vehicles.index', ['vehicles' => $data]);
    }

    /**
     * Get a specific record by ID.
     *
     * @param int $id
     * @return \Illuminate\View\View|array|null
     */
    public function show(int $id)
    {
        // Fetch data from the service
        $data = $this->service->getById($this->getEndpoint(), $id);

        if ($data === null) {
            return ['error' => 'Record not found'];
        }

        // Return a view if the request expects HTML
        if (request()->wantsJson()) {
            return $data;
        }

        return view('vehicles.show', ['vehicle' => $data]);
    }

    /**
     * Get the endpoint for the API requests.
     *
     * @return string
     */
    abstract protected function getEndpoint(): string;
}
