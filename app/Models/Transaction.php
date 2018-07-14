<?php

namespace App\Models;

use App\Transformers\TransactionTransformer;


class Transaction extends Model
{
    protected $fillable = [
        'quantity',
        'buyer_id',
        'product_id'
    ];

    //Transformer
    public $transformer = TransactionTransformer::class;

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function buyer() {
        return $this->belongsTo(Buyer::class);
    }
}
