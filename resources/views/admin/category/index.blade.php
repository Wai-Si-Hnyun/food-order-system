@extends('admin.layouts.app')
@section('content')
    <div class="container col-8 offset-2 mt-3">
        <a href="{{ route('categories.create') }}" class="btn btn-primary my-2">Create</a>

        <div class="float-end mt-2 col-4">
            <form action="{{ route('categories.index') }}" class="" method="get">
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
            <h5>Total - ({{ $categories->total() }})</h5>
        </div>
        @if (session('createSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('createSuccess') }}
            </div>
        @endif
        @if (session('deleteSuccess'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('deleteSuccess') }}
            </div>
        @endif
        @if (session('updateSuccess'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                {{ session('updateSuccess') }}
            </div>
        @endif
        @if (count($categories) != 0)
            <div class="card">
                <div class="card-header">
                    <h4><b>Category Lists</b></h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Created Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }} </td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->created_at->format('j-F-Y') }}</td>
                                    <td>
                                        <a href="{{ route('categories.edit', $category->id) }}">
                                            <button class='btn btn-sm btn-success'><i
                                                    class="fa-solid fa-pen-to-square"></i></button>
                                        </a>
                                        <a href="{{ route('categories.destroy', $category->id) }}">
                                            <button class='btn btn-sm btn-danger'><i
                                                    class="fa-solid fa-trash-can"></i></button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <h3 class="text-center my-5">There is no Category Here!</h3>
        @endif
        <div class="mt-3">
            {{ $categories->links() }}
        </div>
    </div>
@endsection
