<?php

namespace App\Contracts\Services;

/**
 * Interface for user service
 */
interface UserProductServiceInterface
{
    /**
     * Get user list
     * @return object
     */
    public function getUsersProduct(): object;

    /**
     * Get user by id
     * @param int $id
     * @return object
     */
    public function getUserProductById(int $id): object;

}