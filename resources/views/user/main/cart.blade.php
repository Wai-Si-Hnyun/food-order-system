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
                    @php $total = 0 @endphp
                    @if(session('item'))
                        @foreach(session('item') as $id => $details)
                        @php $total += $details['price'] * $details['quantity']  @endphp
                        <tr>
                        <td class="product__cart__item">
                            <div class="product__cart__item__pic">
                                <img src="img/shop/cart/cart-1.jpg" alt="">
                            </div>
                            <div class="product__cart__item__text">
                                <h6>{{$details['product_name']}}</h6>
                                <h5>${{$details['price']}}</h5>
                            </div>
                        </td>
                        <td class="quantity__item">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="{{$details['quantity']}}">
                                </div>
                            </div>
                        </td>
                        <td class="cart__price">{{$details['price']* $details['quantity']}}</td>
                        <form action="{{url('deleteCart/'.$details['id'])}}" method="POST">
                            @csrf
                            @method('DELETE')
                        <td class="cart__close"><button type="submit" class="icon_close border border-0 "></button></td>
                        </form>
                    </tr>
                    @endforeach
                    @endif
                    </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="#">Continue Shopping</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="#"><i class="fa fa-spinner"></i> Update cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Discount codes</h6>
                        <form action="#">
                            <input type="text" placeholder="Coupon code">
                            <button type="submit">Apply</button>
                        </form>
                    </div>
                    <div class="cart__total">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Subtotal <span>$ 169.50</span></li>
                            <li>Total <span>$ 169.50</span></li>
                        </ul>
                        <a href="#" class="primary-btn">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection
