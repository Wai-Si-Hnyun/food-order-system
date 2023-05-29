@extends('layouts.app')
@section('content')

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
    <form action="{{route('password.change')}}" method="post" id="passChgForm">
    {{ csrf_field() }}
        <input type="hidden" value="{{$user->id}}" name="id">
        <div class="form-group mb-0">
            <label>Old Password <span class="text-danger ">*</span></label>
            <input class="form-control" type="password" name="old_password" placeholder="Enter your old password">
         </div>
         @error('old_password')
                <small class="text-danger">{{ $message }}</small>
        @enderror

         <div class="form-group mb-0 mt-3">
             <label>New Password <span class="text-danger ">*</span></label>
            <input class="form-control" type="password" name="password" placeholder="New Password">
        </div>
        @error('password')
                <small class="text-danger">{{ $message }}</small>
        @enderror

        <div class="form-group mb-0 mt-3">
            <label>Confirm Password <span class="text-danger">*</span></label>
            <input class="form-control" type="password" name="confirm_password" placeholder="Confirm Password">
        </div>
        @error('confirm_password')
                <small class="text-danger">{{ $message }}</small>
        @enderror
        <div class="d-flex justify-content-between mt-3">
        @if(Auth::user()->role == "admin")
        <a href="{{route('admin.dashboard')}}" class="text-white  m-b-20 btn btn-sm btn-secondary" onclick="history.back()">Back</a>
        <button class="text-white au-btn--orange m-b-20 btn btn-sm update-password-btn" type="submit">Submit</button>
        @else
        <a href="{{route('home')}}" class="text-white  m-b-20 btn btn-sm btn-secondary" onclick="history.back()">Back</a>
        <button class="text-white au-btn--orange m-b-20 btn btn-sm update-password-btn" type="submit">Submit</button>
        @endif
        </div>

    </form>
        <div class="register-link">
        <p>
             forget Password?
            <a href="{{route('auth.forgetPass')}}" class="text-primary">Click Here</a>
        </p>
        </div>
    </div>
<script>
    $('.update-password-btn').on('click',function confirmSubmit(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Are you sure?',
            text: 'This action cannot be undone!',
            icon: 'warning',
            showCancelButton: true,
        }).then(res => {
            $('#passChgForm').submit();
        })
    })
</script>
@endsection
