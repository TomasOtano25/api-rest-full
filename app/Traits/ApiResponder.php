<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;


trait ApiResponser // Trait
{
    private function successResponse($data, $code) {
        return response()->json($data, $code);
    }

    protected function errorResponse($message, $code) {
        return response()->json([ 'error' => $message, 'code' => $code], $code);
    }

    protected function showAll(Collection $collection, $code = 200) { // valor por defecto 200
        return response()->json(['data' => $collection], $code);
    }

    protected function showOne(Model $instance, $code = 200) { // valor por defecto 200
        return response()->json(['data' => $instance], $code);
    }
}
