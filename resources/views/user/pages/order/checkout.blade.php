@extends('user.layouts.app')

@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="{{ route('home') }}">Home</a>
                        <span>Checkout</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="#">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="checkout__title">Billing Details</h6>
                            <div class="checkout__input mb-3">
                                <p>Full Name<span>*</span></p>
                                <input type="text" name="name" id="name">
                            </div>
                            <div class="checkout__input mb-3">
                                <p>Country<span>*</span></p>
                                <input type="text" name="country" id="country" value="Myanmar" disabled>
                            </div>
                            <div class="checkout__input mb-3">
                                <p>State<span>*</span></p>
                                <select name="state" class="state-select" id="state" style="width: 100%;">
                                    <option id="0" value="" selected>Choose State</option>
                                </select>
                            </div>
                            <div class="checkout__input mb-3">
                                <p>Town/City<span>*</span></p>
                                <select name="city" id="city" style="width: 100%;" disabled>
                                    <option value="" selected>Choose City</option>
                                </select>
                            </div>
                            <div class="checkout__input mb-3">
                                <p>Address<span>*</span></p>
                                <input type="text" placeholder="Street Address" name="address" id="address">
                            </div>
                            <div class="checkout__input mb-3">
                                <p>Phone<span>*</span></p>
                                <input type="text" name="phone" id="phone">
                            </div>
                            <div class="checkout__input mb-3">
                                <p>Account Password<span>*</span></p>
                                <input type="password" name="password" id="password">
                            </div>
                            <div class="checkout__input">
                                <p>Order notes</p>
                                <input type="text" name="note" id="note"
                                    placeholder="Notes about your order, e.g. special notes for delivery.(optional)">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h6 class="order__title">Your order</h6>
                                <div class="checkout__order__products">Product <span>Total(MMK)</span></div>
                                <ul class="checkout__total__products">
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>Total <span id="total-price"></span></li>
                                </ul>
                                <button type="submit" id="order-btn" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection

@push('script')
    <script src="{{ asset('js/user/checkout.js') }}"></script>
@endpush
