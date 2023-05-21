<?php

namespace App\Http\Controllers;

use App\Contracts\Services\WishlistServiceInterface;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * wishlist interface
     */

    private $wishlistService;
    /**
     * Create a new controller instance.
     * @param WishlistServiceInterface $wishlistServiceInterface
     * @return void
     */
    public function __construct(WishlistServiceInterface $wishlistServiceInterface)
    {
        $this->wishlistService = $wishlistServiceInterface;
    }
    /**
     * function wishlist
     */
    public function addWishlist()
    {
        $products = $this->wishlistService->getWishlist();
        $wishlists = Wishlist::where('user_id', Auth::user()->id)->first();

        return view('user.main.wishlist', compact('products', 'wishlists'));
    }
}
