<!DOCTYPE html>
<html>
<head>
<title><?php echo $__env->yieldContent('title'); ?></title>
	<!-- CHARSET AND MOBILE VIEW -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- BOOTSTRAP -->
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('apicore/css/bootstrap.min.css')); ?>">
	<!-- JQUERY, POPPER, BOOTSRAP JS -->
	<script type="text/javascript" src="<?php echo e(asset('apicore/jquery-3.3.1.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('apicore/popper.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('apicore/js/bootstrap.min.js')); ?>"></script>
	<!-- THEME -->
	<!-- 	<link rel="stylesheet" type="text/css" href="theme/sahara/style.css"> -->
	<link href="<?php echo e(asset('apicore/fontaws/css/all.css')); ?>" rel="stylesheet">
	<!-- DATA TABLE -->

	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('apicore/DataTables/datatables.min.css')); ?>"/>

	<script type="text/javascript" src="<?php echo e(asset('apicore/DataTables/datatables.min.js')); ?>"></script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<style type="text/css">
			.notifbox{
			position: fixed;
			padding: 10px;
			border-radius: 1px;
			background-color: rgba(236, 240, 241,1.0);
							box-shadow: 0px 1px 50px rgba(0,0,0,0.2);
			width: 400px;
			display: block;
			top: 0;
			right: 0;
			margin: 20px;
			margin-top:60px;
			z-index: 1000000000;
			transition: 4.8s all;
			animation-name: shownotif;
			animation-duration: 5s;
			display: none;
			border:none;
			border-radius: 3px;
			border: 1px solid rgba(0,0,0,0.1);
			perspective:1000px !important;

		}
@keyframes  shownotif{
	0%{
		margin-right: -20px;
		opacity: 0;
	}
	10%{
		margin-right: 10px;
		opacity: 1;
		transform: scale(1);
	}
	90%{
		margin-right: 10px;
		opacity: 1;
		transform: scale(1);
	}
	100%{
		margin-right: -20px;
		opacity: 0;
		transform: scale(0.9);
	}
}
</style>
<script type="text/javascript">
	$("html").append('<div class="notifbox">' +
'<h4 class="not_title">Notification</h4>' +
'<p class="not_desc">Hello, World!</p>' +
'</div>');
function popnotification(title, message,isrefresh){
$(".notifbox").css("display","block");
$(".not_title").html(title);
$(".not_desc").html(message);
$(".notifbox").css("margin-right","20px");
setTimeout(function(){
$(".notifbox").css("display","none");
if(isrefresh == true){
	window.location.reload();
}},5000)}
</script>
</head>
<style type="text/css">
	/* width */
::-webkit-scrollbar {
    width: 2px;
    background: rgba(0,0,0,0.1); 
}
.sidebar ::-webkit-scrollbar {
    width: 2px;
    background: rgba(0,0,0,0.1); 
}
.homerow .card{
	background-color: rgba(255,255,255,0.5);
}
.notificationpanel-header{
	padding: 15px;
}
.hoverableitem{
	transition: all 0.3s;

}
.hoverableitem:hover{
	cursor: pointer;
	box-shadow: 0px 5px 8px rgba(0,0,0,0.2);

}
.loading_indicator{
	display: block;
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
	position: absolute;
	height: 100%;
	width: 100%;
	z-index: 100;
	background-color: white;
	background: url("<?php echo e(asset('images/loading.gif')); ?>");
	background-position: center;
	background-repeat: no-repeat;
	background-size: 150px auto;
	background-color: white;
	display: none;
}
@keyframes  OpenNotif{
0%{
margin-right: -400px;
}
100%{
margin-right: 0px;
}
}

