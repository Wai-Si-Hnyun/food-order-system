<?php

namespace App\Services;

use App\Contracts\Dao\LocationDaoInterface;
use App\Contracts\Services\LocationServiceInterface;

class LocationService implements LocationServiceInterface
{
    private $locationDao;

    /**
     * Constructor for LocationService
     *
     * @param LocationDaoInterface $locationDao
     */
    public function __construct(LocationDaoInterface $locationDao)
    {
        $this->locationDao = $locationDao;
    }

    /**
     * Get all countries
     *
     * @return object
     */
    public function countries()
    {
        return $this->locationDao->countries();
    }

    /**
     * Get all states by country
     *
     * @param string $country
     * @return object
     */
    public function statesByCountry($country)
    {
        return $this->locationDao->statesByCountry($country);
    }

    /**
     * Get all cities by state
     *
     * @param string $state
     * @return object
     */
    public function citiesByState($state)
    {
        return $this->locationDao->citiesByState($state);
    }
}