@extends('admin.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Q&A /</span> Edit</h4>
        <div class="card col-7 mx-auto mt-5">
            <div class="card-header text-center">
                <h4><b>Edit Questions and Answers</b></h4>
                <hr>
            </div>
            <div class="card-body">
                <form action="{{ route('q&a.update', $qa->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="question">Question<span class="text-danger">*</span></label>
                        <input class="form-control @error('question') is-invalid @enderror" name="question" id="question"
                            type="text" value="{{ $qa->question }}">
                        @error('question')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="answer">Answer<span class="text-danger">*</span></label>
                        <textarea class="form-control @error('answer') is-invalid @enderror" 
                            name="answer" id="answer" cols="30" rows="10">{{ $qa->answer }}</textarea>
                        @error('answer')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('q&a.index') }}" class="btn btn-dark">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
