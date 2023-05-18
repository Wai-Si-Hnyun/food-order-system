<?php

namespace App\Dao;

use App\Contracts\Dao\WishlistDaoInterface;
use App\Models\Product;

class WishlistDao implements WishlistDaoInterface
{
    /**
     * Get user list
     * @return object
     */
    public function getWishlist(): object
    {
        return Product::get();

    }

}
