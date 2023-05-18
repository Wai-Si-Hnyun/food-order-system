@extends('user.layouts.app')

@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__text">
                        <h2>Product detail</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="#">Home</a>
                        <a href="{{ route('users.shop') }}">Shop</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- Shop Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product__details__img">
                        <div class="">
                            <img class="img-thumbnail w-75" src="{{ asset('storage/' . $products->image) }}"
                                alt="productimg">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product__details__text">
                        <h4>{{ $products->name }}</h4>
                        <h5>${{ $products->price }}</h5>
                        <p>
                            {{ $products->description }}
                        </p>
                        <ul>
                            <li>Product-Id : <span>{{ $products->id }}</span></li>
                        </ul>
                        <div class="product__details__option">
                            <form action="{{ url('add-cart/'.$products->id) }}" method="post" class="d-inline-block ">
                                @csrf
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" name="quantity" value="3">
                                    </div>
                                </div>
                                <button type="submit" class="primary-btn border border-0">Add to cart</button>
                            </form>
                            <a href="#" class="heart__btn  me-2"><span class="icon_heart_alt"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->
    <!-- Related Products Section Begin -->
    <section class="related-products spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-title">
                        <h2>Related Products</h2>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="related__products__slider owl-carousel">
                    @foreach ($productList as $list)
                        <div class="col-lg-3">
                            <div class="product__item">
                                <div class="product__item__pic set-bg">
                                    <img src="{{ asset('storage/' . $list->image) }}" alt="product-image"
                                        style="height:200px">
                                    <div class="product__label">
                                        <span>
                                            <a href="{{ route('users.details', $list->id) }}" class="text-dark">Foods</a>
                                        </span>
                                    </div>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="#">{{ $list->name }}</a></h6>
                                    <div class="product__item__price">${{ $list->price }}</div>
                                    <div class="cart_add">
                                        <a href="{{ url('add-cart/'.$list->id) }}">Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Related Products Section End -->

    <!--review section start -->
    <section class="mb-5">
      <div class="container">
        <div class="card col-7 offset-3 mt-5">
            <div class="card-header text-center">
            <div class="section-title">
                <h2>Review Create</h2>
            </div>
            </div>
            <div class="card-body">
                <form action="{{route('review.create')}}" method="post">
                    @csrf
                    <input type="hidden" name="userId" class="ms-2" value="{{ $user[$id]['user_id'] }}">
                    <input type="hidden" name="productId" value="{{ $products->id }}">
                    <label for="">Content</label>
                    <textarea name="content" id="" cols="30" rows="3" class="form-control" >Good</textarea>
                    <button type="submit" class="btn btn-success btn-sm ">Create</button>
                    <a href="#" class="btn btn-sm btn-dark float-end my-3">Back</a>
                    <button type="button" class="btn btn-secondary ms-3 btn-sm" data-toggle="modal" data-target="#reviewModal"><i class="fa-regular fa-rectangle-list"></i></button>
                </form>
            </div>
        </div>
    </div>
    </section>

<!-- reviews Display Modal -->
    <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Your Reviews</h5>
        <button type="button" class="btn-close" data-dismiss="modal" ><i class="fa-solid fa-circle-xmark"></i></button>
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
                <td class="namelist">{{ $products->name }}</td>
                <td class="commentlist">{{ $reviews->comment }}</td>
                <td class="actionlist">
                <button type="button" class="btn btn-secondary ms-3 btn-sm" data-toggle="modal" data-target="#editModal" data-dismiss="modal" onclick="reviewEditBtn('{{ $reviews->id }}')">Edit</button>
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
    </div>
    <!--review display end -->

       <!-- reviews Edit Modal -->
   <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Review</h5>
        <button type="button" class="btn-close" data-dismiss="modal" ><i class="fa-solid fa-circle-xmark"></i></button>
      </div>
      <form name="reviewEditForm"  class="d-inline-block">
            <div class="form-group">
                 <label for="task" class="col-sm-12 control-label text-dark mb-2">Content</label>
                 <div class="col-sm-12">
                 <input type="hidden" name="reviewId" >
                 <textarea name="comment"  cols="30" rows="3" class="form-control"  ></textarea>
                 </div>
             </div>
             <div class="w-25  d-flex justify-content-center">
             <div class="form-group d-flex justify-content-center">
                <button type="submit" class="btn btn-primary ms-3 form-control btn-sm">Update</button>
            </div>
             </div>
      </div>

      <div class="modal-footer">

      </div>
      </form>
    </div>
  </div>
<!--edit model end -->
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
                location.reload();
        })
            .catch(err => {
                console.log(err.response)
        });
    }

    var nameList = document.getElementsByClassName('namelist');
    var commentList = document.getElementsByClassName('commentlist');
    var actionList = document.getElementsByClassName('actionlist');
    var idList = document.getElementsByClassName('idlist');
    function deleteBtn(deleteId) {
    if (confirm('Sure to delete?')) {
        axios.delete('/review-delete/'+deleteId)
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
@endsection
