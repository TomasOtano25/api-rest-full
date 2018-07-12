<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Model extends Eloquent
{
    use SoftDeletes;

    protected $dates = ['deleted_at']; // Propiedad relacionada con el SoftDeletes
}