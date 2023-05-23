@extends('layouts.app')

@section('content')
@if (session('alert'))
 <div class="d-flex justify-content-center">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
       <p class="text-center text-danger">Token wrong!please try again.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
 @endif
<div class="login-form">
    <p class="mb-3">Reset Password</p>
    <form action="{{route('auth.passwordChange')}}" method="post">
    {{ csrf_field() }}
        <div class="form-group mb-0">
            <label>Token <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="token" placeholder="Enter your token from your email box" value="{{old('token')}}">
         </div>
         @error('token')
                <small class="text-danger">{{ $message }}</small>
        @enderror

         <div class="form-group mb-0 mt-3">
             <label>New Password <span class="text-danger">*</span></label>
            <input class="form-control" type="password" name="password" placeholder="******" value="{{old('password')}}">
        </div>
        @error('password')
                <small class="text-danger">{{ $message }}</small>
        @enderror

        <div class="form-group mb-0 mt-3">
            <label>Confirm Password <span class="text-danger">*</span></label>
            <input class="form-control" type="password" name="confirm_password" placeholder="******" value="{{old('confirm_password')}}">
        </div>
        @error('confirm_password')
                <small class="text-danger">{{ $message }}</small>
        @enderror

        <button class="au-btn au-btn--block au-btn--orange m-b-20 mt-3" type="submit">Reset Password</button>

    </form>
        <div class="register-link">
        <p>
             Don't you have account?
            <a class="text-primary" href="{{route('auth.login')}}">Sign In Here</a>
        </p>
        </div>
    </div>

@endsection
