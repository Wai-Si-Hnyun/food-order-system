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
    public function getProduct(): object
    {
        return Product::when(request('key'), function ($query) {
            $query->where('name', 'LIKE', '%' . request('key') . '%');
        })
            ->orderBy('created_at', 'asc')
            ->paginate(4)
            ->appends(request()->all());

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
