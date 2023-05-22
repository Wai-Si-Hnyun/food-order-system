@extends('layouts.app')

@section('content')



<div class="login-form">
    <p class="mb-3">Forget Password</p>
    <form action="{{route('auth.forgetCreate')}}" method="post">
    {{ csrf_field() }}
        <div class="form-group">
            <label>Email <span class="text-danger">*</span></label>
            <input class="form-control" type="email" name="email" placeholder="Email">
         </div>

        @if(session('alert'))
            <span class="text-danger">{!! session('alert') !!}</span>
        @endif
        <button class="au-btn au-btn--block au-btn--orange m-b-20" type="submit">Send</button>

    </form>
        <div class="register-link">
        <p>
             Don't you have account?
            <a class="text-primary" href="{{route('auth.registerPage')}}">Sign Up Here</a>
        </p>
        </div>
    </div>

@endsection
