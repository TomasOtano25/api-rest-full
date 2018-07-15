<?php

namespace App\Models;

use App\Scopes\SellerScope;
use App\Transformers\SellerTransformer;
 
class Seller extends User
{
    // Transformer
    public $transformer = SellerTransformer::class;

    protected static function boot() 
    {
        // parent::boot();
        static::addGlobalScope(new SellerScope);
    }

    public function products() {
        return $this->hasMany(Product::class);
    }
}
