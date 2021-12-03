<?php

namespace App\Providers;

use App\Models\User;
use Auth;
use Blade;
use Gate;
use Illuminate\Support\ServiceProvider;

class AdminProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Gate::define('admin', function (User $user) {
            return $user->username === 'awma123';
        });

        Blade::if('admin', function () {
            if (auth()->user())
                return Auth::user()->can('admin');
        });
    }
}
