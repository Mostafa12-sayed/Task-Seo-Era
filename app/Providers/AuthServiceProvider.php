<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();

        // Passport routes
//        if (! $this->app->routesAreCached()) {
//            Passport::routes();
//        }

        // Token lifetimes
//        Passport::tokensExpireIn(now()->addDays(15));
//        Passport::refreshTokensExpireIn(now()->addDays(30));
//        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
//
//        // Token scopes
        Passport::tokensCan([
            'read-posts' => 'Read posts',
            'create-posts' => 'Create posts',
            'admin-users' => 'Manage users',
            'admin-posts' => 'Manage all posts',
        ]);

        Passport::setDefaultScope([
            'read-posts',
            'create-posts',
        ]);
    }
}
