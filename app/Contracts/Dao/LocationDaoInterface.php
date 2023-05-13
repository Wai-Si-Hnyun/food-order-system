<?php

namespace App\Contracts\Dao;

interface LocationDaoInterface
{
    /**
     * Get all unique countries
     *
     * @return object
     */
    public function countries();

    /**
     * Get all unique states by country
     *
     * @param string $country
     * @return object
     */
    public function statesByCountry(string $country);

    /**
     * Get all unique cities by state
     *
     * @param string $state
     * @return object
     */
    public function citiesByState(string $state);
}