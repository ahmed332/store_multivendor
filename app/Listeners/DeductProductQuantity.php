<?php

namespace App\Listeners;

use App\Events\OrderCreated;

class DeductProductQuantity
{
    public function handle(OrderCreated $event): void
    {
                $order = $event->order->load('products');

        foreach ($order->products as $product) {

         if ($product->quantity < $product->pivot->quantity) {
            throw new \Exception(
                "الكمية غير كافية للمنتج: {$product->name}"
            );
        }
    $product->decrement('quantity', $product->pivot->quantity);
}
    }
}
