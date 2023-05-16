@extends('admin.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Orders /</span> Order Detail</h4>
        <a href="{{ route('orders.index') }}" class="btn btn-dark mb-3">Back</a>
        <div class="card">
            <h5 class="card-header">Order Code&nbsp;-&nbsp;<span class="text-primary">EF45VC</span></h5>
            <div class="card-body">
                <ul class="list-group col-5">
                    <li class="list-group-item">Name&nbsp;-&nbsp; {{ $order->user->name }}</li>
                    <li class="list-group-item">Total Price&nbsp;-&nbsp; ${{ $order->total_price }}</li>
                    <li class="list-group-item">
                        Status&nbsp;-&nbsp;@if ($order->status == 0)
                            <span class="text-danger">Reject</span>
                        @elseif ($order->status == 1)
                            <span class="text-success">Success</span>
                        @elseif ($order->status == 2)
                            <span class="text-warning">Pending</span>
                        @else
                            <span class="text-danger">Reject</span>
                        @endif
                    </li>
                    <li class="list-group-item">{{ $order->delivered == 0 ? 'Not Delivered Yet' : 'Delivered' }}</li>
                    <li class="list-group-item">Ordered Date&nbsp;-&nbsp; {{ $order->created_at->format('j-m-Y') }}</li>
                </ul>
            </div>
        </div>
        <div class="card my-5">
            <h5 class="card-header">Products in the Order</h5>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table card-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($order->orderlists as $orderlist)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img class="w-25" src="{{ asset('storage/' . $orderlist->product->image) }}"
                                            alt="">
                                    </td>
                                    <td>{{ $orderlist->product->name }}</td>
                                    <td>${{ $orderlist->product->price }}</td>
                                    <td>{{ $orderlist->quantity }}</td>
                                    <td>${{ $orderlist->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mb-5">
            <h5 class="card-header">Billing Details</h5>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">Name&nbsp;-&nbsp; {{ $order->billingdetail->name }}</li>
                    <li class="list-group-item">Country&nbsp;-&nbsp; {{ $order->billingdetail->country }}</li>
                    <li class="list-group-item">State&nbsp;-&nbsp; {{ $order->billingdetail->state }}</li>
                    <li class="list-group-item">City&nbsp;-&nbsp; {{ $order->billingdetail->city }}</li>
                    <li class="list-group-item">Address&nbsp;-&nbsp; {{ $order->billingdetail->address }}</li>
                    <li class="list-group-item">Phone&nbsp;-&nbsp; {{ $order->billingdetail->phone }}</li>
                    <li class="list-group-item">
                        Additional Note&nbsp;-&nbsp; 
                        @if (empty($order->billingdetail->note))
                            There is no additional note.
                        @else
                            {{ $order->billingdetail->note }}
                        @endif
                    </li>
                </ul>
            </div>
        </div>
        <div class="card">
            <h5 class="card-header">Payment Details</h5>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        Transaction&nbsp;ID&nbsp;-&nbsp;
                        <a target="_blink" href="{{ 'https://dashboard.stripe.com/test/payments/' . $order->payment->transaction_id }}" class="text-primary">{{ $order->payment->transaction_id }}</a>
                    </li>
                    <li class="list-group-item">Amount&nbsp;-&nbsp; {{ $order->payment->payment_amount }}</li>
                    <li class="list-group-item">Currency&nbsp;-&nbsp; {{ $order->payment->payment_currency }}</li>
                    <li class="list-group-item">Method&nbsp;-&nbsp; {{ $order->payment->payment_method }}</li>
                    <li class="list-group-item">Gateway&nbsp;-&nbsp; {{ $order->payment->payment_gateway }}</li>
                    <li class="list-group-item">Status&nbsp;-&nbsp; {{ $order->payment->payment_status }}</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
