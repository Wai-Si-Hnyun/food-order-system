@extends('user.layouts.app')

@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__text">
                        <h2>Orders</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="{{ route('home') }}">Home</a>
                        <span>Orders</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Orders -->
    <div class="container my-5 py-5">
        @if (isset($orders) && count($orders) > 0)
            <div class="accordion" id="ordersAccordion">
                @foreach ($orders as $order)
                    <div class="card">
                        <div class="card-header mb-2 custom-card-header" id="heading{{ $order->id }}">
                            <div class="d-flex justify-content-between w-100" type="button" data-toggle="collapse"
                                    data-target="#collapse{{ $order->id }}" aria-expanded="true"
                                    aria-controls="collapse{{ $order->id }}">
                                <p class="d-inline-block mb-0">Order #{{ $order->order_code }}</p>
                                <p class="d-inline-block mb-0">Total Cost - ${{ $order->total_price }}</p>
                                <i class="text-dark fa-solid fa-chevron-down"></i>
                            </div>
                        </div>

                        <div id="collapse{{ $order->id }}" class="collapse" aria-labelledby="heading{{ $order->id }}"
                            data-parent="#ordersAccordion">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Image</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderlists as $orderlist)
                                            <tr>
                                                <td>
                                                    <img src="{{ asset('storage/' . $orderlist->product->image) }}"
                                                        alt="{{ $orderlist->product->name }}" style="width: 80px;">
                                                </td>
                                                <td>
                                                    <p>{{ $orderlist->product->name }}</p>
                                                </td>
                                                <td>
                                                    <p>${{ $orderlist->product->price }}</p>
                                                </td>
                                                <td>
                                                    <p>{{ $orderlist->quantity }}</p>
                                                </td>
                                                <td>
                                                    <p>${{ $orderlist->total }}</p>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center my-5 py-5">There is no order yet.</p>
        @endif
        <div class="my-3">
            {{ $orders->links() }}
        </div>
    </div>
    <!-- Order -->
@endsection
