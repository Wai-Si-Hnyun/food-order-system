@extends('admin.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Feedback /</span> Feedback Detail</h4>
    <a href="{{ route('feedback.list') }}" class="btn btn-dark mb-3">Back</a>
    <div class="card">
        <h5 class="card-header">Feedback Details</h5>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item">Name&nbsp;-&nbsp; {{ $feedback->name }}</li>
                <li class="list-group-item">Email&nbsp;-&nbsp; {{ $feedback->email }}</li>
                <li class="list-group-item">Message&nbsp;-&nbsp; {{ $feedback->message }}</li>
            </ul>
        </div>
    </div>
</div>
@endsection