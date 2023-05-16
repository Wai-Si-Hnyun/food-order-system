<?php

namespace App\Contracts\Services;

interface LocationServiceInterface
{
    /**
     * Get all countries
     *
     * @return object
     */
    public function countries();

    /**
     * Get all states by country
     *
     * @param string $country
     * @return object
     */
    public function statesByCountry($country);

    /**
     * Get all cities by state
     *
     * @param string $state
     * @return object
     */
    public function citiesByState($state);
}