<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Notifications\OrderCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderCreatedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated  $event): void
    {
        $order = $event->order;

        // مثال: إرسال الإشعار للي عمل الأوردر
        $order->user->notify(
            new OrderCreatedNotification($order)
        );
    }
}
