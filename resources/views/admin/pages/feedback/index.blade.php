@extends('admin.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Customer Feedback</h4>
        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>Suggection</th>
                        <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($message as $messages)
                        <tr>
                            <td class="table-text idlist">
                                {{ $messages->id }}
                            </td>
                            <td class="table-text namelist">
                                {{ $messages->name }}
                            </td>
                            <td class="table-text emaillist">
                                {{ $messages->email }}
                            </td>
                            <td class="table-text messagelist">
                                {{ $messages->message }}
                            </td>

                            <td class="actionlist">
                                <button class="btn btn-danger btn-sm" onclick="deleteBtn('{{ $messages->id }}')"> Delete </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
 var messageList = document.getElementsByClassName('messagelist');
var nameList = document.getElementsByClassName('namelist');
var emailList = document.getElementsByClassName('emaillist');
var actionList = document.getElementsByClassName('actionlist');
var idList = document.getElementsByClassName('idlist');
function deleteBtn(deleteId) {
    if (confirm('Sure to delete?')) {
        axios.delete('/feedback-delete/'+deleteId)
          .then(response => {
            for (var i = 0; i < messageList.length; i++) {
                console.log(idList[i].innerHTML);
                if (idList[i].innerHTML == response.data.reviewFeedback.id) {
                    messageList[i].style.display = 'none';
                    nameList[i].style.display = 'none';
                    emailList[i].style.display = 'none';
                    actionList[i].style.display = 'none';
                    idList[i].style.display = 'none';
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
