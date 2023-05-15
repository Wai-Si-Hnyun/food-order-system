@extends('layouts.app')

@section('content')

<div class="login-form">
    <form action="{{route('auth#loginCheck')}}" method="post">
    {{ csrf_field() }}
        <div class="form-group">
            <label>Email Address</label>
            <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
         </div>
         @error('email')
                <span class="text-danger">{{ $message }}</span>
        @enderror

         <div class="form-group">
            <label>Password</label>
            <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
        </div>
        @error('password')
                <p class="text-danger">{{ $message }}</p>
        @enderror

        @if(session('alert'))
            <p class="text-danger">{!! session('alert') !!}</p>
        @endif

        <a href="{{route('auth#forgetPass')}}" class="mb-3">forget password?</a>
        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>

        </form>
        <div class="register-link">
        <p>
             Don't you have account?
            <a href="{{route('auth#registerPage')}}">Sign Up Here</a>
        </p>
        </div>
    </div>

@endsection
