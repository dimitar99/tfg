<?php

namespace App\Http\Controllers\CMSApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(12);

        return $categories;
    }

    public function store(CreateCategoryRequest $request)
    {
        $category = new Category([
            'name' => $request->name,
        ]);

        $category->save();
    }

    public function show()
    {
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update(['name' => $request->name]);
    }

    public function destroy(Category $category)
    {
        $category->forceDelete();
    }
}
