
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>list</title>
</head>
<body>
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   <p>{{$user->name}}</p> This is product Page
   <!-- reviews Modal -->
   <a href="{{url('userprofile/'.$user->id)}}" class = "btn btn-primary">Profile</a>
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Review</h5>
        <button type="button" class="btn-close" data-dismiss="modal" ></button>
      </div>
    <form action="{{route('review#create')}}" method="post" class="d-flex">
            @csrf
      <div class="modal-body">
            <input type="hidden" name="userId" class="ms-2" value="{{$user->id}}">
            <input type="hidden" name="productId" value="{{$user->id}}">

            <div class="form-group">
                 <label for="task" class="col-sm-12 control-label text-dark mb-2">Content</label>

                 <div class="col-sm-12">
                    <textarea name="content" id="" cols="30" rows="3" class="form-control" >Good</textarea>
                 </div>

             </div>
        <div class="form-group text-end">
         <button type="submit" class="btn btn-success mt-3">Create</button>
        </div>
      </div>

      <div class="modal-footer">

      </div>
      </form>
    </div>
  </div>
</div>
<!--review model end -->

   <!-- reviews Edit Modal -->
   <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Review</h5>
        <button type="button" class="btn-close" data-dismiss="modal" ></button>
      </div>
      <form name="reviewEditForm"  class="d-inline-block">
            <div class="form-group">
                 <label for="task" class="col-sm-12 control-label text-dark mb-2">Content</label>
                 <div class="col-sm-12">
                 <input type="hidden" name="reviewId" >
                 <textarea name="comment"  cols="30" rows="3" class="form-control"  ></textarea>
                 </div>
             </div>
             <div class="form-group text-end">
            <button type="submit" class="btn btn-primary btn-sm me-3">Update</button>
            </div>
      </div>

      <div class="modal-footer">

      </div>
      </form>
    </div>
  </div>
</div>
<!--edit model end -->

   <!-- reviews Display Modal -->
   <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Your Reviews</h5>
        <button type="button" class="btn-close" data-dismiss="modal" ></button>
      </div>

    <table class="table table-striped task-table ms-auto me-auto" style="width:95%;">

    <thead >
        <th>ID</th>
        <th>Product Name</th>
        <th>Comment</th>
        <th>Action</th>
    </thead>
    <tbody>
    @foreach ($review as $reviews)
            <tr>
                <td class="idlist">{{ $reviews->id }}</td>
                <td class="namelist">{{ $reviews->product_id }}</td>
                <td class="commentlist">{{ $reviews->comment }}</td>
                <td class="actionlist">
                <button type="button" class="btn btn-secondary ms-3" data-toggle="modal" data-target="#editModal" data-dismiss="modal" onclick="reviewEditBtn('{{ $reviews->id }}')">Edit</button>
                <button  class="btn btn-danger btn-sm " onclick="deleteBtn('{{ $reviews->id }}')"> Delete </button>
                </td>
            </tr>
            @endforeach
    </tbody>
    </table>
    </div>
      </div>

      <div class="modal-footer">

      </div>
      </form>
    </div>
  </div>
</div>

<button type="button" class="btn btn-secondary ms-3" data-toggle="modal" data-target="#importModal">Reviews Create</button>
<button type="button" class="btn btn-secondary ms-3" data-toggle="modal" data-target="#reviewModal">Your Reviews</button>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
<script>
    //reviews edit
    var reviewEditForm = document.forms['reviewEditForm'];
    var reviewId = reviewEditForm['reviewId'];
    var reviewComment = reviewEditForm['comment'];
    function reviewEditBtn(editId) {
                axios.get('/review/'+editId+'/edit')
                     .then(response => {
                        reviewId.value = response.data.id;
                        reviewComment.value = response.data.comment;
                     })
                     .catch(err => {
                    console.log(err.response)
                });
    }
    // reviews update

    reviewEditForm.onsubmit = function(e) {
        e.preventDefault();
        axios.put('/review/'+reviewId.value,{
            comment: reviewComment.value,
        })
            .then(response => {
                console.log(response);
        })
            .catch(err => {
                console.log(err.response)
        });
    }

    //reviews delete
    var nameList = document.getElementsByClassName('namelist');
    var commentList = document.getElementsByClassName('commentlist');
    var actionList = document.getElementsByClassName('actionlist');
    var idList = document.getElementsByClassName('idlist');
    function deleteBtn(deleteId) {
    if (confirm('Sure to delete?')) {
        axios.delete('/reviewDelete/'+deleteId)
          .then(response => {
            console.log(response.data.deletedReview.comment);
            for (var i = 0; i < commentList.length; i++) {
                console.log(idList[i].innerHTML);
                if (idList[i].innerHTML == response.data.deletedReview.id) {
                    nameList[i].style.display = 'none';
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
</body>
</html>