.notificationpanel{
	animation: OpenNotif;
		animation-duration: 0.5s;
		transition: all 0.5s;
        margin: 0px;
	top: 0;
	bottom: 0;
	right: 0;
	position: fixed;
	z-index: 1000000;
	background-color: #34495e;
	box-shadow: 0px 2px 5px rgba(0,0,0,0.2);
	width: 400px;
	border: 1px solid rgba(255,255,255,0.2);
	border-radius: 0px;
	color: white;
	overflow: hidden;
	padding-left: 20px;
	padding-right: 20px;
}
.notificationpanel-body{
	padding: 10px;
}
.padder{
	padding-top: 80px;
	padding-bottom: 80px;
}

.reveal{
	animation-name: reveal;
	animation-duration: 1s;
}
    .wholebar{display: block; position: fixed; top: 0; bottom: 0; left: 0; right: 0; margin: 50px; margin-top: 80px;
       overflow: hidden;
       border-radius: 4px;
       /*box-shadow: 0px 0px 50px rgba(0,0,0,0.5);*/
    }
    .wholebar .wholebar_left{
        display: block;  position: relative; top: 0; bottom: 0; left: 0; width: 50%; height: 100%; float: left;
        overflow-x: hidden;
        overflow-y: auto;
    }
     .wholebar .wholebar_right{
        display: block;  position: relative; top: 0; bottom: 0;  right: 0; width: 50%; height: 100%; float: right;
       /*background-color: ;*/
       background-color: rgba(255,255,255,0.7);
        padding: 20px;
        /*overflow-x: hidden;*/
        /*overflow-y: auto;*/
        overflow: hidden;
    }
        .wholebar .wholebar_top{
        display: block;  position: relative; top: 0;  left: 0; right: 0; width: 100%; height: 50%; float: top;
       
        padding: 5px;
    }
     .wholebar .wholebar_bottom{
        display: block;  position: relative; bottom: 0; left: 0; right: 0; width: 100%; height: 50%; float: bottom;
       
        padding: 5px;
    }
@keyframes  reveal{
0%{
opacity: 0.3;
transform: scale(0.9);
margin-bottom: -256px;
/*box-shadow: 0px 20px 50px gray;*/
/*padding:20px !important;*/
/*border-radius: 10px;*/
/*border: 1px solid black;*/
background-color: #bdc3c7 !important;
}
60%{
transform: scale(0.9);
margin-bottom: 0px;
/*box-shadow: 0px 20px 50px gray;*/
/*padding:20px !important;*/
/*border-radius: 10px;*/
/*border: 1px solid black;*/
background-color: #bdc3c7 !important;
}
100%{

}
}
.flipper{
animation-name: flipper;
animation-duration: 0.3s;
}
@keyframes  flipper{
0%{

transform: rotateX(60deg);
}
100%{

}
}
.softslide{
animation-name: softslide;
animation-duration: 0.5s;
}
@keyframes  softslide{
0%{

transform: scale(0.6) rotateY(60deg);
}
100%{

}
}
.bgworthy{
	background-size: cover;
	background-position: center;
	background-repeat: no-repeat;
	width: 100%;
padding:20px;
padding-top: 50px;
padding-bottom:50px;
	color: white;
	text-shadow: 1px 1px 1px black;
}
.modal .bgworthy{
	border-radius:  4px 4px 0px 0px;
}
  video, canvas {
    margin-left: 230px;
    margin-top: 120px;
    position: absolute;
  }
.card-link{
	color: #34495e;
}

.nav-link{
	border-radius: 0px !important;
}
.alert{
	border-radius: 0px;
	border: 1px solid rgba(0,0,0,0.1);
}
.nav-item{
	border-radius: 0px !important;
}
.backfill{
	  background: rgba(44, 62, 80,0.6);
	  display: block;
	  position: absolute;
	  top: 0;
	  right: 0;
	  bottom: 0;
	  left: 0;
	  height: 100%;
	  width: 100%;
}

		.cameraapp{
			border-radius: 15px !important;
			overflow: hidden;
			width: 320px;
			height: 240px;
		}
