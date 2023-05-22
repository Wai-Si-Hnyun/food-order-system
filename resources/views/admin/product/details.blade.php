@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="col-7 offset-3 mt-5">
            <button class="btn btn-dark btn-sm" onclick="history.back()">Back</button>
        </div>
        <div class="card col-7 offset-3 mt-2">
            <div class="card-header text-center">
                <h4><b> Product Details</b></h4>
            </div>
            <div class="row card-body">
                <div class="col-3">
                    <img class="w-80" src="{{ asset('storage/' . $product->image) }}" class="img-thumbnail shadow-sm">
                </div>
                <div class="col-5 offset-2">
                    <h5 class="mb-4"><i class="fa-solid fa-clipboard-list me-3"></i>{{ $product->category_id }}</h5>
                    <h5 class="mb-4"><i class="fa-solid fa-utensils me-3"></i>{{ $product->name }}</h5>
                    <h5 class="mb-4"><i class="fa-solid fa-money-bill-wave me-3"></i>${{ $product->price }}</h5>
                    <h5 class="mb-4"><i class="fa-regular fa-calendar-days me-3">
                        </i>{{ $product->created_at->format('J-F-Y') }}
                    </h5>
                    <h5 class="mb-4"><i class="fa-solid fa-receipt me-3"></i>{{ $product->description }}</h5>
                </div>
            </div>
        </div>
    </div>
@endsection
