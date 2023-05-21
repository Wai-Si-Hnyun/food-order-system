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
                                <a href="{{ route('users.shop') }}" class="primary-btn">Our Foods</a>
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
                                <a href="{{ route('users.shop') }}" class="primary-btn">Our Foods</a>
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
                            <div class="product__item__pic set-bg">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="">
                                <div class="product__label">
                                    <span>Foods</span>
                                </div>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">{{ $product->name }}</a></h6>
                                <div class="product__item__price">${{ $product->price }}</div>
                                <div class="cart_add">
                                    <form action="{{ url('add-cart/' . $product->id) }}" method="post">
                                        @csrf
                                        <input type="hidden" value="1" name="quantity">
                                        <button type="submit" class="border border-warning">Add to cart</button>
                                    </form>
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
                    <h5 class="modal-title" id="chatbotModalLabel">Simple Chatbot</h5>
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
                            <h4 class="mb-4">Questions:</h4>
                            @forelse ($questions as $question)
                                <button class="btn btn-primary question mb-2" data-question="{{ $question }}">{{ $question }}</button>
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
@endpush
