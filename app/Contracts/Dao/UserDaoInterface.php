<?php

namespace App\Contracts\Dao;

/**
 * Interface of Data Access Object for user
 */
interface UserDaoInterface
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
