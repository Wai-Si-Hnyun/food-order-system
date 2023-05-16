<?php

namespace App\Contracts\Dao;

/**
 * Interface of Data Access Object for user
 */
interface UserProductDaoInterface
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
