@extends('layouts.app')

@section('content')
<div class="login-form">
    <p class="mb-3">Change Password</p>
    <form action="{{route('password.change')}}" method="post">
    {{ csrf_field() }}
        <input type="hidden" value="{{$user->id}}" name="id">
        <div class="form-group">
            <label>Old Password</label>
            <input class="au-input au-input--full" type="password" name="old_password" placeholder="Enter your old password">
         </div>
         @error('old_password')
                <span class="text-danger">{{ $message }}</span>
        @enderror

         <div class="form-group">
             <label>New Password</label>
            <input class="au-input au-input--full" type="password" name="password" placeholder="New Password">
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

        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Change Password</button>

    </form>
        <div class="register-link">
        <p>
             forget Password?
            <a href="{{route('auth.forgetPass')}}">Click Here</a>
        </p>
        </div>
    </div>

@endsection
