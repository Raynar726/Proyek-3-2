<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
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
        Gate::define('manage-roles', 
            fn (User $user): bool => $user->role === 'admin'); 
        Gate::define('manage-products', 
            fn (User $user): bool => $user->role === 'admin'); 
        Gate::define('adjust-stock', 
            fn (User $user): bool => in_array( 
                $user->role, ['staff', 'admin'], true)); 
        Gate::define('use-cart', 
            fn (User $user): bool => $user->role === 'customer'); 
        User::observe(UserObserver::class);
    }
}
