@extends('user.layouts.app')

@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__text">
                        <h2>Payment</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="{{ route('home') }}">Home</a>
                        <span>Payment</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Payment Section Begin -->
    <section class="spad">
        <div class="container">
            <h2 class="my-4">Choose Payment Method</h2>
            <div class="row">
                <!-- Credit Card -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="{{ asset('assets/user/img/credit-card-svgrepo-com.svg') }}" alt="Credit Card"
                                class="w-25 mb-3">
                            <h4 class="mb-4">Credit Card</h4>
                            <a href="{{ route('payment.card') }}" class="btn btn-primary">Choose Credit Card</a>
                        </div>
                    </div>
                </div>
                <!-- Google Pay -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="{{ asset('assets/user/img/google-pay.svg') }}" alt="Google Pay"
                                class="w-25 mb-3">
                            <h4 class="mb-4">Google Pay</h4>
                            <a href="{{ route('payment.google') }}" class="btn btn-primary">Choose Google Pay</a>
                        </div>
                    </div>
                </div>
                <!-- PayPal -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="{{ asset('assets/user/img/paypal.svg') }}" alt="Paypal" class="w-25 mb-3">
                            <h4 class="mb-1">Paypal</h4>
                            <small class="text-danger d-block mb-1">Not avaliable now</small>
                            <a href="javascript:void(0)" class="btn btn-primary">Choose Paypal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Payment Section End -->
@endsection
