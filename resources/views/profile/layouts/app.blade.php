<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Cake Shop">
    <meta name="keywords" content="Cake, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cake Shop</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/user/css/flaticon.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/user/css/barfiller.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/user/css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/user/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/user/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/user/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/user/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/user/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/user/css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header__top__inner">
                            <div class="header__top__left">
                                <ul>
                                    @if (Auth::user())
                                        <li style="width:25%;">
                                            @if (Auth::user()->image == null)
                                                <a href="#" class="display-picture"><img src="{{ asset('image/profile.png') }}" alt
                                                    class=" rounded-circle" /></a>
                                            @else
                                            <a href="#" class="display-picture"><img src="{{ asset('image/profile/'.Auth::user()->image) }}" alt
                                                    class=" rounded-circle" /></a>
                                            @endif
                                            <div class="profileimg hidden" >
                                                    <ul class=" mt-3 " style="background: none;"><!--MENU-->
                                                    <li  style="background: #E78341;" class="rounded"><a href="{{url('userprofile/'.Auth::user()->id )}}" class="text-white">Profile</li></a>
                                                    </ul>
                                            </div>

                                        </li>
                                        <li >
                                            <form action="#" method="POST" id="logoutForm">
                                                @csrf
                                            </form>
                                            <a href="#" onclick="handleFormSubmit(event)">Logout</a>
                                        </li>
                                        <li>
                                            <a href="{{route('customer.care')}}">Help</a>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ route('auth.login') }}">Login</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('auth.registerPage') }}">Register</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('customer.care') }}">Help</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="header__logo">
                                <a href="{{ route('home') }}"><img src="{{ asset('assets/user/img/logo.png') }}"
                                        alt=""></a>
                            </div>
                            <div class="header__top__right">
                                <div class="header__top__right__links">
                                    <a href="{{ route('users.wishlist') }}"><img
                                            src="{{ asset('assets/user/img/icon/heart.png') }}" alt=""></a>
                                </div>
                                <div class="header__top__right__cart">

                                    <a href="{{ route('show.cart') }}"><img
                                            src="{{ asset('assets/user/img/icon/cart.png') }}" alt=""></a>
                                    <div class="cart__price">Cart: <span>0</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="canvas__open"><i class="fa fa-bars"></i></div>
            </div>
        </div>
        <div class="container d-flex justify-content-center">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li id="home"><a href="{{ route('home') }}">Home</a></li>
                            <li id="shop"><a href="{{ route('users.shop') }}">Shop</a></li>
                            @if (Auth::user())
                                <li id="order"><a href="{{ route('user.order') }}">Order</a></li>
                            @endif
                            <li id="about"><a href="./about.html">About</a></li>
                            <li id="contact"><a href="{{route('feedback.page')}}">Contact</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <main>
        @yield('content')
    </main>

    

    <!-- Js Plugins -->
    <script src="{{ asset('assets/user/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/jquery.barfiller.js') }}"></script>
    <script src="{{ asset('assets/user/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('assets/user/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.bundle.min.js"
        integrity="sha512-i9cEfJwUwViEPFKdC1enz4ZRGBj8YQo6QByFTF92YXHi7waCqyexvRD75S5NVTsSiTv7rKWqG9Y5eFxmRsOn0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('js/user/header.js') }}"></script>
    <script>
        let card = document.querySelector(".profileimg"); //declearing profile card element
    let displayPicture = document.querySelector(".display-picture"); //declearing profile picture

    displayPicture.addEventListener("click", function() { //on click on profile picture toggle hidden class from css
    card.classList.toggle("hidden")})
    </script>
    @stack('script')
    @yield('scriptSource')
</body>

</html>
