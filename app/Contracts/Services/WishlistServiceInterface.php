<?php

namespace App\Contracts\Services;

/**
 * Interface for Wishlist service
 */
interface WishlistServiceInterface
{
    /**
     * Get Wishlist list
     * @return object
     */
    public function getWishlists(): object;

    /**
     * Save Wishlist
     * @param array $data
     * @return void
     */
    public function createWishlist(array $data): void;

    /**
     * Delete Wishlist by id
     * @param int $id
     * @return void
     */
    public function deleteWishlistById(int $id): void;
}
