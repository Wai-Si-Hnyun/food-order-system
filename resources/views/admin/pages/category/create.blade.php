@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="card col-7 mt-5 mx-auto">
            <div class="card-header text-center">
                <h4><b> Category Create</b></h4>
                <hr>
            </div>
            <div class="card-body">
                <form action="{{ route('categories.store') }}" method="post">
                    @csrf
                    <label for="">Category</label>
                    <input class="form-control @error('categoryName') is-invalid @enderror" type="text"
                        value="{{ old('categoryName') }}" name="categoryName" id="category-name" placeholder="Name...">
                    @error('categoryName')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <input type="submit" value="Create" class="btn btn-info my-3 text-dark" autofocus>
                    <a href="{{ route('categories.index') }}" class="btn btn-dark float-end my-3">Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection
