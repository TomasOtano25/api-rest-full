<?php

namespace App;

use App\Scopes\BuyerScope;


class Buyer extends User
{
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
