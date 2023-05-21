@extends('user.layouts.app')

@section('content')
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__text">
                        <h2>About</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="#">Home</a>
                        <span>About</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="about spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="about__text">
                        <div class="section-title">
                            <span>About Cake shop</span>
                            <h2>Sweets Cakes and bakes from the Cake Shop!</h2>
                        </div>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iusto sunt laudantium nostrum veritatis
                            eum aliquam laboriosam dicta neque, nisi deleniti similique tempora distinctio debitis sed
                            aliquid repellendus, itaque, animi est?
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="about__bar">
                        <div class="about__bar__item">
                            <img src="{{ asset('assets/user/img/blog/blog-4.jpg') }}" alt="">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="testimonial spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-title">
                        <span>Testimonial</span>
                        <h2>Our client say</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="testimonial__slider owl-carousel">
                    <div class="col-lg-6">
                        <div class="testimonial__item">
                            <div class="testimonial__author">
                                <div class="testimonial__author__pic">
                                    <img src="{{ asset('assets/user/img/testimonial/ta-2.jpg') }}" alt="">
                                </div>
                                <div class="testimonial__author__text">
                                    <h5>Kerry D.Silva</h5>
                                    <span>New york</span>
                                </div>
                            </div>
                            <div class="rating">
                                <span class="icon_star"></span>
                                <span class="icon_star"></span>
                                <span class="icon_star"></span>
                                <span class="icon_star"></span>
                                <span class="icon_star-half_alt"></span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua viverra lacus vel facilisis.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="team spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-7">
                    <div class="section-title">

                        <img src="{{ asset('assets/user/img/blog/blog-3.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="section-title">
                        <h2>Freshly Baked Cakes Every Morning!</h2>
                    </div>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iusto sunt laudantium nostrum veritatis
                        eum aliquam laboriosam dicta neque, nisi deleniti similique tempora distinctio debitis sed
                        aliquid repellendus, itaque, animi est?
                    </p>
                    <div class="team__btn">
                        <a href="#" class="primary-btn rounded btn-outline-warning">Join Us</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-7 col-sm-7 mt-5">
                    <div class="row">
                        <div class="col-6 offset-1">
                            <h4 class="my-4"><b>Opening Hours:</b></h4>
                            <div>
                                <h6 class="my-2">Monday - Friday </h6>
                                <h6 class="my-2">Saturday </h6>
                                <h6 class="my-2">Sunday </h6>
                            </div>
                            <div class="mt-5">
                                <a href="" class="text-decoration-none text-dark"><i
                                        class="fa-brands fa-facebook"></i></a>
                                <a href="" class="text-decoration-none text-dark"><i
                                        class="fa-brands fa-twitter"></i></a>
                                <a href="" class="text-decoration-none text-dark"><i
                                        class="fa-brands fa-youtube"></i></a>
                                <a href="" class="text-decoration-none text-dark"><i
                                        class="fa-brands fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="col-5 mt-4">
                            <div class="mt-5">
                                <h6 class="text-warning my-2">08:00 am – 08:30 pm</h6>
                                <h6 class="text-warning my-2">10:00 am – 16:30 pm</h6>
                                <h6 class="text-warning my-2">10:00 am – 16:30 pm</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
