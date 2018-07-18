<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Carbon\Carbon;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        // tiempo de expiracion del token
        // Passport::tokensExpireIn(Carbon::now()->addSeconds(30));
        // Passport::tokensExpireIn(Carbon::now()->addHours(30));
        Passport::tokensExpireIn(Carbon::now()->addMinutes(30));
        // Passport::tokensExpireIn(Carbon::now()->addMinute());

        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));

        // Opcional
        Passport::enableImplicitGrant();

    }
}
