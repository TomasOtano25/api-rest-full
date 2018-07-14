<?php

namespace App\Models;

use App\Scopes\BuyerScope;

class Buyer extends User
{
    // Transformer
    public $transformer = BuyerTransfomer::class;
     
    // El metodo a continuacion es el metodo Boot que se encarga de permitirme usar los Scope globalse
    protected static function boot() 
    {
        parent::boot(); // No pierdas tu comportamiento original
        static::addGlobalScope(new BuyerScope);
    } 

    public function transactions() {
        return $this->hasMany(Transaction::class);
    }
}
