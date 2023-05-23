@extends('layouts.app')
@section('content')

@if (session('alert'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
       <p class="text-center text-success">Password change successfully.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
 @endif

 @if (session('message'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
       <p class="text-center text-danger">Your password is not found.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
 @endif

<div class="login-form">
    <p class="mb-3">Change Password</p>
    <form action="{{route('password.change')}}" method="post">
    {{ csrf_field() }}
        <input type="hidden" value="{{$user->id}}" name="id">
        <div class="form-group">
            <label>Old Password <span class="text-danger">*</span></label>
            <input class="form-control" type="password" name="old_password" placeholder="Enter your old password" value="{{old('old_password')}}">
         </div>
         @error('old_password')
                <small class="text-danger">{{ $message }}</small>
        @enderror

         <div class="form-group">
             <label>New Password <span class="text-danger">*</span></label>
            <input class="form-control" type="password" name="password" placeholder="New Password" value="{{old('password')}}">
        </div>
        @error('password')
                <small class="text-danger">{{ $message }}</small>
        @enderror

        <div class="form-group">
            <label>Confirm Password <span class="text-danger">*</span></label>
            <input class="form-control" type="password" name="confirm_password" placeholder="Confirm Password" value="{{old('confirm_password')}}">
        </div>
        @error('confirm_password')
                <small class="text-danger">{{ $message }}</small>
        @enderror
        <div class="d-flex justify-content-between">
        <a href="{{route('admin.dashboard')}}" class="text-white  m-b-20 btn btn-sm btn-secondary" >Back</a>
        <button class="text-white au-btn--orange m-b-20 btn btn-sm" type="submit">Submit</button>
        </div>

    </form>
        <div class="register-link">
        <p>
             forget Password?
            <a href="{{route('auth.forgetPass')}}" class="text-primary">Click Here</a>
        </p>
        </div>
    </div>

@endsection
