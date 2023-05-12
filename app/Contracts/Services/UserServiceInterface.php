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
     * Save user
     * @param array $data
     * @return void
     */
    public function createUser(array $data): void;

    /**
     * Get user by id
     * @param int $id
     * @return object
     */
    public function getUserById(int $id): object;

    /**
     * Update User
     * @param array $data
     * @param int $id
     * @return void
     */
    public function updateUser(array $data, int $id): void;

    /**
     * Delete user by id
     * @param int $id
     * @return void
     */
    public function deleteUserById(int $id): void;
}