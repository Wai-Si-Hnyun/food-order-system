@extends('admin.layouts.app')
@section('content')
    <div class="container mt-3">
        <h4 class="fw-bold">Categories List</h4>
        <div class='my-3'>
            <h5>Total - ({{ $categories->total() }})</h5>
        </div>
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
        @if (count($categories) != 0)
            <div class="card my-3">
                <div class="table-responsive table--no-card m-b-30">
                    <table class="table table-borderless table-striped table-earning">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Created Date</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td class="text-right">{{ $category->created_at->format('j-F-Y') }}</td>
                                    <td class="text-right d-flex">
                                        <a href="{{ route('categories.edit', $category->id) }}" title="Edit">
                                            <i class='bx bxs-edit-alt me-3 mt-1'></i>
                                        </a>
                                        <form method="POST" action="{{ route('categories.destroy', $category->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button type="submit" class="btn btn-default btn-xs btn-flat show_confirm"
                                                data-toggle="tooltip" title='Delete'>
                                                <i class='bx bxs-trash text-danger'></i>
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
            <h3 class="text-center my-5">There is no Categories Here!</h3>
        @endif
        <div class="mt-3">
            {{ $categories->links() }}
        </div>
    </div>

@endsection
@push('script')
    <script src="{{ asset('js/admin/category.js') }}"></script>
@endpush
