<?php

namespace App\Dao;

use App\Contracts\Dao\ProductDaoInterface;
use App\Models\Product;

class ProductDao implements ProductDaoInterface
{
    /**
     * Get Product list
     * @return object
     */
    public function getProduct($page): object
    {
        if ($page == 'admin') {
            return Product::with('category')
                ->when(request('key'), function ($query) {
                    $query->where('products.name', 'LIKE', '%' . request('key') . '%')
                        ->orWhereHas('category', function ($q) {
                            $q->where('name', 'LIKE', '%' . request('key') . '%');
                        })
                        ->orWhere('products.price', 'LIKE', '%' . request('key') . '%')
                        ->orWhere('products.description', 'LIKE', '%' . request('key') . '%');
                })
                ->orderBy('products.created_at', 'desc')
                ->paginate(10)
                ->appends(request()->all());
        } elseif ($page == 'user') {
            return Product::when(request('key'), function ($query) {
                $query->where('products.name', 'LIKE', '%' . request('key') . '%')
                    ->orWhere('categories.name', 'LIKE', '%' . request('key') . '%')
                    ->orwhere('products.price', 'LIKE', '%' . request('key') . '%')
                    ->orWhere('products.description', 'LIKE', '%' . request('key') . '%');
            })
                ->with('category')
                ->orderBy('products.created_at', 'desc')
                ->get();
        }
        return Product::all();
    }

    /**
     * Save Product
     * @param array
     * @return void
     */
    public function createProduct(array $data): void
    {
        Product::create([
            'category_id' => $data['category'],
            'name' => $data['productName'],
            'image' => $data['productImage'],
            'description' => $data['productDescription'],
            'price' => $data['productPrice'],
        ]);

    }

    /**
     * Get Product by id
     * @param int $id
     * @return object
     */
    public function getProductById(int $id): object
    {
        return Product::findOrFail($id)->load('category');
    }

    public function getRelatedProducts(int $id): object
    {
        $product = Product::findOrFail($id);
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $id)
            ->with('category')
            ->get();

        return $relatedProducts;
    }

    /**
     * Update Product
     * @param array $data
     * @param int $id
     * @return void
     */
    public function updateProduct(array $data, $id): void
    {

        $product = Product::findOrFail($id);
        if (array_key_exists('productImage', $data)) {
            $product->update([
                'category_id' => $data['category'],
                'name' => $data['productName'],
                'image' => $data['productImage'],
                'description' => $data['productDescription'],
                'price' => $data['productPrice'],
            ]);
        } else {
            $product->update([
                'category_id' => $data['category'],
                'name' => $data['productName'],
                'description' => $data['productDescription'],
                'price' => $data['productPrice'],
            ]);
        }
    }

    /**
     * Delete Product by id
     * @param int $id
     * @return void
     */
    public function deleteProductById($id): void
    {
        $product = Product::findOrFail($id);
        $product->delete();
    }
}
