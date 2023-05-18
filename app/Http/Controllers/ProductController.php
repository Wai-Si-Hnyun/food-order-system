<?php

namespace App\Http\Controllers;

use App\Contracts\Services\ProductServiceInterface;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

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
 * Save Product
 *
 * @param \App\Http\Requests\ProductCreateRequest $request
 * @return \Illuminate\Http\Response
 */
    public function store(ProductCreateRequest $request)
    {
        $this->productService->createProduct($request->only([
            'category',
            'productName',
            'productImage',
            'productDescription',
            'productPrice',
        ]));

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
     * Update user
     *
     * @param  \App\Http\Requests\ProductUpdateRequest
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $this->productService->updateProduct($request->only([
            'category',
            'productName',
            'productImage',
            'productDescription',
            'productPrice',
        ]), $id);

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
