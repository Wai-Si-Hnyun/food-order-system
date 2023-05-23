@extends('admin.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold pb-3 mb-4">Customer Feedback</h4>
        @if (count($message) > 0)
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
                                        <a href="#" class="text-danger" onclick="deleteBtn('{{ $messages->id }}')"><i
                                                class="bx bx-trash me-1"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <h3 class="text-center my-5">There is no Feedback Here!</h3>
        @endif
    </div>
    <script>
        var messageList = document.getElementsByClassName('messagelist');
        var nameList = document.getElementsByClassName('namelist');
        var emailList = document.getElementsByClassName('emaillist');
        var actionList = document.getElementsByClassName('actionlist');
        var idList = document.getElementsByClassName('idlist');

        function deleteBtn(deleteId) {
            if (confirm('Sure to delete?')) {
                axios.delete(`/admin/feedback/${deleteId}/delete`)
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
