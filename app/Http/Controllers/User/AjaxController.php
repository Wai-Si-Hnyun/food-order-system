<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    /**
     * index function
     */
    public function index(Request $request)
    {
        if ($request->status == 'desc') {
            $data = Product::with('category')->orderBy('price', 'desc')
                ->get();

        } else {
            $data = Product::with('category')->orderBy('price', 'asc')
                ->get();

        }

        return $data;
    }
}