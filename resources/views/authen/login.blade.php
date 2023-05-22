@extends('layouts.app')

@section('content')
    @if (session('alert'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
       <p>Email or Password may be wrong.Please try again!</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="login-form">
        <form action="{{ route('auth.loginCheck') }}" method="post">
            @csrf
            <div class="form-group">
                <label>Email Address <span class="text-danger">*</span></label>
                <input class="form-control" type="email" name="email" placeholder="example@gmail.com" value="{{old('email')}}">
            </div>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="form-group">
                <label>Password <span class="text-danger">*</span></label>
                <input class="form-control au-input--full" type="password" name="password" placeholder="******" value="{{old('password')}}">
            </div>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <a href="{{route('auth.forgetPass')}}" class="mb-3 text-primary d-block">forget password?</a>
            <button class="text-light pt-2 pb-2 au-btn--block au-btn--orange m-b-20" type="submit">Sign In</button>

        </form>
        <div class="register-link">
            <p>
                Don't you have account?
                <a class="text-primary" href="{{ route('auth.registerPage') }}">Sign Up Here</a>
            </p>
        </div>
    </div>
@endsection
