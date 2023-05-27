@component('mail::message')
# Order Confirmation

Hello {{ $order->user->name }},

Thank you for your order!

---

## Summary:
**Order Code:** {{ $order->order_code }}<br>
**Order Time:** {{ $order->created_at->format('Y-m-d H:i:s') }}

---

## Delivery Address:
{{ $order->billingdetail->name }}<br>
{{ $order->billingdetail->address }}<br>
{{ $order->billingdetail->city }}<br>

---

@component('mail::table')
| Product Name       | Quantity | Price      |
|:-------------------|:--------:|:----------:|
@foreach($order->orderlists as $orderlist)
| {{ $orderlist->product->name }} | {{ $orderlist->quantity }}      | {{ $orderlist->total }} MMK  |
@endforeach
@endcomponent

**Order Total:** {{ $order->total_price }} MMK

---

@component('mail::button', ['url' => url('/')])
View Order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
