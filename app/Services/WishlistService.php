<?php

namespace App\Services;

use App\Contracts\Dao\WishlistDaoInterface;
use App\Contracts\Services\WishlistServiceInterface;

/**
 * User Service class
 */
class WishlistService implements WishlistServiceInterface
{
    /**
     * wishlist Dao
     */
    private $wishlistDao;

    /**
     * Class Constructor
     * @param WishlistDaoInterface
     * @return void
     */
    public function __construct(WishlistDaoInterface $wishlistDao)
    {
        $this->wishlistDao = $wishlistDao;
    }

    /**
     * Get user list
     * @return object
     */
    public function getWishlist(): object
    {
        return $this->wishlistDao->getWishlist();
    }

}
