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
                                <div class="product__item__pic set-bg">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt=""
                                        style="height:200px">
                                    <div class="product__label">
                                        <span><a class="text-dark"
                                                href="{{ route('users.details', $product->id) }}">Foods</a></span>
                                    </div>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="#">{{ $product->name }}</a></h6>
                                    <div class="product__item__price">${{ $product->price }}</div>
                                    <div class="cart_add">
                                    <form action="{{ url('add-cart/'.$product->id) }}" method="post">
                                        @csrf
                                        <input type="hidden" value="1" name="quantity">
                                        <button type="submit" class="border border-warning">Add to cart</button>
                                    </form>
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
@section('scriptSource')
    <script>
        $(document).ready(function() {
            $('#sorting').change(function() {
                $option = $('#sorting').val();
                console.log($option);
                if ($option == 'asc') {
                    $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/ajax/products',
                        data: {
                            'status': 'asc'
                        },
                        dataType: 'json',
                        success: function(response) {
                            $list = '';
                            for ($i = 0; $i < response.length; $i++) {
                                $list += '';
                                for ($i = 0; $i < response.length; $i++) {
                                    $list += `
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                 <div class="product__item" id="myForm">
                                    <div class="product__item__pic set-bg">
                                        <img src="{{ asset('storage/${response[$i] . image}') }}" alt="" style="height:200px">
                                        <div class="product__label">
                                            <span>Foods</span>
                                        </div>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="#">${response[$i].name}</a></h6>
                                        <div class="product__item__price">$${ response[$i].price }</div>
                                        <div class="cart_add">
                                            <a href="#">Add to cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                `;
                                }
                            }
                            $('#dataList').html($list);
                        }
                    })
                } else if ($option == 'desc') {
                    $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/ajax/products',
                        data: {
                            'status': 'desc'
                        },
                        dataType: 'json',
                        success: function(response) {
                            $list = '';
                            for ($i = 0; $i < response.length; $i++) {
                                $list += '';
                                for ($i = 0; $i < response.length; $i++) {
                                    $list += `
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="product__item" id="myForm">
                                        <div class="product__item__pic set-bg">
                                            <img src="{{ asset('storage/${response[$i] . image}') }}" alt="" style="height:200px">
                                            <div class="product__label">
                                                <span>Foods</span>
                                            </div>
                                        </div>
                                        <div class="product__item__text">
                                            <h6><a href="#">${response[$i].name}</a></h6>
                                            <div class="product__item__price">$${ response[$i].price }</div>
                                            <div class="cart_add">
                                                <a href="#">Add to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `;
                                }
                            }
                            $('#dataList').html($list);
                        }
                    })
                }
            })
        })
    </script>
@endsection
