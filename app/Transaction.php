<?php

namespace App;

class Transaction extends Model
{
    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function buyer() {
        return $this->belongsTo(Product::class);
    }
}
