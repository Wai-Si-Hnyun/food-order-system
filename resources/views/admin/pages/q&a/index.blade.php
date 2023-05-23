@extends('admin.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Questions and Answers for Chatbot</h4>
        <div id="success"></div>
        @if (session()->has('success'))
            <div class="alert alert-success w-50 fade" id="successAlert" role="alert">
                {{ session()->get('success') }}
            </div>
        @endif
        <a href="{{ route('q&a.create') }}" class="btn btn-primary mb-4">Create</a>
        <div class="row mb-5">
            @forelse ($qaData as $qa)
                <div class="col-md-6 col-lg-4 d-flex align-items-stretch" id="qa-{{ $qa->id }}">
                    <div class="card mb-3 w-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $qa->question }}</h5>
                            <p class="card-text">{{ Str::limit($qa->answer, 100, '...') }}</p>
                            <div class="mt-auto d-flex justify-content-between">
                                <a href="{{ route('q&a.show', $qa->id) }}" class="btn btn-info">Detail</a>
                                <a href="{{ route('q&a.edit', $qa->id) }}" class="btn btn-secondary">Edit</a>
                                <a href="#" class="btn btn-danger delete" data-id="{{ $qa->id }}">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-danger text-center">There is no question and answer.</div>
            @endforelse
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('js/admin/qasection.js') }}"></script>
@endpush
