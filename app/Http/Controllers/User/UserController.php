<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class UserController extends Controller
{
    /**
     * home function
     */
    public function home()
    {
        $products = Product::when(request('key'), function ($query) {
            $query->where('products.name', 'LIKE', '%' . request('key') . '%');

        })
            ->get();
        return view('user.main.home', compact('products'));
    }
    /**
     * shop function
     */
    public function shop()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        $categories = Category::get();
        return view('user.main.shop', compact('products', 'categories'));
    }
}
