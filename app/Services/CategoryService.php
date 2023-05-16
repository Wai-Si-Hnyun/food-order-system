<?php

namespace App\Services;

use App\Contracts\Dao\CategoryDaoInterface;
use App\Contracts\Services\CategoryServiceInterface;

/**
 * Category Service class
 */
class CategoryService implements CategoryServiceInterface
{
    /**
     * Category Dao
     */
    private $categoryDao;

    /**
     * Class Constructor
     * @param CategoryDaoInterface
     * @return void
     */
    public function __construct(CategoryDaoInterface $categoryDao)
    {
        $this->categoryDao = $categoryDao;
    }

    /**
     * Get Category list
     * @return object
     */
    public function getCategory(): object
    {
        return $this->categoryDao->getCategory();
    }

    /**
     * Save Category
     * @param array
     * @return void
     */
    public function createCategory(array $data): void
    {
        // Mail Send Code
        $this->categoryDao->createCategory($data);
    }

    /**
     * Get Category by id
     * @param int $id
     * @return object
     */
    public function getCategoryById(int $id): object
    {
        return $this->categoryDao->getCategoryById($id);
    }

    /**
     * Update Category
     * @param array $data
     * @param int $id
     * @return void
     */
    public function updateCategory(array $data, int $id): void
    {
        $this->categoryDao->updateCategory($data, $id);
    }

    /**
     * Delete Category by id
     * @param int $id
     * @return void
     */
    public function deleteCategoryById(int $id): void
    {
        $this->categoryDao->deleteCategoryById($id);
    }
}
