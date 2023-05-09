<?php

namespace App\Http\Controllers;

use App\Contracts\Services\ProductServiceInterface;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    private $productService;
    /**
     * create a new controller instance
     * @param ProductServiceInterFace $ProductServiceInterface
     */

    public function __construct(ProductServiceInterface $productServiceInterface)
    {
        $this->productService = $productServiceInterface;
    }

    /**
     * product index function
     */
    public function index()
    {
        $products = $this->productService->getProduct();
        return view('admin.product.index', compact('products'));
    }
    /**
     * create function
     *
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        return view('admin.product.create', compact('categories'));
    }
    /**
     * function store
     *
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'category' => 'required',
            'productName' => 'required|min:5|unique:products,name',
            'productImage' => 'required|mimes:jpg,jpeg,png,webp|file',
            'productDescription' => 'required|min:10',
            'productPrice' => 'required',
        ])->validate();
        $data = [
            'category_id' => $request->category,
            'name' => $request->productName,
            'description' => $request->productDescription,
            'price' => $request->productPrice,
        ];

        $fileName = uniqid() . $request->file('productImage')->getClientOriginalName();
        $request->file('productImage')->storeAs('public', $fileName);
        $data['image'] = $fileName;
        $this->productService->createProduct($data, $request);
        return redirect()->route('products.index')->with(['createSuccess' => 'Product created Successfully!']);
    }
/**
 * function edit
 */
    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        return view('admin.product.edit', compact('product'));
    }
    /**function details
     *
     */
    public function detail($id)
    {
        $product = Product::where('id', $id)->first();
        return view('admin.product.details', compact('product'));
    }
    /***
     * function delete
     */
    public function destroy($id)
    {
        $this->productService->deleteProductById($id);
        return redirect()->route('products.index')->with(['deleteSuccess' => 'Product delete successfully!']);
    }
}
