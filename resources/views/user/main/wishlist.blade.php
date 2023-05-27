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
                            <p class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark text-white"
                                id="wishlistCount">
                                {{ count($wishlists) }}
                            </p>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="wishlist spad my-5 pt-2">
        <div class="container">
            @if (count($wishlists) > 0)
                <div class="row">
                    <div class="col-lg-12">
                        <div class="wishlist__cart__table">
                            <table class="">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price(MMK)</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($wishlists as $list)
                                        <tr data-id="{{ $list->id }}">
                                            <td>
                                                <img src="{{ asset('storage/' . $list->product->image) }}"
                                                    alt="{{ $list->product->name }}" class=" img-fluid w-25">
                                            </td>
                                            <td>
                                                <p class="text-dark pt-3 fw-bolder">{{ $list->product->name }}</p>
                                            </td>
                                            <td class="cart__price">{{ $list->product->price }}</td>
                                            <td class="cart__btn cart_add" data-id="{{ $list->product->id }}"
                                                data-name="{{ $list->product->name }}"
                                                data-price="{{ $list->product->price }}"
                                                data-image="{{ $list->product->image }}" data-quantity="1">
                                                <a href="#" class="primary-btn add-to-cart-btn">Add to cart</a>
                                            </td>
                                            <td class="cart__close">
                                                <span class="icon_close" style="cursor: pointer"></span>
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
    <script src="{{ asset('js/user/add-to-cart.js') }}"></script>
    <script src="{{ asset('js/user/wishlist.js') }}"></script>
@endpush
