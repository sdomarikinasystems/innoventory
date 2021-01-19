<!DOCTYPE html>
<html>
<head>
<title>@yield('title')</title>
		<link rel='icon' href='{{ asset("images/sdo.ico") }}' type='image/x-icon'/ >
	<!-- CHARSET AND MOBILE VIEW -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- BOOTSTRAP -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<!-- JQUERY, POPPER, BOOTSRAP JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<!-- THEME -->
	<script src="https://kit.fontawesome.com/396c986df7.js" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
	<!-- DATA TABLE -->
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
	<link type="text/javascript" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css"></link>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<style type="text/css">
@font-face {
  font-family: archfont;
  src: url({{ asset('fonts/Archive.otf')  }});
}
.featurefont{
	font-family: archfont;
}

	pre {
    white-space: pre-wrap;       /* Since CSS 2.1 */
    white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
    white-space: -pre-wrap;      /* Opera 4-6 */
    white-space: -o-pre-wrap;    /* Opera 7 */
    word-wrap: break-word;       /* Internet Explorer 5.5+ */
}
	.btn{
		border-radius: 50px;
		border:none;
		min-width: 60px;
		padding-left: 20px;
		padding-right: 20px;
	}

	.alert{
		border-radius: 6px;
	}
	.card{
		border-radius: 10px !important;
		animation-name: scale-in;
		animation-duration: 0.3s;
	}
	.breadcrumb{
		border-radius: 2px !important;
	}
	.modal-content{
		border-radius: 6px !important;
		border:none;
		animation-name: scale-in;
		animation-duration: 0.3s;
	}
	.dropdown-menu{
		border-radius: 6px !important;
		/*border:none;*/
		box-shadow: 0px 20px 50px rgba(0,0,0,0.2);
		background-color: rgba(255,255,255,0.9);
	}
	.form-control{
		border-radius: 6px !important;
		background-color: #dfe4ea;
		border:none;
	}
	.sub-list-group {
		margin-top: 10px;
		list-style-type: none;
	}
	
	.sub-list-group > .sub-list {
		padding: 8px 0;
	}
		.btn-primary{
		background-color: #007DFF;
	}
	.btn-success{
		background-color: #4DDB5E;
	}
	.btn-danger{
		background-color: #FF3A30;
	}
	.btn-secondary{
		color: black;
		background-color: #DEDEDE;
	}
	.btn-warning{
		background-color: #F6CB01;
	}
	@keyframes scale-in{
		0%{
			transform: scale(0.9);
		}
	}
	
</style>

<body>
	@include('sweet::alert')
	<div class="container-fluid">
		@yield('contents')
	</div>
</body>
</html>
