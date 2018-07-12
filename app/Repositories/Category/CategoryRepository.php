<?php

namespace App\Repositories\Category;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryRepository 
{
    public function getAll() 
    {
        return Category::all();
    }

    public function create(Request $request) 
    {
        return Category::create([
            'name' => $request->name,
            'description' => $request->description
        ]);
    }

    public function update(Request $request, Category $category) {
        return $category->fill($request->only([
            'name',
            'description'
        ]));
    }

    public function save(Category $category) {
        return $category->save();
    }

    public function delete(Category $category) 
    {
        $category->delete();
        return $category;
    }
}