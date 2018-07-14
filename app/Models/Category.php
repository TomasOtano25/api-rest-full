<?php

namespace App\Models;

use App\Transformers\CategoryTransformer;


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

    // Transformer
    public $transformer = CategoryTransformer::class;
    
    public function products() {
        return $this->belongsToMany(Product::class);
    }
}
