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
                        <a href="{{ route('user.payment') }}">Payment</a>
                        <span>Card</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Payment Section Begin -->
    <section class="spad">
        <div class="container">
            <div class="col-lg-6 col-md-8 col-12 mx-auto">
                <div class="alert alert-danger text-center mt-3" style="display: none;" id="myAlert">
                    <a href="javascript:void(0)" class="close" onclick="$('#myAlert').hide(500)" aria-label="close">×</a>
                    <p class="m-0"></p>
                </div>
                <div class="card p-3">
                    <div class=" card-header">
                        <h3 class="">Payment Details</h3>
                    </div>
                    <div class="card-body text-center mt-5">
                        <div class="mb-3">
                            <span class="pr-3" id="order-total-price">Total Cost - 0 MMK</span>
                            <span class="spinner-border spinner-border-sm d-none" id="spinner" role="status" aria-hidden="true"></span></div>
                        <div id="pay-button"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Payment Section End -->
@endsection

@push('script')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        window.STRIPE_PUBLIC_KEY = "{{ env('STRIPE_KEY') }}";
    </script>
    <script src="{{ asset('js/user/google-payment.js') }}"></script>
    <script async src="https://pay.google.com/gp/p/js/pay.js" onload="onGooglePayLoaded()"></script>
@endpush
