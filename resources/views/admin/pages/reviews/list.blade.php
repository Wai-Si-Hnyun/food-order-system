@extends('admin.layouts.app')

@section('content')
    <!--<h3 class="text-center ">User Reviews</h3>
    <div class="w-75 border border-1 mt-4 " style="margin:0 auto;">
    <table class="table table-striped task-table ">
        <thead>
        <th>ID</th>
        <th>User Name</th>
        <th>Product Name</th>
        <th>Review</th>
        <th>Actions</th>
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
                <button class="btn btn-danger btn-sm" onclick="deleteBtn('{{ $reviews->id }}')"> Delete </button>
            </td>
        </tr>
        @endforeach

        </tbody>
    </table>

</div>-->
<div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Orders</h4>
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
                                <button class="btn btn-danger btn-sm" onclick="deleteBtn('{{ $reviews->id }}')"> Delete </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<script>
var userList = document.getElementsByClassName('userlist');
var productList = document.getElementsByClassName('productlist');
var commentList = document.getElementsByClassName('commentlist');
var actionList = document.getElementsByClassName('actionlist');
var idList = document.getElementsByClassName('idlist');
function deleteBtn(deleteId) {
    if (confirm('Sure to delete?')) {
        axios.delete('/user-review/'+deleteId)
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
