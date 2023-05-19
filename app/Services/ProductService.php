<?php

namespace App\Services;

use App\Contracts\Dao\ProductDaoInterface;
use App\Contracts\Services\ProductServiceInterface;

/**
 * Product Service class
 */
class ProductService implements ProductServiceInterface
{
    /**
     * Product Dao
     */
    private $productDao;

    /**
     * Class Constructor
     * @param ProductDaoInterface
     * @return void
     */
    public function __construct(ProductDaoInterface $productDao)
    {
        $this->productDao = $productDao;
    }

    /**
     * Get Product list
     * @return object
     */
    public function getProduct(string $page): object
    {
        return $this->productDao->getProduct($page);
    }

    /**
     * Save Product
     * @param array
     * @return void
     */
    public function createProduct(array $data): void
    {
        //store image
        $image = $data["productImage"];
        $fileName = uniqid() . $image->getClientOriginalName();
        $image->storeAs('public', $fileName);
        $data['productImage'] = $fileName;
        $this->productDao->createProduct($data);
    }

    /**
     * Get Product by id
     * @param int $id
     * @return object
     */
    public function getProductById(int $id): object
    {
        return $this->productDao->getProductById($id);
    }

    /**
     * Update Product
     * @param array $data
     * @param int $id
     * @return void
     */
    public function updateProduct(array $data, int $id): void
    {
        //store image
        $image = $data["productImage"];
        $fileName = uniqid() . $image->getClientOriginalName();
        $image->storeAs('public', $fileName);
        $data['productImage'] = $fileName;
        $this->productDao->updateProduct($data, $id);
    }

    /**
     * Delete Product by id
     * @param int $id
     * @return void
     */
    public function deleteProductById(int $id): void
    {
        $this->productDao->deleteProductById($id);
    }
}

    /**
     * Delete Product by id
     * @param int $id
     * @return void
     */
    public function deleteProductById(int $id): void
    {
        $this->productDao->deleteProductById($id);
    }
}