<?php

namespace App\Services;

use App\Contracts\Dao\UserProductDaoInterface;
use App\Contracts\Services\UserProductServiceInterface;

/**
 * User Service class
 */
class UserProductService implements UserProductServiceInterface
{
    /**
     * user Dao
     */
    private $userProductDao;

    /**
     * Class Constructor
     * @param UserProductDaoInterface
     * @return void
     */
    public function __construct(UserProductDaoInterface $userProductDao)
    {
        $this->userProductDao = $userProductDao;
    }

    /**
     * Get user list
     * @return object
     */
    public function getUsersProduct(): object
    {
        return $this->userProductDao->getUsersProduct();
    }

    /**
     * Get user by id
     * @param int $id
     * @return object
     */
    public function getUserProductById(int $id): object
    {
        return $this->userProductDao->getUserProductById($id);
    }

}