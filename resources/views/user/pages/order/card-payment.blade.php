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
                @if (session('success'))
                    <div class="alert alert-success text-center mt-3">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p class="m-0">
                            {{ session('success') }}&nbsp;Click <a href="{{ route('checkout') }}">here</a> to continue order process.
                        </p>
                    </div>
                @endif
                <div class="card p-3">
                    <div class=" card-header">
                        <h3>Payment Details</h3>
                    </div>
                    <div class="card-body">
                        <form role="form" action="{{ route('stripe.card') }}" method="POST" class="require-validation"
                            data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                            @csrf

                            <input type="hidden" name="stripeToken" id="stripeToken">
                            <input type="hidden" name="price" value="10">

                            <div class='form-group'>
                                <div class='form-group required'>
                                    <label class='control-label'>Name on Card</label>
                                    <input class='form-control' type='text'>
                                </div>
                            </div>

                            <div class='form-group'>
                                <div class='form-group required'>
                                    <label class="form-label">Card Information</label>
                                    <div id="card-element" class="form-control"></div>
                                    <div id="card-errors" role="alert" class="text-danger mt-2"></div>
                                </div>
                            </div>

                            <div class='form-group row'>
                                <div class='col-12 error form-group collapse'>
                                    <div class='alert-danger alert'>Please correct the errors and try
                                        again.</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-primary btn-block" type="submit">Pay Now</button>
                                </div>
                            </div>

                        </form>
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
    <script src="{{ asset('js/user/card-payment.js') }}"></script>
@endpush
