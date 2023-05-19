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
                        <a href="#">Home</a>
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
                                {{-- @foreach ($products as $product) --}}
                                <tr>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <img src="{{ asset('assets/user/img/blog/blog-1.jpg') }}" alt=""
                                                class="img-thumbnail" style="height:200px;width:220px">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h6 class="mt-5">Chocolate</h6>
                                        </div>
                                    </td>
                                    <td class="cart__price">$100</td>
                                    <td class="cart__stock">In stock</td>
                                    <td class="cart__btn"><a href="" class="primary-btn">Add
                                            to cart</a></td>
                                    <td class="cart__close">
                                        <a href=""><span class="icon_close"></span></a>
                                    </td>
                                </tr>
                                {{-- @endforeach --}}

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
{{-- @section('scriptSource')
    <script>
        $(document).ready(function() {
            $('.icon_close').click(function() {
                $parentNode = $(this).parents('tr');
                $parentNode.remove();
            })

        })
    </script>
@endsection --}}
