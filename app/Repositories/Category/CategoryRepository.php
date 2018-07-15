<?php

namespace App\Repositories\Category;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryRepository 
{
    public function getAll() 
    {
        return Category::all();
    }

    public function create(Request $request) 
    {
        return Category::create([
            'name' => $request->name,
            'description' => $request->description
        ]);
    }

    public function update(Request $request, Category $category) {
        return $category->fill($request->only([
            'name',
            'description'
        ]));
    }

    public function save(Category $category) {
        return $category->save();
    }

    public function delete(Category $category) 
    {
        $category->delete();
        return $category;
    }

    public function getCategoryBuyers(Category $category) 
    {
        $buyers = $category->products()
            ->whereHas('transactions')
            ->with('transactions.buyer')
            ->get()
            ->pluck('transactions')
            ->collapse()
            ->pluck('buyer')
            ->unique()
            ->values();
        
        return $buyers;
    }

    public function getCategoryProducts(Category $category) 
    {
        return $category->products;
    }

    public function getCategorySellers(Category $category) 
    {
        $sellers = $category->products() //iglerlogin   
            ->with('seller')
            ->get()
            ->pluck('seller')
            ->unique('id')
            ->values();

        return $sellers;
    }

    public function getCategoryTransactions(Category $category) 
    {
        $transactions = $category->products()
            ->whereHas('transactions')
            ->with('transactions')
            ->get()
            ->pluck('transactions')
            ->collapse();

        return $transactions;
    }
}