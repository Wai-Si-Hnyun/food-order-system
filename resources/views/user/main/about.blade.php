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
    @if (count($feedback) > 0)
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
                        @foreach ($feedback as $f)
                            <div class="col-lg-6">
                                <div class="testimonial__item testimonial-item">
                                    <div class="testimonial__author">
                                        <div class="testimonial__author__pic">
                                            <img src="{{ asset('assets/user/img/icon/client.png') }}" alt="">
                                        </div>
                                        <div class="testimonial__author__text">
                                            <h5>{{ $f->name }}</h5>
                                        </div>
                                    </div>
                                    <p>{{ $f->message }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
    <section class="team spad">
        <div class="container">
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

@push('script')
    <script>
        $(document).ready(function() {
            var maxheight = 0;

            $('.testimonial-item').each(function() {
                maxheight = ($(this).height() > maxheight ? $(this).height() : maxheight);
            });

            $('.testimonial-item').height(maxheight);
        })
    </script>
@endpush
