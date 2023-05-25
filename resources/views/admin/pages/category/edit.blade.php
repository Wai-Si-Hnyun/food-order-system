@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="card col-8 mx-auto mt-5">
            <div class="card-header text-center">
                <h4><b> Category Edit</b></h4>
                <hr>
            </div>
            <div class="card-body">
                <form action="{{ route('categories.update', $category->id) }}" method="post">
                    @csrf
                    <label for="">Category</label>
                    <input type="hidden" name="categoryId" value="{{ $category->id }}">
                    <input class="form-control @error('categoryName') is-invalid @enderror" type="text"
                        value="{{ old('categoryName', $category->name) }}" name="categoryName" id="category-name"
                        placeholder="Name..." autofocus>
                    @error('categoryName')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <input type="submit" value="Update" class="btn btn-info my-3 text-dark">
                    <a href="{{ route('categories.index') }}" class="btn btn-dark float-end my-3">Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection
