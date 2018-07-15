<?php

namespace App\Repositories\Buyer;

use App\Models\Buyer;

class BuyerRepository 
{
    public function getAll() 
    {
       return Buyer::has('transactions')->get();
    }

    // public function getBuyer($id) {
    //     return Buyer::has('transactions')->findOrFail($id);
    // }

    public function getBuyerCategories(Buyer $buyer) 
    {
        $categories = $buyer->transactions()
            ->with('product.categories')
            ->get()
            ->pluck('product.categories')
            ->collapse() // se encarga de unir las listas
            ->unique('id')
            ->values();

        return $categories;
    }

    public function getBuyerProducts(Buyer $buyer) 
    {
        $products = $buyer->transactions()
            ->with('product')
            ->get()
            ->pluck('product');

        return $products;
    }

    public function getBuyerSellers(Buyer $buyer) 
    {
        $sellers = $buyer->transactions()
            ->with('product.seller')
            ->get()
            ->pluck('product.seller')
            ->unique('id')
            ->values(); //reordena los indices

        return $sellers;
    }

    public function getBuyerTransactions(Buyer $buyer) 
    {
        return $buyer->transactions;
    }
}
