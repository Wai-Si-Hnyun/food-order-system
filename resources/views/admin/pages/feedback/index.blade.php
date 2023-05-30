@extends('admin.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Customer Feedback</h4>
        <div class="d-flex justify-content-between">
            <h5 class="pt-2">Total - (<span id="totalFeedback">{{ $message->total() }}</span>)</h5>
            <div class="mb-3 col-4">
                <form action="{{ route('feedback.search') }}" type="get">
                    <div class="d-flex">
                        <input class="form-control" name="query" type="text" value="{{ request('query') }}"
                            id="" placeholder="Enter User Name Or Email Address">
                        <button class='btn btn-sm btn-dark ms-2' type="submit"><i
                                class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
        </div>
        @if (count($message) > 0)
            <div class="card">
                <div class="table-responsive text-nowrap">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th>User Name</th>
                                <th>User Email</th>
                                <th>Suggection</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($message as $messages)
                                <tr data-id="{{ $messages->id }}">
                                    <td class="table-text idlist">
                                        {{ ($message->currentPage() - 1) * $message->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="table-text namelist">
                                        {{ $messages->name }}
                                    </td>
                                    <td class="table-text emaillist">
                                        {{ $messages->email }}
                                    </td>
                                    <td class="table-text messagelist">
                                        {{ Str::limit($messages->message, 50, '...') }}
                                    </td>

                                    <td class="actionlist">
                                        <a class="text-primary me-3" href="{{ route('feedback.show', $messages->id) }}"
                                            title="Detail">
                                            <i class="bx bxs-detail me-1"></i>
                                        </a>
                                        <a href="#" class="text-danger" title="Delete"
                                            onclick="deleteBtn('{{ $messages->id }}')">
                                            <i class="bx bx-trash me-1"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <h4 class="mt-5 text-center">No Feedback here!</h4>
        @endif
    </div>
    <div class="d-flex justify-content-center">
        {{ $message->appends(['query' => request('query')])->links() }}
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
                if (res.isConfirmed) {
                    axios.delete('/admin/feedback-delete/' + deleteId)
                        .then(response => {
                            $(`tr[data-id="${deleteId}"]`).remove();

                            $total = parseInt($('#totalFeedback').text());
                            $('#totalFeedback').text($total - 1);
                        })
                        .catch(err => {
                            console.log(err.response)
                        });
                }
            })
        }
    </script>
@endsection
