@extends('layouts.app')

@section('content')

@if (session('alert'))
 <div class="d-flex justify-content-center">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
       <p class="text-center text-danger">Email not found! Please,try again.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
 @endif

<div class="login-form">
    <p class="mb-3">Forget Password</p>
    <form action="{{route('auth.forgetCreate')}}" method="post">
    {{ csrf_field() }}
        <div class="form-group mb-0">
            <label>Email <span class="text-danger">*</span></label>
            <input class="form-control" type="email" name="email" placeholder="example@gmail.com">
         </div>

         @error('email')
                <small class="text-danger">{{ $message }}</small>
        @enderror

        <button class="au-btn au-btn--block au-btn--orange m-b-20 mt-3" type="submit">Send</button>

    </form>
        <div class="register-link">
        <p>
             Don't you have account?
            <a class="text-primary" href="{{route('auth.login')}}">Sign In Here</a>
        </p>
        </div>
    </div>

@endsection
