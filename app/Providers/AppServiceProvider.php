<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
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
        // Gate Admin
        Gate::define('admin', function (User $user) {
            return $user->role == 'admin';
        });
        // Gate Author
        Gate::define('author', function (User $user) {
            return $user->role == 'author';
        });
        // Gate Petugas
        Gate::define('petugas', function (User $user) {
            return $user->role == 'petugas';
        });
        // Gate Author
        Gate::define('pengguna', function (User $user) {
            return $user->role == 'pengguna';
        });

        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
    }
}
