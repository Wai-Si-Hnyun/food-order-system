<?php

namespace App\Dao;

use App\Contracts\Dao\WishlistDaoInterface;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistDao implements WishlistDaoInterface
{
    /**
     * Get Wishlist list
     * @return object
     */
    public function getWishlists(): object
    {

        return Wishlist::select('wishlists.*', 'products.name as product_name', 'products.image as product_image', 'products.price as product_price')
            ->leftJoin('products', 'products.id', 'wishlists.product_id')
            ->where('wishlists.user_id', Auth::user()->id)
            ->paginate(10)
            ->appends(request()->all());

    }

    /**
     * Save Wishlist
     * @param array
     * @return void
     */
    public function createWishlist(array $data): void
    {

    }

    /**
     * Delete Wishlist by id
     * @param int $id
     * @return void
     */
    public function deleteWishlistById($id): void
    {
        $Wishlist = Wishlist::findOrFail($id);
        $Wishlist->delete();
    }
}
