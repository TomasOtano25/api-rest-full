<?php

namespace App\Http\Controllers\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepository;
use App\Http\Controllers\ApiController;

class CategoryController extends ApiController
{
    protected $category;

    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }
    
    public function index()
    {
        $categories = $this->category->getAll();

        return $this->showAll($categories);
    }

    
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required'
        ];

        $this->validate($request, $rules);

        $category = $this->category->create($request);

        return $this->showOne($category, 201);

    }

    public function show(Category $category)
    {
        return $this->showOne($category);
    }

    public function update(Request $request, Category $category)
    {
        
    }

    public function destroy(Category $category)
    {
        $category = $this->category->delete($category);

        return $this->showOne($category);;
    }
}
