@extends('layouts.app')

@section('content')
<div class="login-form">
    <form action="{{route('auth.store')}}" method="post">
    {{ csrf_field() }}
        <div class="form-group mb-0">
            <label>Username <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="name" placeholder="Username" value="{{old('name')}}">
        </div>
        @error('name')
                <small class="text-danger">{{ $message }}</small>
        @enderror

        <div class="form-group mb-0 mt-3">
            <label>Email <span class="text-danger">*</span></label>
            <input class="form-control" type="email" name="email" placeholder="example@gmail.com" value="{{old('email')}}">
        </div>
        @error('email')
                <small class="text-danger">{{ $message }}</small>
        @enderror

        <div class="form-group mb-0 mt-3">
             <label>Password <span class="text-danger">*</span></label>
            <input class="form-control" type="password" name="password" placeholder="******" value="{{old('password')}}">
        </div>
        @error('password')
                <small class="text-danger">{{ $message }}</small>
        @enderror

        <div class="form-group mb-0 mt-3">
            <label>Confirm Password <span class="text-danger">*</span></label>
            <input class="form-control" type="password" name="confirm_password" placeholder="******">
        </div>
        @error('confirm_password')
                <small class="text-danger">{{ $message }}</small>
        @enderror
        
        <button class="text-light pt-2 pb-2 au-btn--block au-btn--orange mt-3" type="submit">REGISTER</button>

    </form>
        <div class="register-link">
            <p>
                Already have account?
                <a class="text-primary" href="{{route('auth.login')}}">Sign In</a>
             </p>
        </div>
 </div>

 @endsection

