<!DOCTYPE html>
<html>
<head>
<title>@yield('title')</title>
	       <meta charset="UTF-8">
  <meta name="description" content="ProcMS Inventory by SDO-Marikina City">
  <meta name="keywords" content="Inventory System, DepEd Marikina, SDO Marikina, Procurement Management System, Innoventory">
  <meta name="author" content="Virmil Talattad">
		<link rel='icon' href='{{ asset("images/sdo.ico") }}' type='image/x-icon'/ >
	<!-- CHARSET AND MOBILE VIEW -->

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- BOOTSTRAP -->
	<link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/bootstrap/4.3.1/css/bootstrap.min.css">
	<!-- JQUERY, POPPER, BOOTSRAP JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://ajax.aspnetcdn.com/ajax/bootstrap/4.3.1/bootstrap.min.js"></script>
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
	<link href="http://fonts.cdnfonts.com/css/helvetica-neue-9?styles=49038" rel="stylesheet">
<style type="text/css">
@font-face {
  font-family: archfont;
  src: url({{ asset('fonts/Archive.otf')  }});
}
.featurefont{
	font-family: archfont;
}
body {
  font-family: 'Helvetica 35 Thin', sans-serif;
}
.btn-text {
  padding: 0px !important;
  margin: 0px !important;
  min-width: 0px !important;
  display: inline !important;
}

.xload {
  background: rgba(220, 221, 225,0.7);
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  z-index: 100;
  width: 100%;
  height: 100%;
  position: fixed;
}

.card-body-sm {
  padding: 10px;
}

/* width */

::-webkit-scrollbar {
  width: 4px;
}

/* Track */

::-webkit-scrollbar-track {
  background: white;
  border: 1px solid  #ededed;
}

/* Handle */

::-webkit-scrollbar-thumb {
  background: #e6e6e6;
}

/* Handle on hover */

::-webkit-scrollbar-thumb:hover {
  background: #555;
}

.basic_link {
  text-decoration: none;
}

span.deleteicon {
  position: absolute;
  width: 94%;
}
span.deleteicon span {
  position: absolute;
  display: block;
  top: 11px;
  right: 10px;
  width: 25px;
  height: 25px;
  opacity: 0.5;
  background: url('https://icons.iconarchive.com/icons/iconsmind/outline/512/Close-icon.png') 0 -6px;
  background-size: contain;
  background-position: center;
  background-repeat: no-repeat;
  cursor: pointer;
}

.modal-header {
  text-align: center;
}

.modal-header .modal-title {
  margin: 0 auto  !important;
}

.addtext_anim {
  animation-name: drop_slide !important;
  animation-duration: 0.3s !important;
  display: block !important;
}

@keyframes drop_slide {
  0% {
    opacity: 0;
    margin-top: -10px;
  }

  100% {

  }
}

.addcard_anim {
  animation-name: drop_slide_shadow !important;
  animation-duration: 1s !important;
  display: block !important;
}

@keyframes drop_slide_shadow {
  0% {
    opacity: 0;
    margin-top: -30px;
  }

  50% {
    box-shadow: 0px 10px 30px rgba(0,0,0,0.4);
  }

  100% {

  }
}

.close {
  position: absolute;
  right: 1rem;
}

.announcement_card_body {
  overflow-x: hidden;
  overflow-y: auto;
  max-height: 80vh;
}

.announcement_card {
  width: 565px;
  margin: auto;
}

.card-shadow {
  box-shadow: 0px 2px 3px rgba(0,0,0,0.08),
		0px 10px 30px rgba(0,0,0,0.08);
}

@media only screen and (max-width: 1366px) {
  .announcement_card {
    width: 100%;
    margin: auto;
  }

  .hideinmobile {
    display: none;
  }
}
pre {
  font: 16px 'Helvetica 35 Thin', sans-serif;
  white-space: pre-wrap;
  /* Since CSS 2.1 */
  white-space: -moz-pre-wrap;
  /* Mozilla, since 1999 */
  white-space: -pre-wrap;
  /* Opera 4-6 */
  white-space: -o-pre-wrap;
  /* Opera 7 */
  word-wrap: break-word;
  /* Internet Explorer 5.5+ */
}

.btn {
  border-radius: 50px;
  border: none;
  min-width: 60px;
  padding-left: 20px;
  padding-right: 20px;
}

.alert {
  border-radius: 10px;
}

.clickablething:hover {
  cursor: pointer;
  border-color: #007DFF !important;
}

.card {
  border-radius: 10px !important;
  animation-name: scale-in;
  animation-duration: 0.3s;
  overflow: hidden;
  border-color: #EEEEF2 !important;
}
	.card-header {
  background: #FAFAFC !important;
  border-color: #EEEEF2 !important;
}

.card-footer {
  background: #FAFAFC !important;
  border-color: #EEEEF2 !important;
}

.breadcrumb {
  background: transparent;
  border-radius: 20px !important;
  padding-left: 0px;
}

.modal-content {
  border-radius: 10px !important;
  border: none;
  animation-name: scale-in;
  animation-duration: 0.3s;
  box-shadow: 0px 2px 3px rgba(0,0,0,0.08),
		0px 10px 30px rgba(0,0,0,0.08);
}

.btn:hover {
  box-shadow: 0px 2px 3px rgba(0,0,0,0.08),
		0px 10px 30px rgba(0,0,0,0.08);
}

