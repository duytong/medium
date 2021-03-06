<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <base href="{{ asset('') }}">
        <link rel="stylesheet" href="assets/administrator/css/style.min.css">
        <link rel="shortcut icon" href="assets/administrator/images/favicon.ico">
    </head>
    <body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
        <div class="m-grid m-grid--hor m-grid--root m-page">
            @include('administrator.layouts.includes.header')
                <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
                    @include('administrator.layouts.includes.left_aside')
                    @yield('content')
                </div>
            @include('administrator.layouts.includes.footer')
        </div>
        @include('administrator.includes.confirm')
        <script src="assets/administrator/js/main.min.js" async></script>
        @yield('script')
    </body>
</html>