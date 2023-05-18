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
            return Product::select('products.*', 'categories.name as category_name')
                ->when(request('key'), function ($query) {
                    $query->where('products.name', 'LIKE', '%' . request('key') . '%');
                })
                ->leftJoin('categories', 'products.category_id', 'categories.id')
                ->orderBy('products.created_at', 'desc')
                ->paginate(10)
                ->appends(request()->all());
        } elseif ($page == 'user') {
            return Product::when(request('key'), function ($query) {
                $query->where('products.name', 'LIKE', '%' . request('key') . '%');

            })
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
        Product::create($data);

    }

    /**
     * Get Product by id
     * @param int $id
     * @return object
     */
    public function getProductById($id): object
    {
        return Product::findOrFail($id);
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
        $product->update($data);

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
