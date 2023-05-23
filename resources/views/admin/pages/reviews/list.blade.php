@extends('admin.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
<div class="d-flex justify-content-between">
<h4 class="fw-bold py-3 mb-4">Reviews List</h4>

<div class="mt-2 col-4">
    <form action="{{route('review.search')}}"  type="get">
        @csrf
        <div class="d-flex">
            <input class="form-control" name="query" type="text" value="{{ request('query') }}" id=""
                placeholder="Enter User Or Product Name">
            <button class='btn btn-sm btn-dark ms-2' type="submit"><i
                    class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </form>
</div>
</div>
        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>Product Name</th>
                        <th>Review</th>
                        <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($review as $reviews)
                        <tr>
                            <td class="table-text idlist">
                                {{ $reviews->id }}
                            </td>
                            <td class="table-text userlist">
                                {{ $reviews->user }}
                            </td>
                            <td class="table-text productlist">
                                {{ $reviews->product }}
                            </td>
                            <td class="table-text commentlist">
                                {{ $reviews->comment }}
                            </td>

                            <td class="actionlist">
                                <button class="btn btn-danger btn-sm" onclick="deleteBtn('{{ $reviews->id }}')"> Delete </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<div class="d-flex justify-content-center">
    {{$review->links()}}
</div>
@push('script')
    <script src="{{ asset('js/admin/review.js') }}"></script>
@endpush
@endsection
