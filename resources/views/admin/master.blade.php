<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title > @yield('title') </title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ asset('public/artisan/assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('public/artisan/assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('public/artisan/assets/css/core.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('public/artisan/assets/css/components.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('public/artisan/assets/css/colors.css') }}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->
	<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
	<!-- Core JS files -->
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/loaders/pace.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/core/libraries/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/core/libraries/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/loaders/blockui.min.js') }}"></script>
	<!-- /core JS files -->
	

	@yield('asset')
	

</head>

<body class="has-detached-right">

	<!-- Main navbar -->
	@include('admin.includes.navbar')
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			@include('admin.includes.sidebar')
			<!-- /main sidebar -->

			<div class="content-wrapper">

			<!-- Main content -->
			@yield('content')
			<!-- /main content -->

			
			</div>


		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</body>
</html>
