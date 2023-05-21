<?php

namespace App\Contracts\Dao;

/**
 * Interface of Data Access Object for Wishlist
 */
interface WishlistDaoInterface
{
    /**
     * Get Wishlist list
     * @return object
     */
    public function getWishlist(): object;

}