<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App;
use App\Models\Product;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Schema::defaultStringLength(191);

        // Manejar el cambio del estado de una producto debido a la cantidad disponible
        Product::updated( function ($product) {
            if($product->quantity == 0 && $product->isAvaible()) {
                $product->status = Product::PRODUCTO_NO_DISPONIBLE;
                
                $product->save();
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
