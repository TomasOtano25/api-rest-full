<?php

namespace App\Models;

class Product extends Model
{
    const PRODUCTO_DISPONIBLE = 'disponible';
    const PRODUCTO_NO_DISPONIBLE = 'no disponible';

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'status',
        'image',
        'seller_id'
    ];

    /* Motivo: me permite eliminar la tabla pivot de mis consultas */
    protected $hidden = [
        'pivot'
    ];

    public function isAvaible() {
        return $this->status == Product::PRODUCTO_DISPONIBLE;
    }
    

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function transactions() {
        return $this->hasMany(Transaction::class);
    } 

    public function seller() {
        return $this->belongsTo(Seller::class);
    }
}
