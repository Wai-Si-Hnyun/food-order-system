@extends('admin.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row card-deck mb-4">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('assets/admin/img/icons/unicons/wallet-info.png') }}" alt="Credit Card"
                                    class="rounded" />
                            </div>
                        </div>
                        <span>Total Categories</span>
                        <h3 class="card-title text-nowrap mb-1 mt-2">{{ $data['totalCategories'] }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('assets/admin/img/icons/unicons/wallet-info.png') }}" alt="Credit Card"
                                    class="rounded" />
                            </div>
                        </div>
                        <span>Total Products</span>
                        <h3 class="card-title text-nowrap mb-1 mt-2">{{ $data['totalProducts'] }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('assets/admin/img/icons/unicons/wallet-info.png') }}" alt="Credit Card"
                                    class="rounded" />
                            </div>
                        </div>
                        <span>Total Customers</span>
                        <h3 class="card-title text-nowrap mb-1 mt-2">{{ $data['totalUsers'] }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('assets/admin/img/icons/unicons/wallet-info.png') }}" alt="Credit Card"
                                    class="rounded" />
                            </div>
                        </div>
                        <span>Total Orders</span>
                        <h3 class="card-title text-nowrap mb-1 mt-2">{{ $data['totalOrders'] }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('assets/admin/img/icons/unicons/wallet-info.png') }}" alt="Credit Card"
                                    class="rounded" />
                            </div>
                        </div>
                        <span>Delivered Orders</span>
                        <h3 class="card-title text-nowrap mb-1 mt-2">{{ $data['deliveredOrders'] }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('assets/admin/img/icons/unicons/wallet-info.png') }}" alt="Credit Card"
                                    class="rounded" />
                            </div>
                        </div>
                        <span>Processing Orders</span>
                        <h3 class="card-title text-nowrap mb-1 mt-2">{{ $data['processingOrders'] }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-lg-4 d-flex">
                <div class="card flex-grow-1">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('assets/admin/img/icons/unicons/wallet-info.png') }}" alt="Credit Card"
                                    class="rounded" />
                            </div>
                        </div>
                        <span>Total Revenue</span>
                        <h3 class="card-title text-nowrap mb-1 mt-2">$ {{ $data['totalRevenue'] }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 d-flex">
                <div class="card flex-grow-1">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('assets/admin/img/icons/unicons/wallet-info.png') }}" alt="Credit Card"
                                    class="rounded" />
                            </div>
                        </div>
                        <span>This Month Revenue</span>
                        <h3 class="card-title text-nowrap mb-1 mt-2">{{ $data['currentMonthRevenue'] }}</h3>
                        <small class="{{ $data['percentageChangePerMonth'] >= 0 ? 'text-success' : 'text-danger' }} fw-semibold">
                            <i class="bx {{ $data['percentageChangePerMonth'] >= 0 ? 'bx-up-arrow-alt' : 'bx-down-arrow-alt' }}"></i>
                            {{ $data['percentageChangePerMonth'] >= 0 ? '+' : '' }}{{ number_format($data['percentageChangePerMonth'], 2) }}%
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 d-flex">
                <div class="card flex-grow-1">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('assets/admin/img/icons/unicons/wallet-info.png') }}" alt="Credit Card"
                                    class="rounded" />
                            </div>
                        </div>
                        <span>This Year Revenue</span>
                        <h3 class="card-title text-nowrap mb-1 mt-2">{{ $data['currentYearRevenue'] }}</h3>
                        <small class="{{ $data['percentageChangePerYear'] >= 0 ? 'text-success' : 'text-danger' }} fw-semibold">
                            <i class="bx {{ $data['percentageChangePerYear'] >= 0 ? 'bx-up-arrow-alt' : 'bx-down-arrow-alt' }}"></i>
                            {{ $data['percentageChangePerYear'] >= 0 ? '+' : '' }}{{ number_format($data['percentageChangePerYear'], 2) }}%
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
