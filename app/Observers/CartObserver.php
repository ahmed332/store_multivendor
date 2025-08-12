<?php

namespace App\Observers;

use App\Models\Cart;
use Illuminate\Support\Str;

class CartObserver
{
    /**
     * Handle the cart "created" event.
     */
    public function created(Cart $cart): void
    {
        $cart->id=Str::uuid();
    }

    /**
     * Handle the cart "updated" event.
     */
    public function updated(Cart $cart): void
    {
        //
    }

    /**
     * Handle the cart "deleted" event.
     */
    public function deleted(Cart $cart): void
    {
        //
    }

    /**
     * Handle the cart "restored" event.
     */
    public function restored(Cart $cart): void
    {
        //
    }

    /**
     * Handle the cart "force deleted" event.
     */
    public function forceDeleted(Cart $cart): void
    {
        //
    }
}