.lessen{
	opacity: 0.5;
}
/* Track */
::-webkit-scrollbar-track {
    background: rgba(0,0,0,0) !important; 
}
/* Handle */
::-webkit-scrollbar-thumb {
    background: #34495e; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: rgba(0,0,0,0) !important; 
}
.consistent_shadow{
	box-shadow: 0px 1px 2px rgba(0,0,0,0.2);
}
.sidebar{
	background-position: center !important;
	background-size: cover !important;
	background-attachment: fixed !important;
	top: 0;
	bottom: 0;
	padding: 20px;
	left: 0;
	background-color: #ECEFF1;
	position: fixed;
	width: 256px;
	/*z-index: -1;*/
	display: block;
	margin-top: 57px;
	border-right: 0px;
	padding-left: 0px;
	padding-right: 0px;
	/*z-index: 100;*/
	overflow: auto;
	/*font-family: sanfranc;*/
	/*box-shadow: 0px 20px 100px rgb(52, 152, 219,0.2);*/
}
.badge{
	border-radius: 0px;
	font-weight: 0px;
}
.sidebar .sidebar_link{
	color: #2c3e50;
	font-size: 17px;
	display: block;
	width: 95%;
	border-radius: 0px 3px 3px 0px;
	padding-left: 20px;
	padding-right: 20px;
	padding-top: 8px;
	padding-bottom: 8px;
	font-size: 16px;
	text-decoration: none;
	transition: 0.3s all;
	border-top: 1px solid transparent;
	border-bottom: 1px solid transparent;
}
.separator{
	border-top: 1px solid rgba(0,0,0,0.1) !important;
}
.sidebar .sidebar_title{
	padding-left: 20px;
	padding-right: 20px;
	color: #546E7A;
}
.sidebar .sidebar_link:hover{
		/*color: white !important;*/
background: rgba(0,0,0,0.1); /* Old browsers */
}
.thumbimage{
	width: 100%;
	height: 100px;
	background-size: cover;
	background-repeat: no-repeat;
	border-radius: 4px;
	background-position: center;
	border: 2px solid #2c3e50;
}
.rightbar{
		position: fixed;
		top: 0;
		bottom: 0;
		right: 0;
		left: 280;
		width: 100%;
		padding-left: 256px;
		margin-top: 50px;
		background-color: white;
		display: block;
		z-index: -2;
		overflow-x:hidden;
		overflow-y:auto;
		animation-name: rbar;
		animation-duration: 0.5s;
}
.rightbar .navbar{
	background-color: white !important;
}
.rightbar .navbar .nav-link{
	color: #2c3e50 !important;
}
.rightbar .navbar .navbar-brand{
	color: #2c3e50 !important;
}
@keyframes  rbar{
	0%{
		opacity: 0.5;
	}
}
/*INDEX*/
.poptop_anim{

animation-name: poptop !important;
animation-duration: 0.5s !important;

}

@keyframes  poptop{
	0%{
		/*transform: scale(1.1);*/
		margin-top: 50px;
		opacity: 0;
	}
}
			.heightscale_anim{
animation-name: heightscale !important;
animation-duration: 0.5s !important;
overflow: hidden;
}
@keyframes  heightscale{
	0%{
		transform: scale(0.8);
	}
}

.fadeinner{
			width:20%; height: 50px; margin:5px; 
			background-position: center;
			background-size: cover;
			animation-name: fader;
			animation-duration: 5s;
			display:block;
			float: right;
			transition: 5s all;
			border-radius: 2px;
		}
		.fadeinner_full{
			width: 80%; height: 100px; margin:5px; 
			background-position: center;
			background-size: cover;
			animation-name: fader;
			animation-duration: 5s;
			display:block;
			float: right;
			transition: 5s all;
			border-radius: 2px;
		}
		.c1{
			animation-name: put_contents;
			animation-duration: 1s;
		}
		@keyframes  put_contents{
			0%{
				margin-top: 10px;
				transform: scale(1.1);
			}
		}
