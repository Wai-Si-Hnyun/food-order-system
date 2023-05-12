@extends('admin.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Orders /</span> Order List</h4>
        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Order Code</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Delivered?</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($orders as $order)
                            <tr data-id="{{ $order->id }}">
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $order->user->name }}</td>
                                <td><a href="{{ route('order.show', $order->id) }}" class="text-decoration-underline">{{ $order->order_code }}</a></td>
                                <td>{{ $order->total_price }}</td>
                                <td>
                                    <select class="form-select form-select-sm orderStatus" name="status" id="status">
                                        <option value="0" {{ $order->status == 0 ? 'selected' : null }}>
                                            reject
                                        </option>
                                        <option value="1" {{ $order->status == 1 ? 'selected' : null }}>
                                            success
                                        </option>
                                        <option value="2" {{ $order->status == 2 ? 'selected' : null }}>
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
                                    <div class="d-flex">
                                        <a class="text-primary me-3" href="{{ route('order.show', $order->id) }}">
                                            <i class="bx bx-edit-alt me-1"></i>
                                        </a>
                                        <a class="text-danger delete-btn" href="#" onclick="deleteOrder(event, {{ $order->id }})">
                                            <i class="bx bx-trash me-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-danger">There is no order.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('js/admin/order.js') }}"></script>
@endpush
