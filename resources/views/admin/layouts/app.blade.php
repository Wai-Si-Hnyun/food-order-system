<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

@include('admin.common.head')

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Side menu -->
            @include('admin.common.menu')

            <div class="layout-page">

                <!-- Common Header for admin dashboard -->
                @include('admin.common.header')

                <div class="content-wrapper">
                    @yield('content')

                    <!-- Common footer for admin dashboard -->
                    @include('admin.common.footer')

                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>

        @include('admin.common.js')

        @stack('script')
</body>

</html>
