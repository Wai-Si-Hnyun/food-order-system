@extends('user.layouts.app')
@section('content')
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__text">
                        <h2>Wishlist</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="{{ route('users.home') }}">Home</a>
                        <a href="{{ route('users.shop') }}">Shop</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="wishlist spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="wishlist__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__pic">
                                                <img src="{{ asset('storage/' . $product->image) }}" alt=""
                                                    class="img-thumbnail" style="height:200px;width:220px">
                                            </div>
                                            <div class="product__cart__item__text">
                                                <h6 class="mt-5">{{ $product->name }}</h6>
                                            </div>
                                        </td>
                                        <td class="cart__price">${{ $product->price }}</td>
                                        <td class="cart__stock">In stock</td>
                                        <td class="cart__btn"><a href="{{ route('users.details', $product->id) }}"
                                                class="primary-btn">Add
                                                to cart</a></td>
                                        <td class="cart__close">
                                            <span class="icon_close"></span>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scriptSource')
    <script>
        $(document).ready(function() {
            $('.icon_close').click(function() {
                $parentNode = $(this).parents('tr');
                $parentNode.remove();
            })

        })
    </script>
@endsection
