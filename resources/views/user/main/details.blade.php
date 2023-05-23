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
                        <a href="{{ route('users.shop') }}">Shop</a>
                        <span>Detail</span>
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
                <div class="col-lg-5">
                    <div class="product__details__img">
                        <div class="">
                            <img class="img-thumbnail w-75" src="{{ asset('storage/' . $product->image) }}"
                                alt="productimg">
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    @if (session('addSuccess'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ session('addSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="product__details__text">
                        <h4>{{ $product->name }}</h4>
                        <h5>{{ $product->price }} MMK</h5>
                        <p>
                            {{ $product->description }}
                        </p>
                        <ul>
                            <li>Product-Id : <span>{{ $product->id }}</span></li>
                        </ul>
                        <div class="product__details__option" data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                            data-price="{{ $product->price }}" data-image="{{ $product->image }}">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" name="quantity" value="1" class="product-qty">
                                </div>
                            </div>
                            <a href="#" class="primary-btn add-to-cart-btn-detail">Add to cart</a>
                            <a href="{{ route('users.storeWishlist', ['productId' => $product->id]) }}">
                                <button type="submit" class="btn btn-outline-warning btn-lg heart__btn  mr-3">
                                    <span class="icon_heart_alt"></span>
                                </button>
                            </a>
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
                                <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/' . $list->image) }}">
                                    <div class="product__label">
                                        <span>
                                            {{ $list->category->name }}
                                        </span>
                                    </div>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="#">{{ $list->name }}</a></h6>
                                    <div class="product__item__price">{{ $list->price }} MMK</div>
                                    <div class="cart_add" data-id="{{ $list->id }}" data-name="{{ $list->name }}"
                                        data-price="{{ $list->price }}" data-image="{{ $list->image }}"
                                        data-quantity="1">
                                        <a href="#" class="add-to-cart-btn">Add to cart</a>
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

    @if (Auth::check())
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
                        <form action="{{ route('review.create') }}" method="post">
                            @csrf
                            <input type="hidden" name="userId" class="ms-2" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="productId" value="{{ $product->id }}">
                            <label for="">Content</label>
                            <textarea name="content" id="" cols="30" rows="3" class="form-control">Good</textarea>
                            <button type="submit" class="btn btn-success btn-sm ">Create</button>
                            <a href="#" class="btn btn-sm btn-dark float-end my-3">Back</a>
                            <button type="button" class="btn btn-secondary ms-3 btn-sm" data-toggle="modal"
                                data-target="#reviewModal"><i class="fa-regular fa-rectangle-list"></i></button>
                        </form>
                    </div>
        </section>

        <!-- reviews Display Modal -->
        <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Your Reviews</h5>
                        <button type="button" class="btn-close border border-0" data-dismiss="modal"><i
                                class="fa-solid fa-circle-xmark"></i></button>
                    </div>

                    <table class="table table-striped task-table ms-auto me-auto" style="width:95%;">

                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Comment</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($review as $reviews)
                                <tr>
                                    <td class="idlist">{{ $reviews->id }}</td>
                                    <td class="namelist">{{ $product->name }}</td>
                                    <td class="commentlist">{{ $reviews->comment }}</td>
                                    <td class="actionlist">
                                        <button type="button" class="btn btn-secondary ms-3 btn-sm" data-toggle="modal"
                                            data-target="#editModal" data-dismiss="modal"
                                            onclick="reviewEditBtn('{{ $reviews->id }}')">Edit</button>
                                        <button class="btn btn-danger btn-sm "
                                            onclick="deleteBtn('{{ $reviews->id }}')">
                                            Delete </button>
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
                        <button type="button" class="btn-close border border-0" data-dismiss="modal"><i
                                class="fa-solid fa-circle-xmark"></i></button>
                    </div>
                    <form name="reviewEditForm" class="d-inline-block">
                        <div class="form-group">
                            <label for="task" class="col-sm-12 control-label text-dark mb-2">Content</label>
                            <div class="col-sm-12">
                                <input type="hidden" name="reviewId">
                                <textarea name="comment" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="w-25  d-flex justify-content-center">
                            <div class="form-group d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary ms-1 form-control btn-sm">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--edit model end -->
    @endif

    <script>
        //reviews edit
        var reviewEditForm = document.forms['reviewEditForm'];
        var reviewId = reviewEditForm['reviewId'];
        var reviewComment = reviewEditForm['comment'];

        function reviewEditBtn(editId) {
            axios.get('/review/' + editId + '/edit')
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
            axios.put('/review/' + reviewId.value, {
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
                axios.delete('/review-delete/' + deleteId)
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

@push('script')
    <script src="{{ asset('js/user/add-to-cart.js') }}"></script>
    <script src="{{ asset('js/user/product-detail.js') }}"></script>
@endpush
