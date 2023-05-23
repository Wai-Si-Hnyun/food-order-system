<?php

namespace App\Services;

use App\Contracts\Dao\WishlistDaoInterface;
use App\Contracts\Services\WishlistServiceInterface;

/**
 * Wishlist Service class
 */
class WishlistService implements WishlistServiceInterface
{
    /**
     * Wishlist Dao
     */
    private $WishlistDao;

    /**
     * Class Constructor
     * @param WishlistDaoInterface
     * @return void
     */
    public function __construct(WishlistDaoInterface $WishlistDao)
    {
        $this->WishlistDao = $WishlistDao;
    }

    /**
     * Get Wishlist list
     * @return object
     */
    public function getWishlists(): object
    {
        return $this->WishlistDao->getWishlists();
    }

    /**
     * Save Wishlist
     * @param array
     * @return void
     */
    public function createWishlist(array $data): void
    {

        $this->WishlistDao->createWishlist($data);
    }

    /**
     * Delete Wishlist by id
     * @param int $id
     * @return void
     */
    public function deleteWishlistById(int $id): void
    {
        $this->WishlistDao->deleteWishlistById($id);
    }
}
