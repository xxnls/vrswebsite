<?php

namespace App\Services;

class VehicleApiService extends BaseApiService
{
    /**
     * Fetch all vehicles from the ASP.NET Core API with pagination.
     *
     * @param string $endpoint
     * @param int $page
     * @param int $pageSize
     * @return array|null
     */
    public function getAllVehicles(string $endpoint, int $page, int $pageSize): ?array
    {
        return $this->getAll($endpoint, [
            'page' => $page,
            'pageSize' => $pageSize,
        ]);
    }

    /**
     * Fetch a specific vehicle by ID from the ASP.NET Core API.
     *
     * @param string $endpoint
     * @param int $id
     * @return array|null
     */
    public function getVehicleById(string $endpoint, int $id): ?array
    {
        return $this->getAll("{$endpoint}/{$id}");
    }
}
