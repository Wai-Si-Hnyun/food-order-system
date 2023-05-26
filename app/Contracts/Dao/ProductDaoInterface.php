<?php

namespace App\Contracts\Dao;

/**
 * Interface of Data Access Object for Product
 */
interface ProductDaoInterface
{
    /**
     * Get Product list
     * @return object
     */
    public function getProduct($page): object;

    /**
     * Save Product
     * @param array
     * @return void
     */
    public function createProduct(array $data): void;

    /**
     * Get Product by id
     * @param int $id
     * @return object
     */
    public function getProductById(int $id): object;

    /**
     * Get related products
     *
     * @param integer $id
     * @return object
     */
    public function getRelatedProducts(int $id): object;

    /**
     * Update Product
     * @param array $data
     * @param int $id
     * @return void
     */
    public function updateProduct(array $data, int $id): void;

    /**
     * Delete Product by id
     * @param int $id
     * @return void
     */
    public function deleteProductById(int $id): void;
}
