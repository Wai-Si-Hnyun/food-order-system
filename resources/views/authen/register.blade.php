@extends('layouts.app')

@section('content')
<div class="login-form">
    <form action="{{route('auth.store')}}" method="post">
    {{ csrf_field() }}
        <div class="form-group">
            <label>Username <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="name" placeholder="Username" value="{{old('name')}}">
        </div>
        @error('name')
                <span class="text-danger">{{ $message }}</span>
        @enderror

        <div class="form-group">
            <label>Email <span class="text-danger">*</span></label>
            <input class="form-control" type="email" name="email" placeholder="example@gmail.com" value="{{old('email')}}">
        </div>
        @error('email')
                <span class="text-danger">{{ $message }}</span>
        @enderror

        <div class="form-group">
             <label>Password <span class="text-danger">*</span></label>
            <input class="form-control" type="password" name="password" placeholder="******" value="{{old('password')}}">
        </div>
        @error('password')
                <span class="text-danger">{{ $message }}</span>
        @enderror

        <div class="form-group">
            <label>Confirm Password <span class="text-danger">*</span></label>
            <input class="form-control" type="password" name="confirm_password" placeholder="******" value="{{old('confirm_password')}}">
        </div>
        @error('confirm_password')
                <span class="text-danger">{{ $message }}</span>
        @enderror
        <div>
        <a href="{{route('auth.forgetPass')}}" class="mb-3">forget password?</a>
        </div>

        <button class="text-light pt-2 pb-2 au-btn--block au-btn--orange m-b-20" type="submit">REGISTER</button>

    </form>
        <div class="register-link">
            <p>
                Already have account?
                <a class="text-primary" href="{{route('auth.login')}}">Sign In</a>
             </p>
        </div>
 </div>

 @endsection

