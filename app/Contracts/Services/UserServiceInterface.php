<?php

namespace App\Contracts\Services;

/**
 * Interface for user service
 */
interface UserServiceInterface
{
    /**
     * Get user list
     * @return object
     */
    public function getUsers(): object;

    /**
     * Get user by id
     * @param int $id
     * @return object
     */
    public function getUserById(int $id): object;

}
