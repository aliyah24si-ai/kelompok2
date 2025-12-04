<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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
        // Define a simple gate for admin-only menu items and checks
        Gate::define('isAdmin', function (?User $user) {
            if (! $user) return false;
            return strtolower($user->role ?? '') === strtolower(User::ADMIN);
        });
    }
}
