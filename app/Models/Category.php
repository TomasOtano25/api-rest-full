<?php

namespace App\Models;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    /* Motivo: me permite eliminar la tabla pivot de mis consultas */
    protected $hidden = [
        'pivot'
    ];
    
    public function products() {
        return $this->belongsToMany(Product::class);
    }
}
