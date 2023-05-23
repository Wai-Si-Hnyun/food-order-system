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
    public function getWishlists(): object;

    /**
     * Save Wishlist
     * @param array
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
