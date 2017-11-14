<!DOCTYPE html>
<html lang="en" >
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
		<meta charset="utf-8" />
		<title>Medium - Login</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="assets/admin/vEndors/base/vEndors.bundle.css" rel="stylesheet" type="text/css" />
        <link href="assets/admin/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="assets/admin/demo/default/media/img/logo/favicon.ico" />
	</head>
	<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--singin m-login--2 m-login-2--skin-1" id="m_login" style="background-image: url(assets/admin/app/media/img/bg/bg-1.jpg);">
				<div class="m-grid__item m-grid__item--fluid m-login__wrapper">
					<div class="m-login__container">
						<div class="m-login__logo">
							<a href="{{ route('welcome') }}">
								<img src="assets/admin/app/media/img/logos/logo-1.png">
							</a>
						</div>
						<div class="m-login__signin">
							<div class="m-login__head">
								<h3 class="m-login__title">Sign in</h3>
							</div>
							<form class="m-login__form m-form" method="POST" action="{{ route('login') }}">
								{{ csrf_field() }}
								<div class="form-group m-form__group">
									<input type="email" class="form-control m-input" placeholder="Email" name="email" required autofocus autocomplete="off">
								</div>
								<div class="form-group m-form__group">
									<input type="password" class="form-control m-input m-login__form-input--last" placeholder="Password" name="password" required minlength="6">
								</div>
								<div class="m-login__form-action">
									<button class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">Sign In</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
        <script src="assets/admin/vEndors/base/vEndors.bundle.js" type="text/javascript"></script>
        <script src="assets/admin/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
		<script src="assets/admin/snippets/pages/user/login.js" type="text/javascript"></script>
	</body>
</html>