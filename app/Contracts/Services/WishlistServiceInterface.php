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
     * @param integer $id
     * @return void
     */
    public function deleteWishlistById(int $id): void;

    /**
     * Delete wishlist by product id
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
