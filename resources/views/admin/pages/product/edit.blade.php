@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y" id="form">
        <div class="card col-8 mx-auto mt-5">
            <div class="card-header text-center">
                <h4><b> Edit Product</b></h4>
                <hr>
            </div>
            <div class="card-body">
                <form action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="row">
                        <div class="mx-auto">
                            <div class="form-group mb-3 mx-auto" style="width:280px">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="product image"
                                    class="img-thumbnail shadow-sm" id="changeImg">
                                <input class="form-control mt-2 @error('productImage') is-invalid @enderror" type="file"
                                    name="productImage" id="img-input" onchange="loadFile(event)">
                                @error('productImage')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="col-10 offset-1">
                            <div class="form-group mb-3">
                                <label for="">Category<span class="text-danger">*</span></label>
                                <select name="category" id="category"
                                    class="form-control @error('category') is-invalid @enderror">
                                    <option value="">Choose category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Name<span class="text-danger">*</span></label>
                                <input class="form-control @error('productName') is-invalid @enderror" type="text"
                                    value="{{ old('productName', $product->name) }}" name="productName" id="product-name"
                                    placeholder="Enter Product Name...">
                                @error('productName')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Description<span class="text-danger">*</span></label>
                                <textarea class="form-control @error('productDescription') is-invalid @enderror" name="productDescription"
                                    id="product-description" cols="30" rows="5" placeholder="Enter Description...">{{ old('productDescription', $product->description) }}</textarea>
                                @error('productDescription')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Price<span class="text-danger">*</span></label>
                                <input class="form-control @error('productPrice') is-invalid @enderror" type="number"
                                    value="{{ old('productPrice', $product->price) }}" name="productPrice"
                                    id="product-price" placeholder="Enter price...">
                                @error('productPrice')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-10 offset-1">
                        <input type="submit" value="Update" class="btn btn-info my-3 text-dark" id="btnUpdate">
                        <a href="{{ route('products.index') }}" class="btn btn-dark my-3 ms-5 float-end">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('js/admin/update.js') }}"></script>
@endpush
