<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>@yield('title')</title>
		<base href="{{ asset('') }}">
		<script src="assets/js/pace.min.js" async></script>
		<style>.pace{-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;pointer-events:none}.pace-inactive{display:none}.pace .pace-progress{background:#03a87c;position:fixed;z-index:2000;top:0;right:100%;width:100%;height:2px}</style>
		<link rel="shortcut icon" href="images/favicon.ico">
		<link rel="stylesheet" href="assets/css/style.min.css">
	</head>
	<body>
		@include('layouts.includes.header')
		<main>
			<div class="container">
				@yield('content')
			</div>
		</main>
		@yield('footer')
		@login
		@else
			@include('includes.signin')
		@endlogin
		<script src="assets/js/custom.min.js" async></script>
		@yield('script')
	</body>
</html>