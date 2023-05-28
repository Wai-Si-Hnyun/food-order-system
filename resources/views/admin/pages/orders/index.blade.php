@extends('admin.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Orders List</h4>
        <div class="alert alert-success w-50 fade" id="successAlert" role="alert"></div>
        <div class="d-flex justify-content-between mb-3">
            <h5>Total - ({{ count($orders) }})</h5>
            <div>
                <form action="{{ route('orders.index') }}" method="get">
                    <div class="d-flex">
                        <input class="form-control" name="key" type="text" value="{{ request('key') }}"
                            id="key" placeholder="Search..">
                        <button class='btn btn-sm btn-dark ms-2' type="submit"><i
                                class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
        </div>
        @if (count($orders) > 0)
            <div class="card">
                <div class="table-responsive text-nowrap">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th>User</th>
                                <th>Order Code</th>
                                <th>Total Price(MMK)</th>
                                <th>Status</th>
                                <th>Delivered?</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($orders as $order)
                                <tr data-id="{{ $order->id }}">
                                    <th>
                                        {{ ($orders->currentPage()-1) * $orders->perPage() + $loop->iteration }}
                                    </th>
                                    <td>{{ $order->user->name }}</td>
                                    <td><a href="{{ route('order.show', $order->id) }}"
                                            class="text-decoration-underline">{{ $order->order_code }}</a></td>
                                    <td>{{ $order->total_price }}</td>
                                    <td>
                                        <select class="form-select form-select-sm orderStatus" name="status"
                                            id="status">
                                            <option class="text-danger" value="0"
                                                {{ $order->status == 0 ? 'selected' : null }}>
                                                reject
                                            </option>
                                            <option class="text-success" value="1"
                                                {{ $order->status == 1 ? 'selected' : null }}>
                                                accept
                                            </option>
                                            <option class="text-warning" value="2"
                                                {{ $order->status == 2 ? 'selected' : null }}>
                                                pending
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="form-check-input" name="delivered" id="delivered"
                                            {{ $order->delivered == 0 ? '' : 'checked' }}>
                                    </td>
                                    <td>{{ $order->created_at->format('j-m-Y') }}</td>
                                    <td>
                                        <div class="">
                                            <a class="text-primary me-3" href="{{ route('order.show', $order->id) }}" title="Detail">
                                                <i class="bx bxs-detail me-1"></i>
                                            </a>
                                            <a class="text-danger delete-btn" href="#" title="Delete"
                                                onclick="deleteOrder(event, {{ $order->id }})">
                                                <i class="bx bx-trash me-1"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-3 d-flex justify-content-center">
                {{ $orders->links() }}
            </div>
        @else
            <h4 class="mt-5 text-center">No Order here!</h4>
        @endif
    </div>
@endsection

@push('script')
    <script src="{{ asset('js/admin/order.js') }}"></script>
@endpush
