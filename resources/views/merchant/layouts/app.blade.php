<!DOCTYPE html>
<html lang="en">
<head>
	<title>Vendor | @yield('title')</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	@include('admin.partials.stylesheets')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/css/uikit.min.css" />

	@stack('styles')
	<style>
		.alert-message{
			display: none;
		}
	</style>
</head>
<body>
<div class="container-fluid">

@include('merchant.partials.header')
@include('merchant.partials.sidebar')
	<div class="containers">
		<div id="page-wrapper">
		    <div class="alert alert-danger alert-message">
			</div>
			<div class="alert alert-success alert-message">
			</div>
			@yield('content')
		</div>
	</div>
	@include('merchant.partials.footer')
</div>



</body>
<!-- UIkit JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/js/uikit.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/js/uikit-icons.min.js"></script>

@include('admin.partials.scripts')
@stack('scripts')

</html>