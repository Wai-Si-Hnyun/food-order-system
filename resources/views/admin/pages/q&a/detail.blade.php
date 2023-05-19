@extends('admin.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Questions&Answers /</span>Detail</h4>
    <a href="{{ route('q&a.index') }}" class="btn btn-dark mb-3">Back</a>
    <div class="card">
        <div class="card-body">
            <ul class="list-group col-5">
                <li class="list-group-item">Question&nbsp;-&nbsp; {{ $qaData->question }}</li>
                <li class="list-group-item">Answer&nbsp;-&nbsp; {{ $qaData->answer }}</li>
            </ul>
        </div>
    </div>
</div>
@endsection