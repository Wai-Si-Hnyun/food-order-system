<?php

namespace App\Contracts\Services;

/**
 * Interface for user service
 */
interface WishlistServiceInterface
{
    /**
     * Get user list
     * @return object
     */
    public function getWishlist(): object;

}
