@extends('admin.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Mail</h4>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible border border-success mx-auto col-lg-8 col-md-9 col-sm-10" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="col-lg-8 col-md-9 col-sm-10 mx-auto my-5 border border-gray-50 p-sm-5 p-2">
            <h4 class="text-center pb-3">Email Form</h4>
            <form action="{{ route('mail.send') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="recipient_email" class="form-label">Recipient Email:</label>
                    <input type="email" name="recipient_email" id="recipient_email" value="{{ old('recipient_email') }}"
                        class="form-control @error('recipient_email') is-invalid @enderror">
                    @error('recipient_email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="recipient_name" class="form-label">Name:</label>
                    <input type="text" name="recipient_name" id="recipient_name" value="{{ old('recipient_name') }}"
                        class="form-control @error('recipient_name') is-invalid @enderror">
                    @error('recipient_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label">Subject:</label>
                    <input type="text" name="subject" id="subject" value="{{ old('subject') }}"
                        class="form-control @error('subject') is-invalid @enderror">
                    @error('subject')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="body" class="form-label">Body:</label>
                    <textarea name="body" id="body" class="form-control @error('body') is-invalid @enderror" rows="5">{{ old('body') }}</textarea>
                    @error('body')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Send Email</button>
            </form>
        </div>
    </div>
@endsection
