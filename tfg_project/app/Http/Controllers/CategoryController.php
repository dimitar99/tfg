<?php

namespace App\Http\Controllers;

use App\Http\Forms\CategoryForm;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list()
    {
        $categories = Category::query()
            ->orderBy('name')
            ->paginate(10);

        return view('categories.list', compact('categories'));
    }

    /*
    * Muestra el detalle de una categoria
    */

    public function show($id)
    {
        $category = Category::findOrFail($id);

        return view('categories.show', compact('category'));
    }

    /*
    * Crear una categoria
    */

    public function create()
    {
        return new CategoryForm('categories.create', new Category);
    }

    public function store(CreateCategoryRequest $request)
    {
        $category = new Category([
            'name' => $request->name
        ]);

        $category->save();

        return redirect()->route('categories.list');
    }

    /*
    * Editar una categoria
    */

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return new CategoryForm('categories.edit', $category);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->fill([
            'name' => $request->name
        ]);

        $category->update();

        return redirect()->route('categories.show', compact($category->id));
    }

    /*
    * Elimina una categoria
    */

    public function destroy(Category $category)
    {
        $category->forceDelete();

        return redirect()->route('categories.list');
    }
}
