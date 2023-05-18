@extends('admin.layouts.app')
@section('content')
    <div class="container mt-3">
        <a href="{{ route('products.create') }}" class="btn btn-primary my-2"></i>Create</a>

        <div class="float-end mt-2 col-4">
            <form action="{{ route('products.index') }}" class="" method="get">
                @csrf
                <div class="d-flex">
                    <input class="form-control" name="key" type="text" value="{{ request('key') }}" id=""
                        placeholder="Search..">
                    <button class='btn btn-sm btn-dark ms-2' type="submit"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>
        <div class='my-3'>
            <h5>Total - ({{ $products->total() }})</h5>
        </div>
        @if (session('createSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('createSuccess') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('deleteSuccess'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('deleteSuccess') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('updateSuccess'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                {{ session('updateSuccess') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (count($products) != 0)
            <div class="card">
                <div class="card-header">
                    <h4><b>Product Lists</b></h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td class="col-2"><img src="{{ asset('storage/' . $product->image) }}"
                                            class="img-thumbnail shadow-sm"></td>
                                    <td class="col-1">{{ $product->name }}</td>
                                    <td class="col-1">{{ $product->category_name }}</td>
                                    <td class="col-2">{{ Str::words($product->description, 2, '...') }}</td>
                                    <td class="col-1">${{ $product->price }}</td>
                                    <td class="col-3">
                                        <a href="{{ route('products.details', $product->id) }}">
                                            <button class='btn btn-warning'><i class="fa-solid fa-eye"></i></button>
                                        </a>
                                        <a href="{{ route('products.edit', $product->id) }}">
                                            <button class='btn btn-success'><i
                                                    class="fa-solid fa-pen-to-square"></i></button>
                                        </a>
                                        <a href="{{ route('products.destroy', $product->id) }}">
                                            <button class='btn btn-danger'><i class="fa-solid fa-trash-can"></i></button>
                                        </a>
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
