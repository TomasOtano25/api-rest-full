<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

trait ApiResponser //   
{
    private function successResponse($data, $code) {
        return response()->json($data, $code);
    }

    protected function errorResponse($message, $code) {
        return response()->json([ 'error' => $message, 'code' => $code], $code);
    }

    protected function showAll(Collection $collection, $code = 200) 
    { // valor por defecto 200
        
        if($collection->isEmpty()) {
            return $this->successResponse(['data' => $collection], $code);
        }

        $transformer = $collection->first()->transformer;

        $collection = $this->filterData($collection, $transformer);

        $collection = $this->sortData($collection, $transformer);

        $collection = $this->transformData($collection, $transformer);

        // return response()->json(['data' => $collection], $code);
        return response()->json($collection, $code);
    }

    protected function showOne(Model $instance, $code = 200) { // valor por defecto 200

        $transformer = $instance->transformer;
        $instance = $this->transformData($instance, $transformer);

        // return response()->json(['data' => $instance], $code);
        return response()->json($instance, $code);
    }

    protected function showMessage($message, $code = 200) {
        return response()->json(['data' => $message], $code);
    }

    protected function transformData($data, $transformer) {
        $transformation = fractal($data, new $transformer);

        return $transformation->toArray();
    }


    protected function sortData(Collection $collection, $transformer) 
    {
        if(request()->has('sort_by')) {
            $attribure = $transformer::originalAttribute(request()->sort_by);
            $collection = $collection->sortBy($attribure);
            // $collection = $collection->sortBy->{$attribute};
        }

        return $collection;
    }

    protected function filterData(Collection $collection, $transformer) 
    {
        foreach (request()->query() as $query => $value) {
            $attribute = $transformer::originalAttribute($query);

            if(isset($attribute, $value)) {
                $collection = $collection->where($attribute, $value);
            }
        }

        return $collection;
    }
}

