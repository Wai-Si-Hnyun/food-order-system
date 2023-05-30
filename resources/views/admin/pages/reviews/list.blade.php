@extends('admin.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold pb-5">Reviews List</h4>
        <div class="d-flex justify-content-between my-3">
            <h5>Total - (<span id="totalReview">{{ $review->total() }}</span>)</h5>
            <div class="col-4">
                <form action="{{ route('review.search') }}" type="get">
                    <div class="d-flex">
                        <input class="form-control" name="query" type="text" value="{{ request('query') }}" id=""
                            placeholder="Enter User Or Product Name">
                        <button class='btn btn-sm btn-dark ms-2' type="submit"><i
                                class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
        </div>
        @if (count($review) > 0)
            <div class="card">
                <div class="table-responsive text-nowrap">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th>User Name</th>
                                <th>Product Name</th>
                                <th>Review</th>
                                <th>Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($review as $reviews)
                                <tr data-id="{{ $reviews->id }}">
                                    <td class="table-text idlist">
                                        {{ ($review->currentPage() - 1) * $review->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="table-text userlist">
                                        {{ $reviews->user }}
                                    </td>
                                    <td class="table-text productlist">
                                        {{ $reviews->product }}
                                    </td>
                                    <td class="table-text commentlist">
                                        {{ Str::limit($reviews->comment, 40, '...') }}
                                    </td>

                                    <td class="actionlist">
                                        <a class="text-primary me-3" title="Detail"
                                            href="{{ route('review.show', $reviews->id) }}">
                                            <i class="bx bxs-detail me-1"></i>
                                        </a>
                                        <a href="#" class="text-danger" title="Delete"
                                            onclick="deleteBtn('{{ $reviews->id }}')">
                                            <i class="bx bx-trash me-1"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <h4 class="mt-5 text-center">No Review here!</h4>
        @endif
    </div>
    <div class="d-flex justify-content-center">
        {{ $review->appends(['query' => request('query')])->links() }}
    </div>
    @push('script')
        <script src="{{ asset('js/admin/review.js') }}"></script>
    @endpush
@endsection
