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
        return Product::when(request('key'), function ($query) {
            $query->where('products.name', 'LIKE', '%' . request('key') . '%');

        })
            ->get();

    }

    /**
     * Get user by id
     * @param int $id
     * @return object
     */
    public function getUserProductById($id): object
    {
        return Product::where('category_id', $id)->orderBy('created_at', 'desc')->get();

    }

}
