<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('viewPulse', function (User $user) {
            $user = User::findOrFail($user->id);
            return $user->is_admin == 1;
        });

        Gate::define('viewTelescope', function (User $user) {
            $user = User::findOrFail($user->id);
            return $user->is_admin == 1;
        });

        Gate::define('viewHorizon', function (User $user) {
            $user = User::findOrFail($user->id);
            return $user->is_admin == 1;
        });
    }
}
