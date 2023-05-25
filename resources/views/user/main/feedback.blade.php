@extends('user.layouts.app')

@section('content')
    @if (session('alert'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p class="text-center text-success">Your message send successfully.</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__text">
                        <h2>Contact</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="{{ route('home') }}">Home</a>
                        <span>Contact</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="map">
                <div class="map__iframe">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d122207.45643979222!2d96.0930630464653!3d16.82719875252263!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c193c4c52d937d%3A0xc4dea30adc34df88!2sSeason%20Bakery!5e0!3m2!1sen!2ssg!4v1684945624927!5m2!1sen!2ssg"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="contact__address">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="contact__address__item">
                            <h6>yangon</h6>
                            <ul>
                                <li>
                                    <span class="icon_pin_alt"></span>
                                    <p>52 Shwe Bon Tha St, Pabedan Township, Yangon 11141, Myanmar</p>
                                </li>
                                <li><span class="icon_headphones"></span>
                                    <p>+95 9 123 456 789</p>
                                </li>
                                <li><span class="icon_mail_alt"></span>
                                    <p>Sweetcake@support.com</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="contact__address__item">
                            <h6>mandalay</h6>
                            <ul>
                                <li>
                                    <span class="icon_pin_alt"></span>
                                    <p>68 31st St, Chanayethazan Township, Mandalay 05021, Myanmar</p>
                                </li>
                                <li><span class="icon_headphones"></span>
                                    <p>+95 9 123 444 789</p>
                                </li>
                                <li><span class="icon_mail_alt"></span>
                                    <p>Sweetcake@support.com</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="contact__address__item">
                            <h6>taunggyi</h6>
                            <ul>
                                <li>
                                    <span class="icon_pin_alt"></span>
                                    <p>112 Bogyoke Aung San St, Taunggyi 06031, Myanmar</p>
                                </li>
                                <li><span class="icon_headphones"></span>
                                    <p>+95 9 123 456 999</p>
                                </li>
                                <li><span class="icon_mail_alt"></span>
                                    <p>Sweetcake@support.com</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="contact__text">
                        <h3>Feedback Here</h3>
                        <ul>
                            <li>Representatives or Advisors are available:</li>
                            <li>Mon-Fri: 5:00am to 9:00pm</li>
                            <li>Sat-Sun: 6:00am to 9:00pm</li>
                        </ul>
                        <img src="img/cake-piece.png" alt="">
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="contact__form">
                        <form action="#" method="post" id="feedbackForm">
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <input type="text" placeholder="Name" name="name" id="name">
                                    <small class="text-danger"></small>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <input type="text" placeholder="Email" name="email" id="email">
                                    <small class="text-danger"></small>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <textarea placeholder="Message" name="message" id="message"></textarea>
                                    <small class="text-danger"></small>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="site-btn">Send Us</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->
@endsection

@push('script')
    <script src="{{ asset('js/user/feedback.js') }}"></script>
@endpush
