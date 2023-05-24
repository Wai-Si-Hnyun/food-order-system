<?php

namespace App\Http\Controllers;

use App\Contracts\Services\WishlistServiceInterface;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
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

        $products = Product::select('id', 'name', 'image', 'price')->get();
        $wishlists = $this->wishlistService->getWishlists();
        return view('user.main.wishlist', compact('wishlists', 'products'));

    }

    public function storeWishlist(Request $request)
    {
        $this->validate($request, array(
            'user_id' => 'required',
            'product_id' => 'required',
        ));

        $status = Wishlist::where('user_id', Auth::user()->id)
            ->where('product_id', $request->product_id)
            ->first();

        if (isset($status->user_id) and isset($request->product_id)) {
            return redirect()->back();
        } else {
            $wishlist = new Wishlist;

            $wishlist->user_id = $request->user_id;
            $wishlist->product_id = $request->product_id;
            $wishlist->save();

            return redirect()->back();
        }

        return redirect()->route('product.details');
    }

    public function destroyWishlist($id)
    {
        $this->wishlistService->deleteWishlistById($id);
        return redirect()->route('products.wishlist');
    }
}
