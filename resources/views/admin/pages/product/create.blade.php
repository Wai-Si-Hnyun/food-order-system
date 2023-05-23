@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="card col-8 mx-auto mt-5 mb-5">
            <div class="card-header text-center">
                <h4><b> Create Product</b></h4>
                <hr>
            </div>
            <div class="card-body">
                <form action="{{ route('products.store') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="">Category</label>
                        <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                            <option value="">Choose category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Name</label>
                        <input class="form-control @error('productName') is-invalid @enderror" type="text"
                            value="{{ old('productName') }}" name="productName" id="product-name"
                            placeholder="Enter Product Name...">
                        @error('productName')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Image</label>
                        <input class="form-control @error('productImage') is-invalid @enderror" type="file"
                            name="productImage" id="product-image">
                        @error('productImage')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Description</label>
                        <textarea class="form-control @error('productDescription') is-invalid @enderror" name="productDescription"
                            id="product-description" cols="30" rows="5" placeholder="Enter Description...">{{ old('productDescription') }}</textarea>
                        @error('productDescription')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Price</label>
                        <input class="form-control @error('productPrice') is-invalid @enderror" type="number"
                            value="{{ old('productPrice') }}" name="productPrice" id="product-price"
                            placeholder="Enter price...">
                        @error('productPrice')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <input type="submit" value="Create" class="btn btn-info my-3 text-dark">
                    <a href="{{ route('products.index') }}" class="btn btn-dark float-end my-3">Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection
