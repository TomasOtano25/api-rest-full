<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\Category;
use App\Transformers\CategoryTransformer;

class ProductCategoryController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('index');
        
        $this->middleware('client.credentials')->only('index');

        $this-> middleware('scope:manage-products')->except('index');

        $this->middleware('can:add-category,product')->only('update');

        $this->middleware('can:delete-category,product')->only('destroy');
    }

    public function index(Product $product)
    {
        $categories = $product->categories;

        return $this->showAll($categories);
    }

    public function update(Product $product, Category $category)
    {
        // sync, attach, syncWithoutDetaching (relaciones muchos a muchos)
        $product->categories()->syncWithoutDetaching([$category->id]);

        return $this->showAll($product->categories);
        // return $product->categories;
    }

    public function destroy(Product $product, Category $category) 
    {
        if(!$product->categories()->find($category->id)) {
            return $this->errorResponse('La categoria especificada no es una instancia de este producto.', 404);
        }
        $product->categories()->detach([$category->id]);
        
        return $this->showAll($product->categories, 201);
    }
}
