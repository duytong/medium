<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title')</title>
	<base href="{{ asset('') }}">
	<link rel="shortcut icon" href="images/favicon.ico"> 
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
	@include('layouts.includes.header')
	
	<main>
		<div class="container">
			@yield('content')
		</div>
	</main>

	@include('layouts.includes.footer')

	@include('includes.modal')

	<script src="assets/js/custom.js" async></script>
	@yield('script')
</body>
</html>