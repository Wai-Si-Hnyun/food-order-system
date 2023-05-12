<?php

namespace App\Dao;

use App\Contracts\Dao\UserDaoInterface;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class UserDao implements UserDaoInterface
{
    /**
     * Get user list
     * @return object
     */
    public function getUsers(): object
    {
        return Product::when(request('key'), function ($query) {
            $query->where('products.name', 'LIKE', '%' . request('key') . '%');

        })
            ->get();
        return Category::get();

    }

    /**
     * Get user by id
     * @param int $id
     * @return object
     */
    public function getUserById($id): object
    {
        return Product::where('category_id', $id)->orderBy('created_at', 'desc')->get();

    }

}
