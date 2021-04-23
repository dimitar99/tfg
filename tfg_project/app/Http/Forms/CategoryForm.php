<?php

namespace App\Http\Forms;

use App\Models\Category;
use Illuminate\Contracts\Support\Responsable;

class CategoryForm implements Responsable
{
    private $view;
    private $category;

    public function __construct($view, Category $category)
    {
        $this->view = $view;
        $this->category = $category;
    }

    public function toResponse($request)
    {
        return view($this->view, [
                'category' => $this->category,
            ]);
    }
}
