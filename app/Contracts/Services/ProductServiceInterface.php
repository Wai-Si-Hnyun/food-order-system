<?php

namespace App\Contracts\Services;

/**
 * Interface for Product service
 */
interface ProductServiceInterface
{
    /**
     * Get Product list
     * @return object
     */
    public function getProduct(string $page): object;

    /**
     * Save Product
     * 
     * @param array $data
     * @return void
     */
    public function createProduct(array $data): void;

    /**
     * Get Product by id
     * 
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
     * 
     * @param array $data
     * @param int $id
     * @return void
     */
    public function updateProduct(array $data, int $id): void;

    /**
     * Delete Product by id
     * 
     * @param int $id
     * @return void
     */
    public function deleteProductById(int $id): void;
}
