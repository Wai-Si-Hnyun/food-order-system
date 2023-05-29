@extends('admin.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Questions and Answers for Chatbot</h4>
        <h5>Total - ({{ count($qaData) }})</h5>
        <div id="success"></div>
        @if (session('createSuccess'))
            <div class="alert alert-success alert-dismissible fade show w-50" role="alert">
                {{ session('createSuccess') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="mt-5 d-flex justify-content-between">
            <a href="{{ route('q&a.create') }}" class="btn btn-primary mb-4">Create</a>
            <form action="{{ route('q&a.index') }}" method="get">
                <div class="d-flex">
                    <input class="form-control" name="key" type="text" value="{{ request('key') }}" id="key"
                        placeholder="Search..">
                    <button class='btn btn-sm btn-dark ms-2' type="submit"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>
        <div class="row mb-5">
            @forelse ($qaData as $qa)
                <div class="col-md-6 col-lg-4 d-flex align-items-stretch qa-card" id="qa-{{ $qa->id }}">
                    <div class="card mb-3 w-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $qa->question }}</h5>
                            <p class="card-text">{{ Str::limit($qa->answer, 100, '...') }}</p>
                            <div class="mt-auto d-flex justify-content-between">
                                <a href="{{ route('q&a.show', $qa->id) }}" class="btn btn-info">
                                    <i class="bx bxs-detail"></i>
                                </a>
                                <a href="{{ route('q&a.edit', $qa->id) }}" class="btn btn-secondary">
                                    <i class='bx bxs-edit-alt'></i>
                                </a>
                                <a href="#" class="btn btn-danger delete" data-id="{{ $qa->id }}">
                                    <i class="bx bx-trash"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h4 class="text-center my-5">There is no Question and Answer Here!</h4>
            @endforelse
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('js/admin/qasection.js') }}"></script>
@endpush
