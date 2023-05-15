@extends('layouts.master')

@section('content')

<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Profile</h5>
      </div>
    <div id="main" class="main">
    </div>
      <div class="modal-footer">
      <button type="button" class="btn-close btn btn-secondary btn-sm" data-dismiss="modal">Back</button>
      </div>
    </div>
  </div>
</div>
<!--modal end -->

<h3 class="text-center">User List</h3>
<div class="w-75 border border-1 mt-4 " style="margin:0 auto;">
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
            @if($users->role == 0)
                user
            @else
                Admin
            @endif
            </td>
            <td class="table-text action">
                <button class="btn btn-success btn-sm" onclick="infoBtn('{{ $users->id }}')" data-toggle="modal" data-target="#userModal">More Info</button>
                <button class="btn btn-danger btn-sm" onclick="deleteBtn('{{ $users->id }}')"> Kick </button>
            </td>
            <td class="table-text changelist">
            @if($users->role == 0)
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
<script>
    function roleBtn(userId)
    {
        if (confirm('Are your sure to change this user into admin?')) {
            axios.put('/user/'+userId,{
                role: 1,
            })
            .then(response => {
                console.log(response);
            })
            .catch(err => {
                console.log(err.response)
            });
        }

    }

    function infoBtn(userId) {
        axios.get('/user/'+userId+'/info')
            .then(response => {
                var mainBody = document.getElementById('main');
                var image = document.getElementById('image');
                if (response.data.image == null) {
                    if (response.data.role == 0) {
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

            })
            .catch(err => {
                console.log(err.response)
            });
    }

    //roledelete
    var nameList = document.getElementsByClassName('userlist');
    var emailList = document.getElementsByClassName('mailList');
    var roleList = document.getElementsByClassName('rolelist');
    var action = document.getElementsByClassName('action');
    var changeList = document.getElementsByClassName('changelist');
    var idList = document.getElementsByClassName('idlist');
    function deleteBtn(deleteId) {
        if (confirm('Are you sure to kick this player from application?')) {
            axios.delete('/userDelete/'+deleteId)
          .then(response => {
            console.log(response.data.userDelete.name);
            for (var i = 0; i < nameList.length; i++) {
                console.log(idList[i].innerHTML);
                if (idList[i].innerHTML == response.data.userDelete.id) {
                    idList[i].style.display = 'none';
                    nameList[i].style.display = 'none';
                    roleList[i].style.display = 'none';
                    emailList[i].style.display = 'none';
                    action[i].style.display = 'none';
                    changeList[i].style.display = 'none';
                }
            }
          })
          .catch(err => {
            console.log(err.response)
        });
        }
    }
</script>
@endsection
