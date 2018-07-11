<?php

namespace App\Repositories\Product;

use App\Product;


class ProductRepository implements ProductRepositoryInterface  
{
    public function getAll() {
        return Product::all();
    }

    public function find($id) {
        return Product::findOrFail($id);
    }
}
