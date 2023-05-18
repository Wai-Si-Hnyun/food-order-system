<?php

namespace App\Dao;

use App\Contracts\Dao\LocationDaoInterface;
use App\Models\Location;

class LocationDao implements LocationDaoInterface
{
    /**
     * Get all unique countries
     *
     * @return object
     */
    public function countries()
    {
        return Location::distinct('country')->pluck('country');
    }

    /**
     * Get all unique states by country
     *
     * @param string $country
     * @return object
     */
    public function statesByCountry(string $country)
    {
        return Location::where('country', $country)->distinct('state')->pluck('state');
    }

    /**
     * Get all unique cities by state
     *
     * @param string $state
     * @return object
     */
    public function citiesByState(string $state)
    {
        return Location::where('state', $state)->distinct('city')->pluck('city');
    }
}