@extends('admin.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between">
            <h4 class="fw-bold py-3 mb-4">Customer Feedback</h4>

            <div class="mt-2 col-4">
                <form action="{{ route('feedback.search') }}" type="get">
                    @csrf
                    <div class="d-flex">
                        <input class="form-control" name="query" type="text" value="{{ request('query') }}" id=""
                            placeholder="Enter User Name Or Email Address">
                        <button class='btn btn-sm btn-dark ms-2' type="submit"><i
                                class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
        </div>
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
                                    <a href="#" class="text-danger" onclick="deleteBtn('{{ $messages->id }}')">
                                        <i class="bx bx-trash me-1"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{ $message->links() }}
    </div>
    <script>
        var messageList = document.getElementsByClassName('messagelist');
        var nameList = document.getElementsByClassName('namelist');
        var emailList = document.getElementsByClassName('emaillist');
        var actionList = document.getElementsByClassName('actionlist');
        var idList = document.getElementsByClassName('idlist');

        function deleteBtn(deleteId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then(res => {
                axios.delete('/admin/feedback-delete/' + deleteId)
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
            })
        }
    </script>
@endsection
