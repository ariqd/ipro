<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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

        Gate::define('isAdmin', function ($user) {
            return $user->role == 'admin';
        });

        Gate::define('isSales', function ($user) {
            return $user->role == 'sales';
        });

        Gate::define('isKorwil', function ($user) {
            return $user->role == 'koordinator_wilayah';
        });

        Gate::define('isSalesHo', function ($user) {
            return $user->role == 'sales_ho';
        });

        Gate::define('isFinance', function ($user) {
            return $user->role == 'finance';
        });

        Gate::define('isGudang', function ($user) {
            return $user->role == 'gudang';
        });
    }
}
