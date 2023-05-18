<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
        /**
     * cart page
     *
     * @return \Illuminate\Contracts\View\View cart page
     */
    public function cart() {
        return view('user.main.cart');
    }

        /**
     * Save Item
     *
     * @param \App\Http\Requests\Request $request
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request,$id)
    {
        $product = Product::findOrFail($id);
        $item = session()->get('item',[]);
        if($request->quantity > 1) {
            $item[$id] = [
                "product_name" => $product->name,
                "photo" => $product->image,
                "price" => $product->price,
                "quantity"=> $request->quantity
            ];
        }
        else {
            if (isset($item[$id])) {
                $item[$id]['quantity']++;
            }
            else {
                $item[$id] = [
                    "id"=>$product->id,
                    "product_name" => $product->name,
                    "photo" => $product->image,
                    "price" => $product->price,
                    "quantity"=> $request->quantity
                ];
            }
        }


        session()->put('item',$item);
        return redirect()->route('show.cart');
    }

        /**
     * delete Item
     *
     * @param \App\Http\Requests\Request $request
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request)
    {
        if ($request->id) {
            $item = session()->get('item');
            if(isset($item[$request->id])) {
                unset($item[$request->id]);
                session()->put('item',$item);
            }
            return redirect()->back();
        }
    }
}
