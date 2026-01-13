<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Facades\Cart;

class EmptyCart
{
    public function handle(OrderCreated $event): void
    {
        Cart::empty();
    }
}
