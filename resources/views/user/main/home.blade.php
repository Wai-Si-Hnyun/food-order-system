@extends('user.layouts.app')

@section('content')
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="hero__slider owl-carousel">
            <div class="hero__item set-bg" data-setbg="{{ asset('assets/user/img/hero/hero-1.jpg') }}">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-8">
                            <div class="hero__text">
                                <h2>When you have a lot to do,start with a meal!</h2>
                                <a href="{{ route('users.shop') }}" class="primary-btn">Our cakes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero__item set-bg" data-setbg="{{ asset('assets/user/img/hero/hero-1.jpg') }}">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-8">
                            <div class="hero__text">
                                <h2>When you have a lot to do,start with a meal!</h2>
                                <a href="{{ route('users.shop') }}" class="primary-btn">Our cakes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <h4 class='my-3'>Best Sellers</h4>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg detail-view" data-id="{{ $product->id }}"
                                data-setbg="{{ asset('storage/' . $product->image) }}" style="cursor: pointer">
                                <div class="product__label">
                                    <span>{{ $product->category->name }}</span>
                                </div>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">{{ $product->name }}</a></h6>
                                <div class="product__item__price">{{ $product->price }} MMK</div>
                                <div class="cart_add" data-id="{{ $product->id }}"
                                    data-name="{{ $product->name }}" data-price="{{ $product->price }}"
                                    data-image="{{ $product->image }}" data-quantity="1">
                                    <a href="#" class="add-to-cart-btn">Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Chatbot Button -->
    <div class="chatbot">
        <a href="#" data-toggle="modal" data-target="#chatbotModal">
            <img src="{{ asset('assets/user/img/icon/24-hour-customer-service.png') }}" class="btn-chatbot" alt="Chatbot">
        </a>
        {{-- <button type="button" class="btn btn-danger btn-chatbot" data-toggle="modal" data-target="#chatbotModal">Chatbot</button> --}}
    </div>

    <!-- Chatbot Modal -->
    <div class="modal fade" id="chatbotModal" tabindex="-1" role="dialog" aria-labelledby="chatbotModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="chatbotModalLabel">Frequently Asked Questions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="chatbox">
                        <div id="welcome" class="text-center">
                            <button class="btn btn-primary mt-4" id="get-started">Click to Get Started</button>
                        </div>
                        <div id="questions" class="d-none">
                            <h4 class="mb-4" style="font-size: 14px">Questions:</h4>
                            @forelse ($questions as $question)
                                <button class="btn btn-primary question mb-2 text-left text-wrap w-100 overflow-hidden" style="font-size: 14px"
                                    data-question="{{ $question }}">{{ $question }}</button>
                            @empty
                                <p>There is no question currently available.</p>
                            @endforelse
                        </div>
                        </div>
                        <div id="answer" class="mt-4"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection

@push('script')
    <script src="{{ asset('js/user/home.js') }}"></script>
    <script src="{{ asset('js/user/add-to-cart.js') }}"></script>
@endpush
