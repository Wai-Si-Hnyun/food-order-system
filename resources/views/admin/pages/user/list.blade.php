@extends('admin.layouts.app')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">PROFILE</h5>
      </div>
    <div id="main" class="mt-2">
    </div>

      <div class="modal-footer">
      <button type="button" class="btn btn-sm border border-1 btn-secondary" data-dismiss="modal">Back</button>
      </div>
    </div>
  </div>
</div>
<!--modal end -->
<div class="container-xxl flex-grow-1 container-p-y">
<div class="d-flex justify-content-between">
<h4 class="fw-bold py-3 mb-4">User List</h4>

<div class="mt-2 col-4">
    <form action="{{route('user.search')}}"  type="get">
        @csrf
        <div class="d-flex">
            <input class="form-control" name="query" type="text" value="{{ request('query') }}" id=""
                placeholder="Enter User Name....">
            <button class='btn btn-sm btn-dark ms-2' type="submit"><i
                    class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </form>
</div>
</div>

<div class="card">
<div class="table-responsive text-nowrap">
    <table class="table table-striped task-table ">
        <thead>
        <th>ID</th>
        <th>User Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Actions</th>
        <th>Change Role</th>
        </thead>
        <tbody>
        @foreach ($user as $users)
        <tr>
            <td class="table-text idlist">
                {{ $users->id }}
            </td>
            <td class="table-text userlist">
                {{ $users->name }}
            </td>
            <td class="table-text mailList">
                {{ $users->email }}
            </td>
            <td class="table-text rolelist">
                {{$users->role}}
            </td>
            <td class="table-text action">
            @if(Auth::user()->email == "admin@gmail.com")
                @if($users->email != 'admin@gmail.com')
                    <button class="btn btn-success btn-sm" onclick="infoBtn('{{ $users->id }}')" data-toggle="modal" data-target="#userModal">More Info</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteBtn('{{ $users->id }}')"> Ban </button>
                @else
                    <button class="btn btn-success btn-sm" onclick="infoBtn('{{ $users->id }}')" data-toggle="modal" data-target="#userModal">More Info</button>
                @endif
            @else
            <button class="btn btn-success btn-sm" onclick="infoBtn('{{ $users->id }}')" data-toggle="modal" data-target="#userModal">More Info</button>
            @endif
            </td>
            <td class="table-text changelist">
            @if($users->role == 'user')
                <button class="btn btn-secondary btn-sm" onclick="roleBtn('{{$users->id }}')">As admin</button>
            @else
                <span class="text-danger">Admin</span>
            @endif
            </td>
        </tr>
        @endforeach

        </tbody>
    </table>

</div>
</div>
</div>
<div class="d-flex justify-content-center">
    {{$user->links()}}
</div>
<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@push('script')
    <script src="{{ asset('js/admin/user.js') }}"></script>
@endpush
<script>

    function infoBtn(userId) {
        document.getElementById('main').innerHTML = '';
        axios.get('/admin/user/'+userId+'/info')
            .then(response => {
                console.log(response.data.image);
                var filepath = 'image/profile/'+response.data.image;
                console.log(filepath);
                var mainBody = document.getElementById('main');
                var image = document.getElementById('image');
                if (response.data.image == null) {
                    if (response.data.role == 'user') {
                    mainBody.innerHTML +=
                    '<p class="text-center">'+
                    '<img src="{{asset('image/profile.png') }}" alt="profile" width="100px" height="100px">'+
                    '</p>'+
                    '<p class="text-center mt-1">'+'User'+'</p>'+
                    '<p class="text-center mt-1">'+'name - '+response.data.name+'</p>'+
                    '<p class="text-center mt-1" id="email">'+'email - '+response.data.email+'</p>';
                    }else {
                        mainBody.innerHTML +=
                        '<p class="text-center" id="image">'+
                        '<img src="{{asset('image/profile.png') }}" alt="profile" width="100px" height="100px">'+
                        '</p>'+
                        '<p class="text-center mt-1">'+'Admin'+'</p>'+
                        '<p class="text-center mt-1">'+'name - '+response.data.name+'</p>'+
                        '<p class="text-center mt-1" id="email">'+'email - '+response.data.email+'</p>';

                        }
                    }
                    else {
                        if (response.data.role == 'user') {
                            mainBody.innerHTML +=
                            '<p class="text-center">'+
                            '<img src="{{asset('image/profile')}}/' + response.data.image + '" alt="profile" width="100px" height="100px"  class="rounded-circle">'+
                            '</p>'+
                            '<p class="text-center mt-1">'+'User'+'</p>'+
                            '<p class="text-center mt-1">'+'name - '+response.data.name+'</p>'+
                            '<p class="text-center mt-1" id="email">'+'email - '+response.data.email+'</p>';
                        }else {
                            mainBody.innerHTML +=
                            '<p class="text-center" id="image">'+
                            '<img src="{{asset('image/profile')}}/' + response.data.image + '" alt="profile" width="100px" height="100px" class="rounded-circle">'+
                            '</p>'+
                            '<p class="text-center mt-1">'+'Admin'+'</p>'+
                            '<p class="text-center mt-1">'+'name - '+response.data.name+'</p>'+
                            '<p class="text-center mt-1" id="email">'+'email - '+response.data.email+'</p>';

                        }
                    }

            })
            .catch(err => {
                console.log(err.response)
            });
    }
</script>

@endsection
