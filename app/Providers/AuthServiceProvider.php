<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Carbon\Carbon;
use App\Models\Buyer;
use App\Policies\BuyerPolicy;
use App\Models\Seller;
use App\Policies\SellerPolicy;
use App\Models\User;
use App\Policies\UserPolicy;
use App\Models\Transaction;
use App\Policies\TransactionPolicy;
use App\Models\Product;
use App\Policies\ProductPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Buyer::class => BuyerPolicy::class,
        Seller::class => SellerPolicy::class,
        User::class => UserPolicy::class,
        Transaction::class => TransactionPolicy::class,
        Product::class => ProductPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin-action', function ($user) {
            return $user->isAdministrator();
        });

        Passport::routes();

        // tiempo de expiracion del token
        // Passport::tokensExpireIn(Carbon::now()->addSeconds(30));
        // Passport::tokensExpireIn(Carbon::now()->addHours(30));
        Passport::tokensExpireIn(Carbon::now()->addMinutes(30));
        // Passport::tokensExpireIn(Carbon::now()->addMinute());

        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));

        // Opcional
        Passport::enableImplicitGrant();

        /* Scopes */
        Passport::tokensCan([
            'purchase-product' => 'Crear transacciones para comprar productos determinados',
            'manage-products' => 'Crear, Ver, Actualizar y Eliminar productos',
            'manage-account' => 'Obtener la informacion de la cuenta, nombre, email, estado (sin contraseña), modificar datos como el email, nombre y contraseña. No puede eliminar la cuenta.',
            'read-general' => 'Obtener informacion general, categoria donde se compra y se vende, productos vendidos o comprados, transacciones, compras y ventas'  
        ]);

    }
}
