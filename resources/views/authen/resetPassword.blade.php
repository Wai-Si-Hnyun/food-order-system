@extends('layouts.app')

@section('content')
<div class="login-form">
    <p class="mb-3">Reset Password</p>
    <form action="{{route('auth.passChange')}}" method="post">
    {{ csrf_field() }}
        <div class="form-group">
            <label>Token</label>
            <input class="au-input au-input--full" type="text" name="token" placeholder="Enter your token from your email box">
         </div>
         @error('token')
                <span class="text-danger">{{ $message }}</span>
        @enderror

         <div class="form-group">
             <label>Password</label>
            <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
        </div>
        @error('password')
                <span class="text-danger">{{ $message }}</span>
        @enderror

        <div class="form-group">
            <label>Confirm Password</label>
            <input class="au-input au-input--full" type="password" name="confirm_password" placeholder="Confirm Password">
        </div>
        @error('confirm_password')
                <span class="text-danger">{{ $message }}</span>
        @enderror

        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Reset Password</button>

    </form>
        <div class="register-link">
        <p>
             Don't you have account?
            <a href="{{route('auth.registerPage')}}">Sign Up Here</a>
        </p>
        </div>
    </div>

@endsection
