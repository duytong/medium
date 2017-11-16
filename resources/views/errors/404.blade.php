<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Not found - Medium</title>
	<base href="{{ asset('') }}">
	<link rel="shortcut icon" href="images/favicon.ico"> 
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-8">
				<div class="d-flex flex-column">
					<img src="https://cfl.dropboxstatic.com/static/images/publicfoldersunset.svg" class="w-full">
					<div class="d-flex flex-column align-items-center mb-70">
						<h1 class="mb-3 text-center">Oops! We couldn’t find this page.</h1>
						@login
							<a href="" class="btn btn-shadow bg-success">Back to home</a>
						@else
							<a href="" class="btn btn-shadow bg-success">Back to homepage</a>
						@endlogin
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>