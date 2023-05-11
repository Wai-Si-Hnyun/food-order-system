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
                            <form action="{{ route('users.home') }}">
                                @csrf
                                <select>
                                    <option value="">Categories</option>
                                    @foreach ($categories as $category)
                                        <option value="">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <input type="text" name="key" value="{{ request('key') }}" placeholder="Search">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5">
                        <div class="shop__option__right">
                            <select id="sorting" name="sorting">
                                <option value="">Default sorting</option>
                                <option value="asc">Asending</option>
                                <option value="desc">Desending</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="" style="height:200px">
                                <div class="product__label">
                                    <span>Foods</span>
                                </div>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">{{ $product->name }}</a></h6>
                                <div class="product__item__price">${{ $product->price }}</div>
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
    <!-- Shop Section End -->
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            //     $.ajax({
            //         type: 'get',
            //         url: 'http://127.0.0.1:8000/ajax/products',
            //         dataType: 'json',
            //         success: function(response) {
            //             console.log(response);
            //         }
            //     })
        })
        $('#sorting').change(function() {
            $option = $('#sorting').val();
            console.log($option);
            if ($option == 'desc') {
                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/ajax/products',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                    }
                })
            } else if ($option == 'asc') {
                console.log('ascending');
            }
        });
    </script>
@endsection
