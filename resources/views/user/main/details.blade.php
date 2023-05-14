@extends('user.layouts.app')

@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__text">
                        <h2>Product detail</h2>
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
    <!-- Breadcrumb End -->
    <!-- Shop Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product__details__img">
                        <div class="">
                            <img class="img-thumbnail w-75" src="{{ asset('storage/' . $products->image) }}"
                                alt="productimg">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product__details__text">
                        <h4>{{ $products->name }}</h4>
                        <h5>${{ $products->price }}</h5>
                        <p>
                            {{ $products->description }}
                        </p>
                        <ul>
                            <li>Product-Id : <span>{{ $products->id }}</span></li>
                        </ul>
                        <div class="product__details__option">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="2">
                                </div>
                            </div>
                            <a href="#" class="primary-btn">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->
    <!-- Related Products Section Begin -->
    <section class="related-products spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-title">
                        <h2>Related Products</h2>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="related__products__slider owl-carousel">
                    @foreach ($productList as $list)
                        <div class="col-lg-3">
                            <div class="product__item">
                                <div class="product__item__pic set-bg">
                                    <img src="{{ asset('storage/' . $list->image) }}" alt="product-image"
                                        style="height:200px">
                                    <div class="product__label">
                                        <span>
                                            <a href="{{ route('users.details', $list->id) }}" class="text-dark">View</a>
                                        </span>
                                    </div>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="#">{{ $list->name }}</a></h6>
                                    <div class="product__item__price">${{ $list->price }}</div>
                                    <div class="cart_add">
                                        <a href="#">Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Related Products Section End -->
@endsection
