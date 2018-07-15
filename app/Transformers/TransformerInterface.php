<?php

namespace App\Transformers;

interface TransformerInterface {
    public static function originalAttribute($index);
    public static function transformedAttribute($index);
}