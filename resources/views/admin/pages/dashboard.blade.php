@extends('admin.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row card-deck mb-4">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                    <svg class="p-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="apps"><path fill="#6563FF" d="M10,13H3a1,1,0,0,0-1,1v7a1,1,0,0,0,1,1h7a1,1,0,0,0,1-1V14A1,1,0,0,0,10,13ZM9,20H4V15H9ZM21,2H14a1,1,0,0,0-1,1v7a1,1,0,0,0,1,1h7a1,1,0,0,0,1-1V3A1,1,0,0,0,21,2ZM20,9H15V4h5Zm1,4H14a1,1,0,0,0-1,1v7a1,1,0,0,0,1,1h7a1,1,0,0,0,1-1V14A1,1,0,0,0,21,13Zm-1,7H15V15h5ZM10,2H3A1,1,0,0,0,2,3v7a1,1,0,0,0,1,1h7a1,1,0,0,0,1-1V3A1,1,0,0,0,10,2ZM9,9H4V4H9Z"></path></svg>
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
                                <svg class="p-1" xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 24 24" id="gold"><path fill="#6563FF" d="M8,11h8a1,1,0,0,0,.77-.37A1,1,0,0,0,17,9.8l-1-5A1,1,0,0,0,15,4H9a1,1,0,0,0-1,.8l-1,5a1,1,0,0,0,.21.83A1,1,0,0,0,8,11ZM9.82,6h4.36l.6,3H9.22ZM22,13.8a1,1,0,0,0-1-.8H15a1,1,0,0,0-1,.8l-1,5a1,1,0,0,0,.21.83A1,1,0,0,0,14,20h8a1,1,0,0,0,.77-.37A1,1,0,0,0,23,18.8ZM15.22,18l.6-3h4.36l.6,3ZM9,13H3a1,1,0,0,0-1,.8l-1,5a1,1,0,0,0,.21.83A1,1,0,0,0,2,20h8a1,1,0,0,0,.77-.37A1,1,0,0,0,11,18.8l-1-5A1,1,0,0,0,9,13ZM3.22,18l.6-3H8.18l.6,3Z"></path></svg>
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
                                <svg class="p-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="user"><path fill="#6563FF" d="M15.71,12.71a6,6,0,1,0-7.42,0,10,10,0,0,0-6.22,8.18,1,1,0,0,0,2,.22,8,8,0,0,1,15.9,0,1,1,0,0,0,1,.89h.11a1,1,0,0,0,.88-1.1A10,10,0,0,0,15.71,12.71ZM12,12a4,4,0,1,1,4-4A4,4,0,0,1,12,12Z"></path></svg>
                            </div>
                        </div>
                        <span>Total Customers</span>
                        <h3 class="card-title text-nowrap mb-1 mt-2">#</h3>
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
                                <img src="{{ asset('assets/admin/img/icons/unicons/chart.png') }}" alt="Orders"
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
                                <img src="{{ asset('assets/admin/img/icons/unicons/chart-success.png') }}" alt="Delivered Orders"
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
                                <img src="{{ asset('assets/admin/img/icons/unicons/chart.png') }}" alt="Processing Orders"
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
                                <img src="{{ asset('assets/admin/img/icons/unicons/wallet-info.png') }}" alt="Total Revenue"
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
                                <img src="{{ asset('assets/admin/img/icons/unicons/wallet.png') }}" alt="Monthly Revenue"
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
                                <img src="{{ asset('assets/admin/img/icons/unicons/wallet-info.png') }}" alt="Yearly Revenue"
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
