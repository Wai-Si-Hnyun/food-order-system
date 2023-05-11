@extends('admin.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Orders /</span> Order Detail</h4>
        <div class="card">
            <h5 class="card-header">Order Code - <span class="text-primary">EF45VC</span></h5>
            <div class="card-body">
                <ul class="list-group col-5">
                    <li class="list-group-item">Name&nbsp;-&nbsp; {{ $order->user->name }}</li>
                    <li class="list-group-item">Total Price&nbsp;-&nbsp; {{ $order->total_price }}</li>
                    <li class="list-group-item">
                        Status&nbsp;-&nbsp;@if ($order->status === 0)
                            <span class="text-danger">Reject</span>
                        @elseif ($order->status === 1)
                            <span class="text-success">Success</span>
                        @elseif ($order->status === 2)
                            <span class="text-warning">Pending</span>
                        @else
                            <span class="text-danger">Reject</span>
                        @endif
                    </li>
                    <li class="list-group-item">{{ $order->delivered === 0 ? 'Not Delivered' : 'Delivered' }}</li>
                    <li class="list-group-item">Ordered Date&nbsp;-&nbsp; {{ $order->created_at->format('j/M/Y') }}</li>
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
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            {{ $id = 1 }}
                            @foreach ($order->orderlists as $orderlist)
                                <tr>
                                    <td>{{ $id }}</td>
                                    <td>
                                        <img class="w-25" src="{{ asset('storage/' . $orderlist->product->image) }}"
                                            alt="">
                                    </td>
                                    <td>{{ $orderlist->product->name }}</td>
                                    <td>{{ $orderlist->product->price }}</td>
                                    <td>{{ $orderlist->quantity }}</td>
                                    <td>{{ $orderlist->total }}</td>
                                </tr>
                                {{ $id++ }}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card">
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
    </div>
@endsection
