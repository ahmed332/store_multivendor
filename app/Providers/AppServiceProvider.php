<?php

namespace App\Providers;

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
        Paginator::useBootstrap();
        Gate::define('categories.view', function ($user) {
        return true;
    });
     Gate::define('categories.create', function ($user) {
        return false;
    });
     Gate::define('categories.update', function ($user) {
        return true;
    });
     Gate::define('categories.delete', function ($user) {
        return false;
    });
    }
}
