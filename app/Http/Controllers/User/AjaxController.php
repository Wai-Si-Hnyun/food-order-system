<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;

class AjaxController extends Controller
{
    /**
     * index function
     */
    public function index()
    {
        $data = Product::get();
        return $data;
    }
}
