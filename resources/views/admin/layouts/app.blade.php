<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cake Shop | Admin</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/admin/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/css/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/demo.css') }}" />

    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/css/pages/page-misc.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('assets/admin/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js') }} in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/admin/js/config.js') }}"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Side menu -->
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="index.html" class="app-brand-link">
                        <span class="app-brand-text fs-4 menu-text fw-bolder">Food Order System</span>
                    </a>

                    <a href="javascript:void(0);"
                        class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item" id="dashboard">
                        <a href="{{ route('admin.dashboard') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Dashboard</div>
                        </a>
                    </li>

                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Pages</span>
                    </li>
                    <li class="menu-item" id="categories">
                        <a href="{{ route('categories.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-category"></i>
                            <div>Categories</div>
                        </a>
                    </li>
                    <li class="menu-item" id="products">
                        <a href="{{ route('products.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-cake"></i>
                            <div>Products</div>
                        </a>
                    </li>
                    <li class="menu-item" id="orders">
                        <a href="{{ route('orders.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-receipt"></i>
                            <div>Orders</div>
                        </a>
                    </li>
                    <li class="menu-item" id="reviews">
                        <a href="{{ route('review.list') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div>Reviews</div>
                        </a>
                    </li>
                    <li class="menu-item" id="users">
                        <a href="{{ route('userData.list') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div>Users</div>
                        </a>
                    </li>
                    <li class="menu-item" id="mail">
                        <a href="{{ route('mail.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-mail-send"></i>
                            <div>Mail</div>
                        </a>
                    </li>
                    <li class="menu-item" id="questions">
                        <a href="{{ route('q&a.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-message-dots"></i>
                            <div>Q&A</div>
                        </a>
                    </li>
                    <li class="menu-item" id="feedback">
                        <a href="{{ route('feedback.list') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div>FeedBack</div>
                        </a>
                    </li>
                </ul>
            </aside>
            <!-- / Menu -->

            <div class="layout-page">

                <!-- Common Header for admin dashboard -->
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- Place this tag where you want the button to render. -->
                            <li class="nav-item lh-1 me-3">
                                <a class="github-button"
                                    href="https://github.com/themeselection/sneat-html-admin-template-free"
                                    data-icon="octicon-star" data-size="large" data-show-count="true"
                                    aria-label="Star themeselection/sneat-html-admin-template-free on GitHub">Star</a>
                            </li>

                           <!-- User -->
                           @if(Auth::check())
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">

                                    @if(Auth::user()->image == null)
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('image/profile.png') }}" alt
                                            class="w-100 h-100 rounded-circle" />
                                    </div>
                                    @else
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('image/profile/'.Auth::user()->image) }}" alt
                                            class="w-100 h-100 rounded-circle" />
                                    </div>
                                    @endif
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    @if(Auth::user()->image == null)
                                                        <img src="{{ asset('image/profile.png') }}"
                                                            alt="Profile" class="w-px-40 h-auto rounded-circle" />
                                                    @else
                                                        <img src="{{ asset('image/profile/'.Auth::user()->image) }}"
                                                            alt="Profile" class="w-px-40 h-auto rounded-circle" />
                                                    @endif
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block">{{Auth::user()->name}}</span>
                                                    <small class="text-muted">{{Auth::user()->role}}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{url('userprofile/'.Auth::user()->id )}}">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">My Profile</span>
                                        </a>
                                        @endif
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <span class="d-flex align-items-center align-middle">
                                                <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                                                <span class="flex-grow-1 align-middle">Billing</span>
                                                <span
                                                    class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <form action="#" method="POST" id="logoutForm">
                                            @csrf
                                        </form>
                                        <a class="dropdown-item" href="#" onclick="handleFormSubmit(event)">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>

                <!-- / Navbar -->

                <div class="content-wrapper">
                    @yield('content')

                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>

        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js') }} -->
        <script src="{{ asset('assets/admin/vendor/libs/jquery/jquery.js') }}"></script>
        <script src="{{ asset('assets/admin/vendor/libs/popper/popper.js') }}"></script>
        <script src="{{ asset('assets/admin/vendor/js/bootstrap.js') }}"></script>
        <script src="{{ asset('assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

        <script src="{{ asset('assets/admin/vendor/js/menu.js') }}"></script>
        <!-- endbuild -->

        <!-- Vendors JS -->
        <script src="{{ asset('assets/admin/vendor/libs/apex-charts/apexcharts.js') }}"></script>

        <!-- Main JS -->
        <script src="{{ asset('assets/admin/js/main.js') }}"></script>

        <!-- Page JS -->
        <script src="{{ asset('assets/admin/js/dashboards-analytics.js') }}"></script>

        <!-- Place this tag in your head or just before your close body tag. -->
        <script async defer src="https://buttons.github.io/buttons.js') }}"></script>

        <script src="{{ asset('js/app.js') }}"></script>

        <script src="{{ asset('js/admin/menu.js') }}"></script>

        <!--axios -->
        <script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>

        @stack('script')
</body>

</html>
