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
     * 
     * @param integer $id
     * @return void
     */
    public function deleteWishlistById(int $id): void;

    /**
     * Delete wishlist by product id and user id
     *
     * @param integer $productId
     * @return void
     */
    public function deleteWishlistByProductId(int $productId): void;

    /**
     * Check wishlist
     *
     * @param integer $userId
     * @param integer $productId
     * @return boolean
     */
    public function checkWishlist(int $userId, int $productId): bool;
}
