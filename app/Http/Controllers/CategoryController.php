<?php

namespace App\Http\Controllers;

use App\Contracts\Services\CategoryServiceInterface;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    private $categoryService;
    /**
     * create a new controller instance
     * @param CategoryServiceInterFace $CategoryServiceInterface
     */

    public function __construct(CategoryServiceInterface $categoryServiceInterface)
    {
        $this->categoryService = $categoryServiceInterface;
    }
    /**
     * function index
     */
    public function index()
    {
        $categories = $this->categoryService->getCategory('admin');
        return view('admin.pages.category.index', compact('categories'));
    }
    /**
     * function category create
     */
    public function create()
    {
        return view('admin.pages.category.create');
    }

/**
 * Save Category
 *
 * @param \App\Http\Requests\CategoryCreateRequest $request
 * @return \Illuminate\Http\Response
 */
    public function store(CategoryCreateRequest $request)
    {
        $this->categoryService->createCategory($request->only([
            'categoryName',

        ]));

        return redirect()->route('categories.index')->with(['createSuccess' => 'Category created Successfully!']);

    }
    /**
     * edit function
     */
    public function edit($id)
    {
        $category = Category::where('id', $id)->first();
        return view('admin.pages.category.edit', compact('category'));
    }

    /**
     * Update user
     *
     * @param  \App\Http\Requests\CategoryUpdateRequest
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, $id)
    {
        $this->categoryService->updateCategory($request->only([
            'categoryName',

        ]), $id);

        return redirect()->route('categories.index')->with(['updateSuccess' => 'Category updated Successfully!']);

    }

    /**
     * delete category function
     */
    public function destroy($id)
    {
        $this->categoryService->deleteCategoryById($id);
        return redirect()->route('categories.index')->with(['deleteSuccess' => 'Category deleted Successfully!']);
    }

}