@extends('user.layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/re') }}" >
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
                        <a href="#">Home</a>
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
                <div class="col-lg-5">
                    <div class="product__details__img">
                        <div class="">
                            <img class="img-thumbnail w-75" src="{{ asset('storage/' . $products->image) }}"
                                alt="productimg">
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    @if (session('addSuccess'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ session('addSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
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
                            <form action="{{ url('add-cart/'.$products->id) }}" method="post" class="d-inline-block ">
                                @csrf
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" name="quantity" value="3">
                                    </div>
                                </div>
                                <button type="submit" class="primary-btn border border-0">Add to cart</button>
                            </form>
                            <a href="{{ route('users.storeWishlist', ['productId' => $products->id]) }}">
                                <button type="submit" class="btn btn-outline-warning btn-lg heart__btn  mr-3">
                                    <span class="icon_heart_alt"></span>
                                </button>
                            </a>
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
                                            <a href="{{ route('users.details', $list->id) }}" class="text-dark">Foods</a>
                                        </span>
                                    </div>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="#">{{ $list->name }}</a></h6>
                                    <div class="product__item__price">${{ $list->price }}</div>
                                    <div class="cart_add">
                                    <form action="{{ url('add-cart/' . $list->id) }}" method="post">
                                        @csrf
                                        <input type="hidden" value="1" name="quantity">
                                        <button type="submit" class="border border-warning">Add to cart</button>
                                    </form>
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
                                <h4><img src="https://img.icons8.com/ultraviolet/40/000000/quote-left.png"></h4>
                                <div class="tour-text color-grey-3 text-center">&ldquo; {{$reviews->comment}}&rdquo;</div>
                                <div class="link-name d-flex justify-content-center">{{$reviews->user}}</div>
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
                <form action="{{route('review.create')}}" method="post">
                    @csrf
                    <input type="hidden" name="userId" class="ms-2" value="{{$user->id}}">
                    <input type="hidden" name="productId" value="{{ $products->id }}">
                    <label for="">Content</label>
                    <textarea name="content" id="" cols="30" rows="3" class="form-control" >Good</textarea>
                    <button type="submit" class="btn btn-success btn-sm ">Create</button>
                    <a href="#" class="btn btn-sm btn-dark float-end my-3">Back</a>
                </form>
            </div>
        </div>
    </div>
    </section>
C
@endsection
