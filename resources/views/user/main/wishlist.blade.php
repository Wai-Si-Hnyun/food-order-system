@extends('user.layouts.app')
@section('content')
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__text">
                        <h2>Favorites</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="{{ route('home') }}">Home</a>
                        <a href="{{ route('users.shop') }}">Shop</a>
                        <button type="button" class="btn btn-outline-warning position-relative">
                            <span class="text-dark icon_heart_alt"></span>
                            <p
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark text-white"
                                id="wishlistCount">
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
            @if (count($wishlists) > 0)
                <div class="row">
                    <div class="col-lg-12">
                        <div class="wishlist__cart__table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price(MMK)</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($wishlists as $list)
                                        <tr data-id="{{ $list->id }}">
                                            <td class="product__cart__item">
                                                <div class="product__cart__item__pic">
                                                    <img src="{{ asset('storage/' . $list->product_image) }}" alt="" class="w-50">
                                                </div>
                                                <div class="product__cart__item__text">
                                                    <h6>{{ $list->product_name }}</h6>
                                                </div>
                                            </td>
                                            <td class="cart__price">{{ $list->product_price }}</td>
                                            <td class="cart__btn">
                                                <a href="#" class="primary-btn">Add to cart</a></td>
                                            <td class="cart__close">
                                                <span class="icon_close"
                                                    style="cursor: pointer"></span>
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
            @else
                <h4 class="text-danger text-center py-5 my-5">User have no favorite product.</h4>
            @endif
        </div>
    </section>
@endsection
@push('script')
<script src="{{ asset('js/user/wishlist.js') }}"></script>
@endpush
