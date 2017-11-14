<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <base href="{{ asset('') }}">
        <link rel="stylesheet" href="assets/admin/css/vEndors.bundle.css">
        <link rel="stylesheet" href="assets/admin/css/style.min.css">
        <link rel="shortcut icon" href="assets/admin/images/favicon.ico">
    </head>
    <body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
        <div class="m-grid m-grid--hor m-grid--root m-page">
            @include('admin.layouts.includes.header')
                <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
                    @include('admin.layouts.includes.left_aside')
                    @yield('content')
                </div>
            @include('admin.layouts.includes.footer')
        </div>
        <script src="assets/admin/js/vEndors.bundle.js"></script>
        <script src="assets/admin/js/main.min.js"></script>
        <script src="assets/admin/js/select2.min.js"></script>
        @yield('script')
        @include('admin.pages.modal')
    </body>
</html>