<?php

namespace App\Dao;

use App\Contracts\Dao\CategoryDaoInterface;
use App\Models\Category;

class CategoryDao implements CategoryDaoInterface
{
    /**
     * Get Category list
     * 
     * @param string $page
     * @return object
     */
    public function getCategory($page): object
    {
        if ($page == 'admin') {
            return Category::when(request('key'), function ($query) {
                $query->where('name', 'LIKE', '%' . request('key') . '%');
            })
                ->orderBy('created_at', 'asc')
                ->paginate(10)
                ->appends(request()->all());
        } elseif ($page == 'user') {
            return Category::all();
        }
        return Category::all();
    }

    /**
     * Save Category
     * @param array
     * @return void
     */
    public function createCategory(array $data): void
    {
        // Category::create($data);
        Category::create([
            'name' => $data['categoryName'],
        ]);

    }

    /**
     * Get Category by id
     * @param int $id
     * @return object
     */
    public function getCategoryById($id): object
    {
        return Category::findOrFail($id);
    }

    /**
     * Update Category
     * @param array $data
     * @param int $id
     * @return void
     */
    public function updateCategory(array $data, $id): void
    {

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $data['categoryName'],

        ]);

    }

    /**
     * Delete Category by id
     * @param int $id
     * @return void
     */
    public function deleteCategoryById($id): void
    {
        $category = Category::findOrFail($id);
        $category->delete();
    }
}
