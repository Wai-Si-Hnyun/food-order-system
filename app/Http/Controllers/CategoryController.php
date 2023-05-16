<?php

namespace App\Http\Controllers;

use App\Contracts\Services\CategoryServiceInterface;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $categories = $this->categoryService->getCategory();
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
     * function store category
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'categoryName' => 'required|max:10|unique:categories,name',
        ], [
            'categoryName.required' => 'Category Name field is required!',
        ])->validate();
        $data = [
            'name' => $request->categoryName,
        ];

        $this->categoryService->createCategory($data, $request);

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
     * update function
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'categoryName' => 'required|max:10|unique:categories,name',
        ], [
            'categoryName.required' => 'Category name Field is required!',
        ])->validate();
        $data = [
            'name' => $request->categoryName,
        ];
        $this->categoryService->updateCategory($data, $id);
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
