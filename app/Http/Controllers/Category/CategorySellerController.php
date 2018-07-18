<?php

namespace App\Http\Controllers\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Repositories\Category\CategoryRepository;

class CategorySellerController extends ApiController
{
    protected $category;

    public function __construct(CategoryRepository $category)
    {
        parent::__construct();

        $this->category = $category;
    }

    public function index(Category $category)
    {
        $sellers = $this->category->getCategorySellers($category);

        return $this->showAll($sellers);
    }
}
