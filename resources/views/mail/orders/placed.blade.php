@component('mail::message')
# Order Confirmation

Thank you for your order!

**Order Number:** {{ $order->order_code }}
**Order Total:** ${{ number_format($order->total_price, 2) }}

@component('mail::button', ['url' => url('/')])
View Order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
