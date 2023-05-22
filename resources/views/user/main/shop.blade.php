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
                <div class="row mb-5">
                    <div class="col-lg-7 col-md-7">
                        <div class="shop__option__search row mb-5">

                            <form action="{{ route('users.shop') }}" class="row">
                                @csrf

                                <div class="dropdown" class="col-4 my-3">
                                    <a class="btn btn-light text-black dropdown-toggle py-2" href="#" role="button"
                                        id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                        Categories
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMendivink">
                                        <div>
                                            <a class="dropdown-item" href="{{ route('users.shop') }}">All
                                            </a>
                                        </div>
                                        @foreach ($categories as $category)
                                            <div>
                                                <a class="dropdown-item"
                                                    href="{{ route('users.filter', $category->id) }}">{{ $category->name }}
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-7 offset-1">
                                    |<input type="text" name="key" value="{{ request('key') }}" placeholder="Search">
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5">
                        <div class="shop__option__right">
                            <select id="sorting" name="sorting">
                                <option value="">Sorting By</option>
                                <option value="asc">Asending</option>
                                <option value="desc">Desending</option>
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
                                    <div class="product__item__price">${{ $product->price }}</div>
                                    <div class="cart_add" data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                        data-user_id="{{ Auth::check() ? Auth::user()->id : 'guest' }}"
                                        data-price="{{ $product->price }}" data-image="{{ $product->image }}"
                                        data-quantity="1">
                                        <a href="#" class="add-to-cart-btn">Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h3 class="text-center mx-auto">Product not Found Sorry!<i class="fa-regular fa-face-frown"></i></h3>
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
