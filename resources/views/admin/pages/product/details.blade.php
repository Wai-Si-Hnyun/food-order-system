@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card col-8 mx-auto mt-5">
            <div class="card-header text-center">
                <h4><b> Product Details</b></h4>
                <hr>
            </div>
            <div class="row card-body">
                <div class="col-5">
                    <img src="{{ asset('storage/' . $product->image) }}" class="img-thumbnail shadow-sm ms-5" id="product-img"
                        style="height:200px">
                </div>
                <div class="col-5 offset-1" id='data'>
                    <h6 class="mb-4"><i class="fa-regular fa-file-code me-3"></i>{{ $product->category_id }}</h6>
                    <h6 class="mb-4"><i class="fa-solid fa-burger me-3"></i>{{ $product->name }}</h6>
                    <h6 class="mb-4"><i class="fa-solid fa-money-bill-wave me-3"></i>{{ $product->price }} MMK</h6>
                    <h6 class="mb-4"><i class="fa-regular fa-calendar-days me-3">
                        </i>{{ $product->created_at->format('j-F-Y') }}
                    </h6>
                    <h6 class="mb-4"><i class="fa-solid fa-receipt me-3"></i>{{ $product->description }}</h6>
                    <button class="btn btn-dark float-end " onclick="history.back()">Back</button>
                </div>
            </div>
        </div>
    </div>
@endsection
