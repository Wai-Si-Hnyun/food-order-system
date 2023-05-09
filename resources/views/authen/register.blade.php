@extends('layouts.app')

@section('content')
<div class="login-form">
    <form action="{{route('auth#store')}}" method="post">
    {{ csrf_field() }}
        <div class="form-group">
            <label>Username</label>
            <input class="au-input au-input--full" type="text" name="name" placeholder="Username">
        </div>
        @error('name')
                <span class="text-danger">{{ $message }}</span>
        @enderror

        <div class="form-group">
            <label>Email</label>
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
                <span class="text-danger">{{ $message }}</span>
        @enderror

        <div class="form-group">
            <label>Password</label>
            <input class="au-input au-input--full" type="password" name="confirm_password" placeholder="Confirm Password">
        </div>
        @error('confirm_password')
                <span class="text-danger">{{ $message }}</span>
        @enderror
        <div>
        <a href="#" class="mb-3">forget password?</a>
        </div>

        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>

    </form>
        <div class="register-link">
            <p>
                Already have account?
                <a href="{{route('auth#login')}}">Sign In</a>
             </p>
        </div>
 </div>

 @endsection

