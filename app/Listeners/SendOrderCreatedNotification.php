<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Broadcasting\InteractsWithSockets;

class SendOrderCreatedNotification
{
    use InteractsWithSockets;
    
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\OrderCreated  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        // Broadcast to the "orders" channel that a new order was created
        Broadcast::channel('orders', function ($user) use ($event) {
            return [
                'notification' => 'New order created!',
            ];
        });
    }
}
