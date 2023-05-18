<?php

namespace App\Http\Controllers;

use App\Contracts\Services\ProductServiceInterface;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $products = $this->productService->getProduct('admin');

        return view('admin.pages.product.index', compact('products'));
    }
    /**
     * create function
     *
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        return view('admin.pages.product.create', compact('categories'));
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
        $this->productService->createProduct($data);

        return redirect()->route('products.index')->with(['createSuccess' => 'Product created Successfully!']);
    }

    /**function details
     *
     */
    public function detail($id)
    {
        $product = $this->productService->getProductById($id);

        return view('admin.pages.product.details', compact('product'));
    }
  
    /**
     * function edit
     */
    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        $categories = Category::get();

        return view('admin.pages.product.edit', compact('product', 'categories'));
    }

    /**
     * update function
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'category' => 'required',
            'productName' => 'required',
            'productImage' => 'mimes:jpg,jpeg,png,webp|file',
            'productDescription' => 'required|min:10',
            'productPrice' => 'required',
        ])->validate();
        $data = [
            'category_id' => $request->category,
            'name' => $request->productName,
            'description' => $request->productDescription,
            'price' => $request->productPrice,
        ];
        if ($request->hasFile('productImage')) {
            $oldImageName = Product::where('id', $request->id)->first();
            $oldImageName = $oldImageName->image;
            if ($oldImageName != null) {
                Storage::delete('public/' . $oldImageName);
            }
            $fileName = uniqid() . $request->file('productImage')->getClientOriginalName();
            $request->file('productImage')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }
        $this->productService->updateProduct($data, $id);
        return redirect()->route('products.index')->with(['updateSuccess' => 'Product updated Successfully!']);

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
