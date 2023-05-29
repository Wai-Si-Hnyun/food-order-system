@extends('user.layouts.app')

@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__text">
                        <h2>Shop</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="{{ route('home') }}">Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="shop__option">
                <div class="row">
                    <div class="col-lg-7 col-md-7">
                        <div class="shop__option__search">
                            <form action="{{ route('users.shop') }}">
                                <select id="filterByCategory">
                                    <option value="all">All</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <input type="text" name="key" value="{{ request('key') }}" old="{{ request('key') }}"
                                    placeholder="Search">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5">
                        <div class="shop__option__right">
                            <select id="sorting" name="sorting">
                                <option value="">Sorting By</option>
                                <option value="asc">Price low to high</option>
                                <option value="desc">Price high to low</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5" id='dataList'>
                @if (count($products) != 0)
                    @foreach ($products as $product)
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="product__item" id="myForm">
                                <div class="product__item__pic set-bg detail-view" data-id="{{ $product->id }}"
                                    data-setbg="{{ asset('storage/' . $product->image) }}" style="cursor: pointer">
                                    <div class="product__label">
                                        <span>
                                            {{ $product->category->name }}
                                        </span>
                                    </div>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="#">{{ $product->name }}</a></h6>
                                    <div class="product__item__price">{{ $product->price }} MMK</div>
                                    <div class="cart_add" data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                        data-price="{{ $product->price }}" data-image="{{ $product->image }}"
                                        data-quantity="1">
                                        <a href="#" class="add-to-cart-btn">Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h3 class="text-center mx-auto py-5 my-5">Product not Found Sorry!<i class="fa-regular fa-face-frown"></i></h3>
                @endif
            </div>
        </div>
        </div>
    </section>
    <!-- Shop Section End -->
@endsection

@push('script')
    <script src="{{ asset('js/user/add-to-cart.js') }}"></script>
    <script src="{{ asset('js/user/shop.js') }}"></script>
@endpush
