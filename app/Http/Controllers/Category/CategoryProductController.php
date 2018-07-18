<?php

namespace App\Http\Controllers\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Repositories\Category\CategoryRepository;

class CategoryProductController extends ApiController
{
    protected $category;

    public function __construct(CategoryRepository $category)
    {
        $this->middleware('client.credentials')->only('index');
        
        $this->category = $category;
    }

    public function index(Category $category)
    {
        $products = $this->category->getCategoryProducts($category);
        
        return $this->showAll($products);
    }
}
