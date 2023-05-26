@extends('user.layouts.app')

@section('content')
    @if (session('update'))
        <div class="d-flex justify-content-center">
            <div class="alert alert-danger alert-dismissible fade show w-50" role="alert">
                <p class="text-center text-danger">Update fails!Email or name field is required.</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif

    @if (session('alert'))
        <div class="d-flex justify-content-center">
            <div class="alert alert-success alert-dismissible fade show w-50" role="alert">
                <p class="text-center text-success">Profile update success.</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <section class=" mt-0">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100 w-100">
                <div class="col col-lg-8 mb-4 mb-lg-0">
                    <div class="card mb-3" style="border-radius: .5rem;">
                        <div class="row g-0">
                            <div class="col-md-4 gradient-custom text-center text-white bg-light"
                                style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                @if ($user->image == null)
                                    <img src="{{ asset('image/profile.png') }}" alt="Avatar" class="img-fluid my-5"
                                        style="width: 80px;" />
                                @else
                                    <img src="{{ asset('image/profile/' .$user->image) }}" alt="Avatar"
                                        class=" img-circle mt-4 mb-3 w-75 h-50" />
                                @endif

                                <h5>{{ $user->name }}</h5>
                                @if ($user->role == 'user')
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
                                            <p class="text-muted ">{{ $user->email }}</p>
                                        </div>
                                        @if ($user->role == 'user')
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
                                            <a href="{{ url('password/' . $user->id . '/update') }}" class="text-success">Change
                                                Password</a>
                                        </div>
                                        <div class="col-4 mb-3">
                                            <h6>Edit Profile</h6>
                                            <a href="#my-div" class="text-primary" id="update-button">Edit</a>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('home') }}" class="btn btn-dark btn-sm"> Back</a>
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
                            <img src="{{asset('image/profile.png') }}" class="avatar img-circle img-thumbnail w-50 h-50" alt="avatar" id="profile"  >
                            <img id="output" class="img-thumbnail rounded-circle w-75 h-75">
                        @else
                            <img src="{{asset('image/profile/'.$user->image) }}" class="img-thumbnail rounded-circle w-75 h-75" alt="avatar" id="profile" >
                            <img id="output" class="img-thumbnail rounded-circle w-75 h-75">
                        @endif
                            <h6 class="mb-2 mt-2">Upload a different photo...</h6>
                        </div>
                    </div>

                    <!-- edit form column -->
                    <div class="col-md-8 personal-info">
                        <h6 class="mt-2">Personal info</h6>

                        <form action="{{ url('profile-update/' . $user->id) }}" class="form-horizontal" role="form"
                            enctype="multipart/form-data" method="post">
                            {{ csrf_field() }}
                            <div class="form-group mb-2 mt-3">
                                <label class="col-lg-3 control-label">Name <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="text" value="{{ $user->name }}" name="name">
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <label class="col-lg-3 control-label">Email <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="text" value="{{ $user->email }}" name="email">
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <label class="col-lg-3 control-label">Image Upload <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input type="file" class="form-control" name="image" onchange="loadFile(event)">
                                </div>
                            </div>

                            <div class="form-group ps-4 ">
                                <button class="btn btn-primary btn-sm ">update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script src="{{ asset('js/profile/profile.js') }}"></script>
        @endsection
