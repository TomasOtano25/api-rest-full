<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

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

        $collection = $this->paginate($collection);

        $collection = $this->transformData($collection, $transformer);

        $collection = $this->cacheResponse($collection);

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

    protected function transformData($data, $transformer) 
    {
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

    protected function paginate(Collection $collection) 
    {
        $rules = [
            'per_page' => 'integer|min:2|max:50'
        ];

        Validator::validate(request()->all(), $rules);
        
        $page = LengthAwarePaginator::resolveCurrentPage(); // numero de pagina actual

        $perPage = 15; // numero de elementos de una pagina
        if(request()->has('per_page')) {
            $perPage = (int)request()->per_page;
        }

        $results = $collection->slice(($page - 1) * $perPage, $perPage)->values();

        $paginated  = new LengthAwarePaginator($results, $collection->count(), $perPage, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPath()
        ]);

        $paginated->appends(request()->all());

        return $paginated;
    }

    // protected function paginate(Collection $collection) 
    // {
    //     $page = LengthAwarePaginator::resolveCurrentPage(); // numero de pagina actual

    //     $perPage = 15; // numero de elementos de una pagina

    //     $results = $collection->slice(($page - 1) * $perPage, $perPage)->values();

    //     $paginated  = new LengthAwarePaginator($results, $collection->count(), $perPage, $page, [
    //         'path' => LengthAwarePaginator::resolveCurrentPath()
    //     ]);

    //     $paginated->appends(request()->all());

    //     return $paginated;
    // }

    protected function cacheResponse($data) 
    {
        $url = request()->url();
        $queryParams = request()->query();

        ksort($queryParams);

        $queryString = http_build_query($queryParams);

        $fullUrl = $url . "?" . $queryString;


        return Cache::remember($fullUrl, 30/60, function() use($data) {
            return $data;
        });
    }

    // protected function cacheResponse($data) 
    // {
    //     $url = request()->url();

    //     return Cache::remember($url, 15/60, function() use($data) {
    //         return $data;
    //     });
    // }


 }

