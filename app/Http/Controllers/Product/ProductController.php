<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Http\Controllers\ApiController;

class ProductController extends ApiController
{
    /**
     * @var App\Repositories\ProductRepository
     */
    protected $product;

    public function __construct(ProductRepositoryInterface $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        $products = $this->product->getAll();

        return $this->showAll($products);
    }

    public function show(Product $product)
    {
        return $this->showOne($product);
    }
}
