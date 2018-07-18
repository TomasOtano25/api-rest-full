<?php

namespace App\Http\Controllers\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Repositories\Category\CategoryRepository;

class CategoryTransactionController extends ApiController
{
    protected $category;

    public function __construct(CategoryRepository $category)
    {
        parent::__construct();

        $this->category = $category;
    }

    public function index(Category $category)
    {
        $transactions = $this->category->getCategoryTransactions($category);

        return $this->showAll($transactions);
    }
}
