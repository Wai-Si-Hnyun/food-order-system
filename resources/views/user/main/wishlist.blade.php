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
                        <button type="button" class="btn btn-outline-warning position-relative">
                            <span class="text-dark icon_heart_alt"></span>
                            <p
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark text-white">
                                {{ count($wishlists) }}
                            </p>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="wishlist spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if (session('deleteSuccess'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('deleteSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
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
                                @foreach ($wishlists as $list)
                                    <tr>
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__pic">
                                                <img src="{{ asset('storage/' . $list->product_image) }}" alt=""
                                                    class="img-thumbnail" style="height:200px;width:220px">
                                            </div>
                                            <div class="product__cart__item__text">
                                                <h6 class="mt-5">{{ $list->product_name }}</h6>
                                            </div>
                                        </td>
                                        <td class="cart__price">${{ $list->product_price }}</td>
                                        <td class="cart__stock">In stock</td>
                                        <td class="cart__btn"><a href="#" class="primary-btn">Add
                                                to cart</a></td>
                                        <td class="cart__close">
                                            <a href="{{ route('users.destroyWishlist', $list->id) }}"><span
                                                    class="icon_close"></span></a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $wishlists->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
