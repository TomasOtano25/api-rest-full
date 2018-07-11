<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;

class BackendServiceProvider extends ServiceProvider
{
    public function boot()
    {
    //    $this->app->bind(
    //        'App\Repositories\Product\ProductRepositoryInterface', 
    //         'App\Repositories\Product\ProductRepository'
    //     );
        $this->generateBind('\Product\ProductRepositoryInterface', '\Product\ProductRepository');
    }

    public function register()
    {

    }

    private function generateBind($inteface, $repository) {
        $this->app->bind(
            'App\Repositories' . $inteface,
            'App\Repositories' . $repository
        );
    }
}
