<?php

namespace App\Http\Controllers;

use App\Contracts\Services\WishlistServiceInterface;
use App\Models\Wishlist;
use Google\Service\Docs\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * wishlist interface
     */

    // private $wishlistService;
    /**
     * Create a new controller instance.
     * @param WishlistServiceInterface $wishlistServiceInterface
     * @return void
     */
    // public function __construct(WishlistServiceInterface $wishlistServiceInterface)
    // {
    //     $this->wishlistService = $wishlistServiceInterface;
    // }
    /**
     * function wishlist
     */
    public function addWishlist()
    {

        $wishlists = Wishlist::select('wishlists.*', 'products.name as product_name', 'products.image as product_image', 'products.price as product_price')
            ->leftJoin('products', 'products.id', 'wishlists.product_id')
            ->where('wishlists.user_id', Auth::user()->id)
            ->get();
        dd($wishlists->toArray());
        return view('user.main.wishlist', compact('wishlists'));
    }

    public function storeWishlist(Request $request)
    {
        dd($request);
    }
    public function destroyWishlist($id)
    {
        dd($id);
    }
}
