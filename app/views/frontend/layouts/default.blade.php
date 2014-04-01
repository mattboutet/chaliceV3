<!DOCTYPE html>
<!--[if lt IE 9]> <html class="no-js lt-ie9"> <![endif]-->
<!--[if IE 9]> <html class="no-js lt-ie10 ie9"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
	<head>
		<!-- Title, meta -->
		<meta charset="utf-8">
		<title>
			@section('title')
				Chalice App
			@show
		</title>
		<meta name="description" content="Track & complete your chalice list from anywhere! This web app was built by Big Room Studios for Novare Res Bier Café in Portland, Maine.">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv="ClearType" content="true">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimal-ui">
		<meta name="author" content="Matt Boutet">

		<!-- Open Graph tags -->
		<meta property="og:title" content="Chalice App">
		<meta property="og:image" content="{{ asset('assets/ico/apple-touch-icon-152x152-precomposed.png') }}">

		<!-- DNS prefetch -->
		<link rel="dns-prefetch" href="//ajax.googleapis.com">
		<link rel="dns-prefetch" href="//www.google-analytics.com">

		<!-- For iPad with high-resolution Retina display running iOS ≥ 7: -->
		<link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ asset('assets/ico/apple-touch-icon-152x152-precomposed.png') }}">
		<!-- For iPad with high-resolution Retina display running iOS ≤ 6: -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('assets/ico/apple-touch-icon-144x144-precomposed.png') }}">
		<!-- For iPhone with high-resolution Retina display running iOS ≥ 7: -->
		<link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{ asset('assets/ico/apple-touch-icon-120x120-precomposed.png') }}">
		<!-- For iPhone with high-resolution Retina display running iOS ≤ 6: -->
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('assets/ico/apple-touch-icon-114x114-precomposed.png') }}">
		<!-- For the iPad mini and the first- and second-generation iPad on iOS ≥ 7: -->
		<link rel="apple-touch-icon-precomposed" sizes="76x76" href="{{ asset('assets/ico/apple-touch-icon-76x76-precomposed.png') }}">
		<!-- For the iPad mini and the first- and second-generation iPad on iOS ≤ 6: -->
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('assets/ico/apple-touch-icon-72x72-precomposed.png') }}">
		<!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
		<link rel="apple-touch-icon-precomposed" href="{{ asset('assets/ico/apple-touch-icon-precomposed.png') }}">
		<!-- For desktop browsers -->
		<link rel="shortcut icon" href="{{ asset('assets/ico/favicon.ico') }}">

		<!-- Styles -->
		<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

		<!-- Modernizr -->
		<script src="{{ asset('assets/js/vendor/modernizr-2.7.1.min.js') }}"></script>

		<!-- Typekit -->
		<script type="text/javascript" src="//use.typekit.net/xvf5iym.js"></script>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	</head>

	<body>
		<!-- Site -->
		<div class="site" role="document">
			<!-- Header -->
			<header class="site-toolbar" role="banner">
				<div class="wrapper cf">
					<h1 class="site-name"><a href="{{ route('home') }}">Chalice</a></h1>
					<nav class="toolbar-nav" role="navigation">
						@if (Sentry::check())
							<span class="greeting">Welcome, {{ Sentry::getUser()->first_name }}!</span>
							<a href="{{ route('profile') }}" class="button button-secondary">Profile</a>
							<a href="{{ route('logout') }}" class="button button">Logout</a>
						@else
							<a href="{{ route('signup') }}" class="button button-secondary">Join</a>
							<a href="{{ route('signin') }}" class="button button">Login</a>
						@endif
					</nav>
				</div>
			</header>
			
			<!-- Main -->
			<main role="main" class="site-main">
				<div class="wrapper">
					@include('frontend/notifications')
					@yield('content')
				</div>
			</main>

			<!-- Footer -->
			<footer class="site-credits" role="contentinfo">
				<div class="wrapper">
					@if(is_object(Sentry::getUser()) && Sentry::getUser()->hasAccess('admin'))
						<p><a href="{{ route('admin') }}" class="button button-primary">Admin</a></p>
					@endif
					Built by Matt Boutet<br>Powered by <a href="http://bigroomstudios.com">Big Room Studios</a>
				</div>
			</footer>
		</div>

		<!-- jQuery -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
		<script>window.jQuery || document.write("<script src=\"{{ asset('assets/js/vendor/jquery-2.0.3.min.js') }}\"><\/script>")</script>

		<!-- Scripts -->
		<script src="{{ asset('assets/js/plugins.js') }}"></script>
		<script src="{{ asset('assets/js/main.js') }}"></script>

		<!-- Google Analytics (async) -->
		<script>(function(c,a,r,d,n,l){c.GoogleAnalyticsObject=d;c[d]||(c[d]=function(){(c[d].q=c[d].q||[]).push(arguments)});c[d].d=+new Date;n=a.createElement(r);l=a.getElementsByTagName(r)[0];n.src='//www.google-analytics.com/analytics.js';l.parentNode.insertBefore(n,l)}(window,document,'script','ga'));ga('create','UA-49461338-1');ga('send','pageview');</script>

		{{--<!-- Container -->
		<div class="container">
			<!-- Navbar -->
			<div class="navbar navbar-inverse">
				<div class="navbar-inner">
					<div class="container">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>

						<div class="nav-collapse collapse">
							<ul class="nav">
								<li {{ (Request::is('/') ? 'class="active"' : '') }}><a href="{{ route('home') }}"><i class="icon-home icon-white"></i> Home</a></li>
								<li {{ (Request::is('about-us') ? 'class="active"' : '') }}><a href="{{ URL::to('about-us') }}"><i class="icon-file icon-white"></i> About us</a></li>
								<li {{ (Request::is('contact-us') ? 'class="active"' : '') }}><a href="{{ URL::to('contact-us') }}"><i class="icon-file icon-white"></i> Contact us</a></li>
							</ul>

							<ul class="nav pull-right">
								@if (Sentry::check())

								<li class="dropdown{{ (Request::is('account*') ? ' active' : '') }}">
									<a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="{{ route('account') }}">
										Welcome, {{ Sentry::getUser()->first_name }}
										<b class="caret"></b>
									</a>
									<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
										@if(Sentry::getUser()->hasAccess('admin'))
										<li><a href="{{ route('admin') }}"><i class="icon-cog"></i> Administration</a></li>
										@endif
										<li{{ (Request::is('account/profile') ? ' class="active"' : '') }}><a href="{{ route('profile') }}"><i class="icon-user"></i> Your profile</a></li>
										<li class="divider"></li>
										<li><a href="{{ route('logout') }}"><i class="icon-off"></i> Logout</a></li>
									</ul>
								</li>
								@else
								<li {{ (Request::is('auth/signin') ? 'class="active"' : '') }}><a href="{{ route('signin') }}">Sign in</a></li>
								<li {{ (Request::is('auth/signup') ? 'class="active"' : '') }}><a href="{{ route('signup') }}">Sign up</a></li>
								@endif
							</ul>
						</div>
					</div>
				</div>
			</div>

			<!-- Notifications -->
			@include('frontend/notifications')

			<!-- Content -->
			@yield('content')

			<hr />

			<!-- Footer -->
			<footer>
				<p>&copy; Matt Boutet {{ date('Y') }}</p>
			</footer>
		</div>

		<!-- Javascripts
		================================================== -->
		<script src="{{ asset('assets/js/jquery.1.10.2.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>--}}
	</body>
</html>
