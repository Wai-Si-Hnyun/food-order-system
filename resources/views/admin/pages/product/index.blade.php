@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Products List</h4>
        <div class='d-flex justify-content-between mb-3'>
            <h5>Total - ({{ $products->total() }})</h5>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-primary my-2"></i>Create</a>

        <div class="float-end mt-2 col-4">
            <form action="{{ route('products.index') }}" class="" method="get">
                <div class="d-flex">
                    <input class="form-control" name="key" type="text" value="{{ request('key') }}" id=""
                        placeholder="Search..">
                    <button class='btn btn-sm btn-dark ms-2' type="submit"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>
        <div class="d-flex justify-content-end mt-2">
            @if (session('createSuccess'))
                <div class="alert alert-success alert-dismissible fade show w-50" role="alert">
                    {{ session('createSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('deleteSuccess'))
                <div class="alert alert-danger alert-dismissible fade show w-50" role="alert">
                    {{ session('deleteSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('updateSuccess'))
                <div class="alert alert-primary alert-dismissible fade show w-50" role="alert">
                    {{ session('updateSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        @if (count($products) != 0)
            <div class="card mb-3 mt-1">
                <div class="table-responsive text-nowrap">
                    <table class="table table-borderless table-striped table-earning">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th class="text-right">Description</th>
                                <th class="text-right">price</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td class="col-2"><img src="{{ asset('storage/' . $product->image) }}"
                                            class="img-thumbnail shadow-sm" id="product-img"></td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td class="text-right">{{ Str::words($product->description, 2, '...') }}</td>
                                    <td class="text-right">{{ $product->price }}MMK</td>
                                    <td class="text-right d-flex">
                                        <a href="{{ route('products.details', $product->id) }}" title="Detail">
                                            <i class='bx bx-detail text-warning my-5'></i>
                                        </a>
                                        <a href="{{ route('products.edit', $product->id) }}" title="Edit">
                                            <i class='bx bxs-edit-alt my-5 ms-3'></i>
                                        </a>
                                        <form method="POST" action="{{ route('products.destroy', $product->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-default ms-3 btn-xs btn-flat show_confirm"
                                                data-toggle="tooltip" title='Delete'>
                                                <i class='bx bxs-trash text-danger my-5'></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <h4 class="mt-5 text-center">No Products here!</h4>
        @endif
        <div class="mt-3">
            {{ $products->links() }}
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('js/admin/product.js') }}"></script>
@endpush
