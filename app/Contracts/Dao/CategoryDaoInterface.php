<?php

namespace App\Contracts\Dao;

/**
 * Interface of Data Access Object for Category
 */
interface CategoryDaoInterface
{
    /**
     * Get Category list
     * @return object
     */
    public function getCategory(): object;

    /**
     * Save Category
     * @param array
     * @return void
     */
    public function createCategory(array $data): void;

    /**
     * Get Category by id
     * @param int $id
     * @return object
     */
    public function getCategoryById(int $id): object;

    /**
     * Update Category
     * @param array $data
     * @param int $id
     * @return void
     */
    public function updateCategory(array $data, int $id): void;

    /**
     * Delete Category by id
     * @param int $id
     * @return void
     */
    public function deleteCategoryById(int $id): void;
}
