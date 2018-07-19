<?php

namespace App\Http\Controllers\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Repositories\Category\CategoryRepository;

class CategoryBuyerController extends ApiController
{
    protected $category;

    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    public function index(Category $category)
    {

        $this->allowedAdminAction();

        $buyers = $this->category->getCategoryBuyers($category);

        return $this->showAll($buyers);
    }
}
