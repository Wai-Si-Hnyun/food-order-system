<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Cake Shop">
    <meta name="keywords" content="Cake, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
</head>

<body>
    @include('user.common.header')

    <main>
        @yield('content')
    </main>

    @include('user.common.footer')

    <!-- Js Plugins -->
    <script src="{{ asset('assets/user/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/jquery.barfiller.js') }}"></script>
    <script src="{{ asset('assets/user/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('assets/user/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/main.js') }}"></script>
</body>

</html>
