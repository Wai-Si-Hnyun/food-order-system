@extends('user.layouts.app')

@section('content')
<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
        <div class="col-lg-8">
            <div class="shopping__cart__table">
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                        <tbody>
                        </tbody>
             </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="{{ route('users.shop') }}">Continue Shopping</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="#" id="clear-cart-btn"><i class="fa fa-trash"></i> Clear cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Order Information</h6>
                    </div>

                    <div class="cart__total">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Subtotal <span id="subtotal">$ 100</span></li>
                            <li>Total <span id="total">$ 100</span></li>
                        </ul>
                        <a href="#" class="primary-btn" id="checkout">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection

@push('script')
    <script src="{{ asset('js/user/cart.js') }}"></script>
@endpush
