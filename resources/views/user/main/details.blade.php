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
                        <a href="{{ route('users.shop') }}">Shop</a>
                        <span>Detail</span>
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
                <div class="col-lg-5">
                    <div class="product__details__img">
                        <div class="">
                            <img class="img-thumbnail w-75" src="{{ asset('storage/' . $product->image) }}"
                                alt="productimg">
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="product__details__text">
                        <h4>{{ $product->name }}</h4>
                        <h5>{{ $product->price }} MMK</h5>
                        <p>
                            {{ $product->description }}
                        </p>
                        <ul>
                            <li>Product-Id : <span>{{ $product->id }}</span></li>
                        </ul>
                        <div class="product__details__option" data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                            data-price="{{ $product->price }}" data-image="{{ $product->image }}">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" name="quantity" value="1" class="product-qty">
                                </div>
                            </div>
                            <a href="#" class="primary-btn add-to-cart-btn-detail">Add to cart</a>
                            <button class="btn btn-outline-warning btn-lg mr-3" id="add-to-wishlist" data-product-id="1">
                                <span class="icon_heart_alt"></span>
                            </button>
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
            @if (count($productList) > 0)
                @if (count($productList) < 4)
                    <div class="row">
                        @foreach ($productList as $list)
                            <div class="col-lg-3 col-md-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg detail-view" data-id="{{ $list->id }}"
                                        data-setbg="{{ asset('storage/' . $list->image) }}" style="cursor: pointer">
                                        <div class="product__label">
                                            <span>
                                                {{ $list->category->name }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="#">{{ $list->name }}</a></h6>
                                        <div class="product__item__price">{{ $list->price }} MMK</div>
                                        <div class="cart_add" data-id="{{ $list->id }}"
                                            data-name="{{ $list->name }}" data-price="{{ $list->price }}"
                                            data-image="{{ $list->image }}" data-quantity="1">
                                            <a href="#" class="add-to-cart-btn">Add to cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="row">
                        <div class="related__products__slider owl-carousel">
                            @foreach ($productList as $list)
                                <div class="col-lg-3">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg detail-view" data-id="{{ $list->id }}"
                                            data-setbg="{{ asset('storage/' . $list->image) }}" style="cursor: pointer">
                                            <div class="product__label">
                                                <span>
                                                    {{ $list->category->name }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="product__item__text">
                                            <h6><a href="#">{{ $list->name }}</a></h6>
                                            <div class="product__item__price">{{ $list->price }} MMK</div>
                                            <div class="cart_add" data-id="{{ $list->id }}"
                                                data-name="{{ $list->name }}" data-price="{{ $list->price }}"
                                                data-image="{{ $list->image }}" data-quantity="1">
                                                <a href="#" class="add-to-cart-btn">Add to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @else
                <h5 class="text-danger text-center my-5 py-5">There is no related product yet!</h5>
            @endif
        </div>
    </section>
    <!-- Related Products Section End -->

    @if (Auth::check())
        <section class="home-testimonial">
            <div class="container-fluid">
                <div class="row d-flex justify-content-center testimonial-pos">
                    <div class="col-md-12 pt-4 d-flex justify-content-center">
                        <div class="col-lg-12 text-center">
                            <div class="section-title">
                                <h2>Reviews</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        <h2 class="mb-3">About this product</h2>
                    </div>
                </div>
                <section class="home-testimonial-bottom">
                    <div class="container testimonial-inner">
                        <div class="row d-flex justify-content-center">
                            @foreach ($review as $reviews)
                                <div class="col-md-4 style-3  ">
                                    <div class="tour-item ">
                                        <div class="tour-desc bg-white p-1 rounded border border-1 mb-3">
                                            <h4><img src="https://img.icons8.com/ultraviolet/40/000000/quote-left.png">
                                            </h4>
                                            <div class="tour-text color-grey-3 text-center">&ldquo;
                                                {{ $reviews->comment }}&rdquo;</div>
                                            <div class="link-name d-flex justify-content-center">{{ $reviews->user }}
                                            </div>
                                            <div class="link-position d-flex justify-content-center">Customer</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                </section>
        </section>
        <!--review section start -->
        <section class="mb-5">
            <div class="container">
                <div class="card col-11 offset-1 mt-5">
                    <div class="card-header text-center">
                        <div class="section-title">
                            <h2>Review Create</h2>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('review.create') }}" method="post">
                            @csrf
                            <input type="hidden" name="userId" class="ms-2" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="productId" value="{{ $product->id }}">
                            <label for="">Content</label>
                            <textarea name="content" id="" cols="30" rows="3" class="form-control"
                                placeholder="review here..."></textarea>
                            <button type="submit" class="btn btn-success btn-sm ">Create</button>
                            <a href="#" class="btn btn-sm btn-dark float-end my-3">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection

@push('script')
    <script>
        var isWishlist = {{ $isWishlist ? 'true' : 'false' }}
    </script>
    <script src="{{ asset('assets/user/js/addFavorite.js') }}"></script>
    <script src="{{ asset('js/user/add-to-cart.js') }}"></script>
    <script src="{{ asset('js/user/product-detail.js') }}"></script>
@endpush
