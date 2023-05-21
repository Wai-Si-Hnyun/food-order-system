@extends('layouts.app')

@section('content')
<div class="login-form">
    <p class="mb-3">Reset Password</p>
    <form action="{{url('/pass-change')}}" method="post">
    {{ csrf_field() }}
        <div class="form-group">
            <label>Token <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="token" placeholder="Enter your token from your email box" value="{{old('token')}}">
         </div>
         @error('token')
                <span class="text-danger">{{ $message }}</span>
        @enderror

         <div class="form-group">
             <label>Password <span class="text-danger">*</span></label>
            <input class="form-control" type="password" name="password" placeholder="Password" value="{{old('password')}}">
        </div>
        @error('password')
                <span class="text-danger">{{ $message }}</span>
        @enderror

        <div class="form-group">
            <label>Confirm Password <span class="text-danger">*</span></label>
            <input class="form-control" type="password" name="confirm_password" placeholder="Confirm Password" value="{{old('confirm_password')}}">
        </div>
        @error('confirm_password')
                <span class="text-danger">{{ $message }}</span>
        @enderror

        <button class="au-btn au-btn--block au-btn--orange m-b-20" type="submit">Reset Password</button>

    </form>
        <div class="register-link">
        <p>
             Don't you have account?
            <a class="text-primary" href="{{route('auth.registerPage')}}">Sign Up Here</a>
        </p>
        </div>
    </div>

@endsection
