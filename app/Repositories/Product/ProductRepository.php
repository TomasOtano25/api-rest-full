<?php

namespace App\Repositories\Product;

use App\Models\Product;


class ProductRepository implements ProductRepositoryInterface  
{
    public function getAll() 
    {
        return Product::all();
    }

    public function find($id) 
    {
        return Product::findOrFail($id);
    }

    public function getProductBuyers(Product $product) 
    {
        $buyers = $product->transactions()
            ->with('buyer')
            ->get()
            ->pluck('buyer')
            ->unique('id')
            ->values();

        return $buyers;
    }
}
