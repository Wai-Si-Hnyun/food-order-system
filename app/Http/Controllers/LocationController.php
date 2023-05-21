<?php

namespace App\Http\Controllers;

use App\Contracts\Services\LocationServiceInterface;

class LocationController extends Controller
{
    /**
     * Location Dao
     */
    private $locationService;

    /**
     * Constructor for LocationController
     *
     * @param \App\Contracts\Services\LocationServiceInterface $locationDao
     */
    public function __construct(LocationServiceInterface $locationService)
    {
        $this->locationService = $locationService;
    }

    /**
     * Get all unique countries
     *
     * @return object
     */
    public function countries()
    {
        $countries = $this->locationService->countries();

        return $countries;
    }

    /**
     * Get all unique states by country
     *
     * @param string $country
     * @return \Illuminate\Http\JsonResponse
     */
    public function statesByCountry(string $country)
    {
        $states = $this->locationService->statesByCountry($country);

        return response()->json($states, 200);
    }

    /**
     * Get all unique cities by state
     *
     * @param string $state
     * @return \Illuminate\Http\JsonResponse
     */
    public function citiesByState(string $state)
    {
        $cities = $this->locationService->citiesByState($state);

        return response()->json($cities, 200);
    }
}
