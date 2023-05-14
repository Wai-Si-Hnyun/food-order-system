<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;

class UserController extends Controller
{
    /**
     * home function
     */
    public function home()
    {
        $products = Product::get();
        dd($products->toArray());
        return view('user.main.home', compact('products'));
    }

}
