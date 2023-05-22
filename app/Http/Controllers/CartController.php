<?php

namespace App\Http\Controllers;

use App\Contracts\Services\ProductServiceInterface;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    /**
     * cart page
     *
     * @return \Illuminate\Contracts\View\View cart page
     */
    public function cart()
    {
        return view('user.main.cart');
    }

    /**
     * Save Item
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addToCart(Request $request, $id)
    {
        $product = $this->productService->getProductById($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->quantity;
        } else {
            $cart[$id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => $request->quantity,
            ];
        }

        session(['cart' => $cart]);
        return response()->json(['success' => 'Product added to cart'], 200);
        // if($request->quantity > 1) {
        //     $cart[$id] = [
        //         "product_name" => $product->name,
        //         "photo" => $product->image,
        //         "price" => $product->price,
        //         "quantity"=> $request->quantity
        //     ];
        // }
        // else {
        //     if (isset($cart[$id])) {
        //         $cart[$id]['quantity']++;
        //     }
        //     else {
        //         $cart[$id] = [
        //             "id"=>$product->id,
        //             "product_name" => $product->name,
        //             "photo" => $product->image,
        //             "price" => $product->price,
        //             "quantity"=> $request->quantity
        //         ];
        //     }
        // }
    }

    /**
     * delete Item
     *
     * @param integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function remove(int $id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            // Remove the item from the cart
            unset($cart[$id]);

            // If there are no more items in the cart, remove the cart from the session
            if (empty($cart)) {
                session()->forget('cart');
            } else {
                // Otherwise, replace the cart in the session with the updated cart
                session()->put('cart', $cart);
            }
        }

        return response()->json(['success' => 'Product removed from cart'], 200);
    }

    public function clear()
    {
        session()->forget('cart');

        return response()->json(['success' => 'Cart cleared'], 200);
    }

    /**
     * update Item
     *
     * @param \App\Http\Requests\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateCart(Request $request,$id) {
        if($request->quantity) {
         $item = session()->get('item');
         $item[$id]['quantity'] = $request->quantity;
         session()->put('item',$item);
         return redirect()->back();
        }
     }
}