/*INDEX*/
@font-face{
	  font-family: 'sanfranc';
  src: url('<?php echo e(asset("fonts/sanfrancisco_pro.ttf")); ?>'); /* IE9 Compat Modes */
}
@font-face{
	  font-family: 'sanfranc_black'; src: url('<?php echo e(asset("fonts/sanfrancisco_black.ttf")); ?>'); /* IE9 Compat Modes */
}
@font-face{
	  font-family: 'heavy'; src: url('<?php echo e(asset("fonts/heavy.ttf")); ?>'); /* IE9 Compat Modes */
}
@font-face{
	 font-family: 'sanfranc_thin'; src: url('<?php echo e(asset("fonts/sf_thin.ttf")); ?>'); /* IE9 Compat Modes */
}

		.notifbox{
			position: fixed;
			padding: 10px;
			border-radius: 1px;
			background-color: rgba(236, 240, 241,1.0);
							box-shadow: 0px 1px 50px rgba(0,0,0,0.2);
			width: 400px;
			display: block;
			top: 0;
			right: 0;
			margin: 20px;
			margin-top:60px;
			z-index: 1000000000;
			transition: 4.8s all;
			animation-name: shownotif;
			animation-duration: 5s;
			display: none;
			border:none;
			border-radius: 3px;
			border: 1px solid rgba(0,0,0,0.1);
			perspective:1000px !important;

		}
@keyframes  shownotif{
	0%{
		margin-right: -20px;
		opacity: 0;
	}
	10%{
		margin-right: 10px;
		opacity: 1;
		transform: scale(1);
	}
	90%{
		margin-right: 10px;
		opacity: 1;
		transform: scale(1);
	}
	100%{
		margin-right: -20px;
		opacity: 0;
		transform: scale(0.9);
	}
}
.lgmodal{
	top: 0;
	left: 0;
	right: 0;
	display: block;
	background-color: rgba(255,255,255,0.5);
	position: fixed;
	z-index: 100;
	height: 100%;
	width: 100%;
	overflow: auto;
	text-align: center;
	display: none;
}
.btn{
	border-radius: 0px;
	background-color: white;
	border: 0px;
	/*box-shadow: 0px 1px 2px rgba(0,0,0,0.2);*/
	border-top : 1px solid white;
	border-radius: 2px;
	overflow: hidden;
	border: 1px solid rgba(0,0,0,0.03);
	font-family: /*heavy*/;
}
.btn:hover{
	color: #2c3e50 !important;	
border-color: #2c3e50 !important;	
background-color: white;
}
	progress[value] {
  /* Reset the default appearance */
  -webkit-appearance: none;
   appearance: none;

  width: 250px;
  height: 20px;
}

progress[value]::-webkit-progress-bar {
  background-color: #eee;
  border-radius: 4px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.25) inset;
  border: 1px solid rgba(0,0,0,0.2);
}

