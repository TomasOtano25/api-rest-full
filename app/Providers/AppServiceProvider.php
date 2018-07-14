<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserCreated;
use App\Mail\UserMailChanged;

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

        User::created( function ($user) {
            // Mail::to($user->email)
            // EL metodo retry numero de intentos, function anonima, tiempo entre las llamadas

            retry(5, function () use ($user) { 
                Mail::to($user)->send(new UserCreated($user));
            }, 100);
        });

        User::updated( function ($user) {
            if($user->isDirty('email')) {
                retry(5, function() use ($user) {
                    Mail::to($user)->send(new UserMailChanged($user));
                }, 100); 
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