.dropdown-menu {
  border-radius: 10px !important;
  box-shadow: 0px 2px 3px rgba(0,0,0,0.08),
		0px 10px 30px rgba(0,0,0,0.08);
  border-color: #EEEEF2 !important;
}

.nav-tabs .nav-item .nav-link {
  border-radius: 10px 10px 0px 0px;
  padding: 10px;
  padding-left: 20px;
  padding-right: 20px;
}

.form-control {
  background: #F8F9FA;
  border-radius: 30px !important;
  border: none;
  box-shadow: inset  0px 1px 3px rgba(0,0,0,0.2);
}

.sub-list-group {
  list-style: none;
  margin-top: 10px;
}

.sub-list-group > .sub-list {
  padding: 8px 0;
}

.importwarning {
  display: none;
}

.invalidcolor {
  color: #FF3A30;
}

.btn-primary {
  background: #007DFF;
}

.btn-success {
  background: #4DDB5E;
}

.btn-danger {
  background: #FF3A30;
}

.btn-secondary {
  background: #DEDEDE;
  color: black;
}

.btn-warning {
  background: #F6CB01;
}

.btn-light {
  background: #F0F0F2;
}

.alert-sm {
  padding: 10px;
}

.alert {
  border: none;
}

.alert-primary {
  background: #007DFF;
  color: white;
  text-shadow: 0px 0px 10px rgba(0,0,0,0.4);
}

.alert-success {
  background: #4DDB5E;
  text-shadow: 0px 0px 10px rgba(0,0,0,0.4);
  color: white;
}

.alert-danger {
  background: #FF3A30;
  text-shadow: 0px 0px 10px rgba(0,0,0,0.4);
  color: white;
}

.alert-secondary {
  background: #FAFAFC !important;
  color: white;
}

.alert-warning {
  background: #F6CB01;
  text-shadow: 0px 0px 10px rgba(0,0,0,0.4);
  color: white;
}

.alert-info {
  background: #30A7D5;
  text-shadow: 0px 0px 10px rgba(0,0,0,0.4);
  color: white;
}

.badge-primary {
  background: #007DFF;
  color: white;
  text-shadow: 0px 0px 10px rgba(0,0,0,0.4);
}

.badge-success {
  background: #4DDB5E;
  text-shadow: 0px 0px 10px rgba(0,0,0,0.4);
  color: white;
}

.badge-danger {
  background: #FF3A30;
  text-shadow: 0px 0px 10px rgba(0,0,0,0.4);
  color: white;
}

.badge-secondary {
  background: #DEDEDE;
  color: black !important;
  text-shadow: 0px 0px 10px rgba(0,0,0,0.4);
  color: white;
}

.badge-warning {
  background: #F6CB01;
  text-shadow: 0px 0px 10px rgba(0,0,0,0.4);
  color: white;
}

.td_required {
  color: #FF3A30;
}

.td_optional {
  color: #007DFF;
}

.card-limited {
  height: 400px;
  overflow: scroll;
}

.hcover {
  background: #007DFF;
  transition: 0.2s all;
  display: inline-block;
  padding: 10px;
  border-radius: 15px;
  overflow: hidden;
  height: 50px;
  width: 50px;
  color: white;
  box-shadow: 0px 1px 2px rgba(0,0,0,0.2);
  cursor: pointer;
  margin-left: 5px;
  margin-right: 5px;
  color: white !important;
}

.hcover:hover {
  transform: scale(1.3);
  margin-top: -10px;
  box-shadow: 0px 2px 3px rgba(0,0,0,0.08),
		0px 10px 30px rgba(0,0,0,0.08);
  text-shadow: 0px 2px 5px rgba(0,0,0,0.4);
}

.dock_parent {
  background: transparent;
  position: fixed;
  display: flex;
  justify-content: center;
  bottom: 0;
  left: 0;
  right: 0;
  margin: auto;
  padding: 10px;
  border-radius: 15px;
  margin-bottom: 5px !important;
  width: 100%;
}

.dock_itself {
  background: white;
  position: absolute;
  display: flex;
  justify-content: center;
  height: 72px;
  border: 1px solid rgba(0,0,0,0.1);
  bottom: 0;
  margin: auto;
  padding: 10px;
  padding-left: 7px;
  padding-right: 7px;
  border-radius: 20px;
  box-shadow: 0px 2px 3px rgba(0,0,0,0.08),
		0px 10px 30px rgba(0,0,0,0.08);
  margin-bottom: 5px !important;
  width: auto;
}
	.tridify {
		text-transform: uppercase;
		color: #f5f5f5;
		text-shadow: 1px 1px 1px #919191,
		1px 1px 1px #919191,
		1px 2px 1px #919191,
		1px 3px 1px #919191,
		1px 4px 1px #919191,
		1px 5px 1px #919191,
		1px 6px 1px #919191,
		1px 7px 1px #919191,
		1px 4px 1px #919191,
		1px 5px 1px #919191,
		1px 5px 6px rgba(16,16,16,0.4),
		1px 7px 10px rgba(16,16,16,0.2),
		1px 8px 35px rgba(16,16,16,0.2),
		1px 10px 60px rgba(16,16,16,0.4);
	}
</style>

<body>
	@include('sweet::alert')
	<div class="container-fluid">
		@yield('contents')
	</div>
</body>
</html>
