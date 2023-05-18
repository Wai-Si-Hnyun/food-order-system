@extends('layouts.app')

<!DOCTYPE html>
<html lang="en" class="light-style" dir="ltr" data-theme="theme-default" data-assets-path="../assets/"
    data-template="vertical-menu-template-free">
{{-- @include('admin.common.head') --}}

<body>
    <!-- Content -->

    <!-- Error -->
    <div class="container-xxl container-p-y">
        <div class="misc-wrapper">
            <h2 class="mb-2 mx-2">Page Not Found :(</h2>
            <p class="mb-4 mx-2">Oops! 😖 The requested URL was not found on this server.</p>
            <a href="{{ route('home') }}" class="btn btn-primary">Back to home</a>
            <div class="mt-3">
                <img src="{{ asset('assets/admin/img/illustrations/page-misc-error-light.png') }}"
                    alt="page-misc-error-light" width="500" class="img-fluid"
                    data-app-dark-img="{{ asset('assets/admin/img/illustrations/page-misc-error-dark.png') }}"
                    data-app-light-img="{{ asset('assets/admin/img/illustrations/page-misc-error-light.png') }}" />
            </div>
        </div>
    </div>
    <!-- /Error -->

    <!-- / Content -->

    {{-- @include('admin.common.js') --}}
</body>

</html>
