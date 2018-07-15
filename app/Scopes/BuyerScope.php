<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Buyer;

class BuyerScope implements Scope 
{
    //La function apply es la que se ejecutara
    public function apply(Builder $builder, Model $model) 
    {
        $builder->has('transactions');
    }
}