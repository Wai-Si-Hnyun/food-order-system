@extends('admin.layouts.app')
@section('content')
    <div class="container mt-3">
        <h4 class="fw-bold">Products List</h4>
        <div class='mt-4 mb-1'>
            <h5>Total - ({{ $products->total() }})</h5>
        </div>
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
                <div class="table-responsive table--no-card m-b-30">
                    <h4 class="card-header">
                        Product Lists
                    </h4>
                    <div class="card-body">
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
                                        <td class='col-2'><img src="{{ asset('storage/' . $product->image) }}"
                                                class="img-thumbnail shadow-sm"></td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category_name }}</td>
                                        <td class="text-right">{{ Str::words($product->description, 2, '...') }}</td>
                                        <td class="text-right">${{ $product->price }}</td>
                                        <td class="text-right">
                                            <a href="{{ route('products.details', $product->id) }}">
                                                <i class='bx bx-detail text-warning'></i>
                                            </a>
                                            <a href="{{ route('products.edit', $product->id) }}">
                                                <i class='bx bxs-edit-alt'></i>
                                            </a>
                                            <a href="{{ route('products.destroy', $product->id) }}">
                                                <i class='bx bxs-trash text-danger'></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
