@extends('admin.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Review /</span> Review Detail</h4>
    <a href="{{ route('review.list') }}" class="btn btn-dark mb-3">Back</a>
    <div class="card">
        <h5 class="card-header">Review Details</h5>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item">Reviewer&nbsp;-&nbsp; {{ $review->user->name }}</li>
                <li class="list-group-item">Reviewed Item&nbsp;-&nbsp; {{ $review->product->name }}</li>
                <li class="list-group-item">Comment&nbsp;-&nbsp; {{ $review->comment }}</li>
            </ul>
        </div>
    </div>
</div>
@endsection