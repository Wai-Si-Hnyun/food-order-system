@extends('layouts.master')

@section('content')
    <h3 class="text-center ">User Reviews</h3>
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
            <!-- Task Name -->
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
<script>
var userList = document.getElementsByClassName('userlist');
var productList = document.getElementsByClassName('productlist');
var commentList = document.getElementsByClassName('commentlist');
var actionList = document.getElementsByClassName('actionlist');
var idList = document.getElementsByClassName('idlist');
function deleteBtn(deleteId) {
    if (confirm('Sure to delete?')) {
        axios.delete('/userReview/'+deleteId)
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
