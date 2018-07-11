<?php

namespace App\Repositories\Product;

interface ProductRepositoryInterface {
    public function getAll();
    public function find($id);
}