progress[value]::-webkit-progress-value {
 /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#2da0ff+0,0082ed+100 */
background: #2da0ff; /* Old browsers */
background: -moz-linear-gradient(top, #2da0ff 0%, #0082ed 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(top, #2da0ff 0%,#0082ed 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to bottom, #2da0ff 0%,#0082ed 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#2da0ff', endColorstr='#0082ed',GradientType=0 ); /* IE6-9 */

    border-radius: 3px; 
    background-size: 35px 20px, 100% 100%, 100% 100%;
}
.btn-light{
color: #2c3e50 !important;	
border-color: #2c3e50 !important;
}
.btn-primary{
/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#2da0ff+0,0082ed+100 */
background-color: #2c3e50;
border-color: #2c3e50;
color: white;
}
.btn-success{
color: white !important;	
border-color: #27ae60 !important;	
background-color: #27ae60 !important;
}
.btn-secondary{
color: #2c3e50 !important;	
border-color: #2c3e50 !important;	
}

.btn-danger{
color: #c0392b !important;	
border-color: #c0392b !important;
}
.dropdown-menu{
	border-radius: 0px;
	border: none;
	box-shadow: 0px 1px 2px rgba(0,0,0,0.2);
	border: 1px solid rgba(0,0,0,0.1);
}
.form-control{
	border: none !important;
	border-bottom: 1px solid rgba(52, 73, 94,0.5) !important;
	border-radius: 0px;
	background-color: transparent;
}
.form-control:focus{
	 outline:none !important;
}
.form-group label{
	color: #34495e;
}
nav .form-control{
border-radius: 0px;
border: 1px solid rgba(0,0,0,0.1);
}
.dropdown-menu a{
	padding: 12px;
}
.dropdown-menu a:hover{
	cursor: pointer !important;
	color: white !important;
background-color: #34495e;
}

.dropdown-item:hover{
	cursor: pointer !important;
	color: white !important;
background-color: #34495e !important;
}

.ultrabold{
	font-family:sanfranc_black;
}
.ultrathin{
	font-family:sanfranc_thin;
}
.lgmodal-close{
/*position: fixed;*/
				box-shadow: 0px 1px 2px rgba(0,0,0,0.2);
border:none;
border-radius: 0px 0px 10px 10px;
display: inline-block;
background-color: white;
}
.lgmodal-inner{
	background-color: white;
	height: 90%;
	width: 95%;
	display: block;
	margin: 0 auto;
	margin-top: 20px;

	margin-bottom: 50px;
					box-shadow: 0px 1px 2px rgba(0,0,0,0.2);
	border-radius: 10px;
	/*overflow: hidden;*/
}
button[disabled]{
  border: 1px solid #999999 !important;
  background-color: #cccccc !important;
  color: #666666 !important;
  opacity: 0.4 !important;
}



	body{
			font-family: sanfranc !important;
			overflow-x: hidden;
			margin-bottom: 100px;
			background-size: cover;
			background-attachment: fixed;
			animation-name: faderx !important;
			animation-duration: 1s !important;
	}
	@keyframes  faderx{
		0%{
			opacity: 0.5 !important;
		}
	}
	
		.hasbg{
			 background-repeat: no-repeat !important;
			background-attachment: fixed !important;
			background-position: center !important;
			background-size: cover !important;
			text-shadow: 0px 20px 50px rgba(0,0,0,0.5) !important; 
			color: white !important;

		}
		.hasbg hr{
			border-top: 1px solid white !important;
		}
		.custom-select{
			padding-left: 20px !important;
			padding-right: 20px !important;
		}
		.blurbg{
			background-color: #2980b9;
			background-position: center !important;
			background-size: cover !important;
			background-attachment: fixed !important;
		}
		.blurbg_sub{
					background-color: #2c3e50;
			background-position: center !important;
			background-size: cover !important;
			background-attachment: fixed !important;
		}
		.xfooter{
			text-shadow: 0px 5px 30px rgba(0,0,0,0.3);
			color: #222 !important;
			position: fixed;
			left: 0;
			bottom: 0;
			width: 100%;
			font-size: 12px;
			padding: 10px;
			background-color: transparent;
		}
		.table{
			animation-name : opentable;
			animation-duration: 0.5s;
		}
		.card .table{
			animation-name : openwindow;
			animation-duration: 0.5s;
		}
		.card{
			border: 0px;
			border: 1px solid #CFD8DC;
				border-radius: 0px;
	background-color:white;
	
	/*box-shadow: 0px 1px 2px rgba(0,0,0,0.2);*/
	/*border-top : 1px solid white;*/
	border-radius: 3px;
	/*overflow: hidden;*/
	margin-bottom: 5px;
		}
		.card-header{
			border: none !important;
			border-radius: 0px !important;
		}
		h1{
			animation-name : slidetitle !important;
			animation-duration: 0.5s;
		}
		a{
			color: #03A9F4;
		}
		.majortext{
			color: black !important;
		}
		.jumbotron{
			background-color: white;
			background-position: bottom;
			background-size: cover;
			/*background-attachment: fixed;*/
			color: #34495e;
			border-radius: 0px;
			padding: 20px;
			padding-top: 30px;
			padding-bottom: 30px;
			/*text-shadow: 0px 0px 70px rgba(0,0,0,0.2);*/
		}
		.defaultbg{
			background-color: #ecf0f1;
			background-position: center;
			background-size: cover;
			background-attachment: fixed;
		}
			.navbar{
			background-color: #ecf0f1;
			background-position: center;
			background-size: cover;
			background-attachment: fixed;
			/*border-bottom: 1px solid rgba(0,0,0,0.2);*/
			border-top: none;
		}
		.modal{
			background-color: rgba(127, 140, 141,0.4);
		}
		.modal-content{
			/*overflow: hidden;*/
			background-color: #ecf0f1;
			background-position: center;
			background-size: cover;
			background-attachment: fixed;
			border: none;
			border-radius: 0px;
			box-shadow: 0px 1px 2px rgba(0,0,0,0.2);
			transition: 0.8s all !important;
			border-top : 1px solid rgba(255,255,255,0.1);
			border-radius: 4px;
			overflow: hidden;
			perspective: 1000px;

		}
		@keyframes  modal_show{
			0%{
				opacity: 0;
				transform: scale(0.8);
			}
			60%{
				transform: scale(1);
			}
		}
		.modal-footer{
			border: none;
		}
		.modal-header .ptitle{
			width: 70%;

			font-size: 15px;
			text-align: center;
			width: 100%;
		}
		.modal-header .ptitle small{
			color: black;
		}
		.modal-header .ptitle img{
			float: left;
		}
		.labelinput{
			text-align: center; border: none; background-color: transparent !important;
		}



</style>


<body>
	<div class="container" id="mycont">
	<nav class="navbar navbar-expand-lg navbar-light bg-light" style="display: none; width: 100%;"  id="mynavbar">
	 <a class="navbar-brand" href="#" ><i class="far fa-user-circle"></i> CDTRS Online Portal</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	
	   <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	    	<li class="nav-item active">
			<a class="nav-link" href="<?php echo e(route('dashboard')); ?>" id="ll_dash"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
			</li>
			<li class="nav-item active">
			<a class="nav-link" href="<?php echo e(route('goto_leavehistory')); ?>" id="ll_lh"><i class="fas fa-walking"></i> Leave History</a>
			</li>
			<li class="nav-item active">
			<a class="nav-link" href="<?php echo e(route('account_details')); ?>" id="ll_ad"><i class="fas fa-portrait"></i> Account Details</a>
			</li>
	    </ul>
	    <form action="portal_logout" method="GET" class="form-inline my-2 my-lg-0">
	    	<?php echo e(csrf_field()); ?>

	      <button class="btn btn-light my-2 my-sm-0" type="submit"><i class="fas fa-sign-out-alt"></i> Sign-out</button>
	    </form>
	  </div>
	</nav>
		
	<?php echo $__env->make('sweet::alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<script type="text/javascript">
		function activ_link(idlink){
		$(idlink).css("font-weight","bold");
		}

		function getWidth() {
		return Math.max(
		document.body.scrollWidth,
		document.documentElement.scrollWidth,
		document.body.offsetWidth,
		document.documentElement.offsetWidth,
		document.documentElement.clientWidth
		);
		}

		setInterval(function(){
		var mywidth = getWidth();


		if (mywidth < 987) {
		$('#mycont').addClass('container-fluid').removeClass('container');
		$('#mycont').css("padding","0px");
		}else{
		$('#mycont').addClass('container').removeClass('container-fluid');

		}
		},500)
	</script>
	<?php echo $__env->yieldContent('contents'); ?>

	</div>
</body>
</html>
