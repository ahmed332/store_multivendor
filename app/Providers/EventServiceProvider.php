<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }
  protected $listen = [
        'order.created' => [
            \App\Listeners\DeductProductQuantity::class,
            \App\Listeners\EmptyCart::class,
        ],
    ];
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
