<?php

namespace App\Dao;

use App\Contracts\Dao\UserProductDaoInterface;
use App\Models\Product;

class UserProductDao implements UserProductDaoInterface
{
    /**
     * Get user list
     * @return object
     */
    public function getUsersProduct(): object
    {
        return Product::withCount('orderlists')
            ->orderBy('orderlists_count', 'desc')
            ->take(8)
            ->get();
    }

    /**
     * Get user by id
     * 
     * @param int $id
     * @return object
     */
    public function getUserProductById($id): object
    {
        return Product::where('category_id', $id)
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->get();
    }

}
