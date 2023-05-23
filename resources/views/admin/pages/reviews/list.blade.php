@extends('admin.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold pb-3 mb-4">Reviews List</h4>
        <div class="d-flex justify-content-between mb-3">
            <h5>Total - ({{ count($review) }})</h5>
            <div class="">
                <form action="{{ route('review.list') }}" method="get">
                    @csrf
                    <div class="d-flex">
                        <input class="form-control" name="key" type="text" value="{{ request('key') }}" id="key"
                            placeholder="Search..">
                        <button class='btn btn-sm btn-dark ms-2' type="submit"><i
                                class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
        </div>
        @if (count($review) > 0)
            <div class="card">
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Product Name</th>
                                <th>Review</th>
                                <th>Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($review as $reviews)
                                <tr>
                                    <td class="table-text idlist">
                                        {{ $reviews->id }}
                                    </td>
                                    <td class="table-text userlist">
                                        {{ $reviews->user }}
                                    </td>
                                    <td class="table-text productlist">
                                        {{ $reviews->product }}
                                    </td>
                                    <td class="table-text commentlist">
                                        {{ $reviews->comment }}
                                    </td>
                                    <td class="actionlist">
                                        <a href="#" class="text-danger" onclick="deleteBtn('{{ $reviews->id }}')"><i
                                                class="bx bx-trash me-1"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-3">
                {{ $review->links() }}
            </div>
        @else
            <h4 class="mt-5 text-center">No Reviews here!</h4>
        @endif
    </div>
    <script>
        var userList = document.getElementsByClassName('userlist');
        var productList = document.getElementsByClassName('productlist');
        var commentList = document.getElementsByClassName('commentlist');
        var actionList = document.getElementsByClassName('actionlist');
        var idList = document.getElementsByClassName('idlist');

        function deleteBtn(deleteId) {
            if (confirm('Sure to delete?')) {
                axios.delete('/user-review/' + deleteId)
                    .then(response => {
                        for (var i = 0; i < commentList.length; i++) {
                            console.log(idList[i].innerHTML);
                            if (idList[i].innerHTML == response.data.deletedReview.id) {
                                userList[i].style.display = 'none';
                                productList[i].style.display = 'none';
                                commentList[i].style.display = 'none';
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
