@extends('layouts.master')

@section('content')
@error('image')
<div class="d-flex justify-content-center">
    <div class="alert alert-danger alert-dismissable w-50">
          <a class="panel-close close" data-dismiss="alert">×</a>
           {{$message}}
    </div>
</div>
@enderror
<div class="col-7 offset-3 mt-5">
    <button class="btn btn-dark btn-sm" onclick="history.back()">Back</button>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-lg-6 mb-4 mb-lg-0">
        <div class="card mb-3" style="border-radius: .5rem;">
          <div class="row g-0">
            <div class="col-md-4 gradient-custom text-center text-white bg-light"
              style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
              @if($user->image == null)
              <img src="{{asset('image/profile.png') }}"
                alt="Avatar" class="img-fluid my-5" style="width: 80px;" />
              @else
              <img src="{{asset('image/profile/'.$user->image) }}"
                alt="Avatar" class="avatar img-circle mt-4 mb-3" />
             @endif

              <h5>{{$user->name}}</h5>
              @if($user->role == 'user' )
              <p class="text-dark">Customer</p>
              @else
              <p class="text-dark">Admin</p>
              @endif
              <i class="far fa-edit mb-5"></i>
            </div>
            <div class="col-md-8">
              <div class="card-body p-4">
                <h6>Information</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                  <div class="col-8 mb-3">
                    <h6>Email</h6>
                    <p class="text-muted ">{{$user->email}}</p>
                  </div>
                @if($user->role == 'user' )
                  <div class="col-4 mb-3">
                    <h6>Your Role</h6>
                    <p class="text-muted">User</p>
                  </div>
                @else
                  <div class="col-4 mb-3">
                    <h6>Your Role</h6>
                    <p class="text-muted">Admin</p>
                  </div>
                @endif
                </div>
                <h6>Setting</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                  <div class="col-8 mb-3">
                    <h6>Password Setting</h6>
                    <a href="{{url('password/'.$user->id)}}" class="text-success">Change Password</a>
                  </div>
                  <div class="col-4 mb-3">
                    <h6>Update Profile</h6>
                    <a href="#" class="text-primary"  id="update-button">Update</a>
                  </div>
                </div>
                <div class="d-flex justify-content-between">
                  <div>
                    <a href="#!"><i class="fab fa-facebook-f fa-lg me-3"></i></a>
                    <a href="#!"><i class="fab fa-twitter fa-lg me-3"></i></a>
                    <a href="#!"><i class="fab fa-instagram fa-lg"></i></a>
                  </div>
                  <div>
                  <form action="{{url('delete-account/'.$user->id)}}" method="POST" id="delete-account-form">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                     <button type="submit" class="btn btn-danger btn-sm  delete-account-btn"> Delete Account</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--update -->
    <div class="container bootstrap snippets bootdey w-75 d-none" id="my-div">
    <hr>
    <h3 class="text-primary mt-5">Edit Profile</h3>
    <hr>
	<div class="row">
      <!-- left column -->
      <div class="col-md-4">
        <div class="text-center">
        @if($user->image == null)
          <img src="{{asset('image/profile.png') }}" class="avatar img-circle img-thumbnail w-50 h-50" alt="avatar"  >
        @else
        <img src="{{asset('image/profile/'.$user->image) }}" class="img-thumbnail rounded-circle" alt="avatar"  >
        @endif
          <h6 class="mb-2 mt-2">Upload a different photo...</h6>
        </div>
      </div>

      <!-- edit form column -->
      <div class="col-md-8 personal-info">
        <h6 class="mt-2">Personal info</h6>

        <form action= "{{url('profile-update/'.$user->id)}}" class="form-horizontal" role="form"  enctype="multipart/form-data" method="post">
        {{ csrf_field() }}
          <div class="form-group mb-2 mt-3">
            <label class="col-lg-3 control-label">Name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="{{$user->name}}" name="name">
            </div>
          </div>

          <div class="form-group mt-3">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="{{$user->email}}" name="email">
            </div>
          </div>

            <div class="form-group mt-3">
            <label class="col-lg-3 control-label">Image Upload:</label>
            <div class="col-lg-8">
            <input type="file" class="form-control" name="image">
            </div>
          </div>

          <div class="form-group ps-4 ">
            <button class="btn btn-primary btn-sm ">update</button>
          </div>
        </form>
      </div>
  </div>
</div>
<script>
const updateButton = document.getElementById("update-button");
const myDiv = document.getElementById("my-div");

updateButton.addEventListener("click", function() {
  myDiv.classList.remove("d-none");
});


    document.querySelector('.delete-account-btn').addEventListener('click', function(event) {
        event.preventDefault();
        if (confirm('Are you sure you want to delete your account?')) {
            document.querySelector('#delete-account-form').submit();
        }
    });
</script>
@endsection
