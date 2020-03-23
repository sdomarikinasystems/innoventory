<!DOCTYPE html>
<html>
<head>
<title>@yield('title')</title>
	<!-- CHARSET AND MOBILE VIEW -->
	<meta charset="utf-8">
	<link rel='icon' href='{{ asset("images/sdo.ico") }}' type='image/x-icon'/ >
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- BOOTSTRAP -->
	<link rel="stylesheet" type="text/css" href="{{asset('apicore/css/bootstrap.min.css') }}">
	<!-- JQUERY, POPPER, BOOTSRAP JS -->
	<script type="text/javascript" src="{{asset('apicore/jquery-3.3.1.min.js') }}"></script>
	<script type="text/javascript" src="{{asset('apicore/popper.min.js') }}"></script>
	<script type="text/javascript" src="{{asset('apicore/js/bootstrap.min.js') }}"></script>
	<!-- THEME -->
	<!-- 	<link rel="stylesheet" type="text/css" href="theme/sahara/style.css"> -->
	<link href="{{asset('apicore/fontaws/css/all.css') }}" rel="stylesheet">
	<!-- DATA TABLE -->

	<link rel="stylesheet" type="text/css" href="{{asset('apicore/DataTables/datatables.min.css') }}"/>

	<script type="text/javascript" src="{{asset('apicore/DataTables/datatables.min.js') }}"></script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>


<body>
	@include('sweet::alert')
	<div class="container-fluid">
		


@yield('contents')

	</div>
</body>
</html>
