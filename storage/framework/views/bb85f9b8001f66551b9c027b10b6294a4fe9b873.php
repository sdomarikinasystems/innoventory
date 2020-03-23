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
</head>
<style type="text/css">
	body,html{
		height: 100%;
	}
	/* width */
::-webkit-scrollbar {
    width: 5px;
    background: rgba(0,0,0,0.1); 
}
.homerow .card{
	background-color: rgba(255,255,255,0.5);
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
	border:none;
	box-shadow: 0px 1px 2px rgba(0,0,0,0.2);
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
    background: rgba(0,0,0,0.1); 
}
/* Handle */
::-webkit-scrollbar-thumb {
    background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: rgba(0,0,0,0.1); 
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
	background-color: #32465B;
	position: fixed;
	width: 256px;
	/*z-index: -1;*/
	display: block;
	margin-top: 57px;
	border-right: 0px;
	padding-left: 0px;
	padding-right: 0px;
	/*z-index: 100;*/
	/*box-shadow: 0px 20px 100px rgb(52, 152, 219,0.2);*/
}
.badge{
	border-radius: 0px;
	font-weight: 0px;
}
.sidebar .sidebar_link{
	color: white;
	font-size: 17px;
	display: block;
	width: 95%;
	border-radius: 0px 3px 3px 0px;
	padding-left: 20px;
	padding-right: 20px;
	padding-top: 2px;
	padding-bottom: 2px;
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
	color:  rgba(255,255,255,0.4);
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
	border-radius: 4px;
	overflow: hidden;
	border: 2px solid rgba(0,0,0,0.03);
	font-family: heavy;
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
	/*border: 2px solid transparent !important;*/
	border-bottom: 2px solid rgba(52, 73, 94,0.5) !important;
	border-radius: 0px;
	background-color: #ecf0f1;
}
.form-control:focus{
	border-bottom: 2px solid #2ecc71 !important;
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
			border: 1px solid rgba(0,0,0,0.05);
				border-radius: 0px;
	background-color: rgba(236, 240, 241,1.0);
	
	box-shadow: 0px 1px 2px rgba(0,0,0,0.2);
	/*border-top : 1px solid white;*/
	border-radius: 4px;
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
			border-bottom: 1px solid rgba(0,0,0,0.2);
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
			animation-name: modal_show;
			animation-duration: 0.8s; 
			box-shadow: 0px 1px 2px rgba(0,0,0,0.2);
			transition: 0.8s all !important;
			border-top : 1px solid rgba(255,255,255,0.1);
			border-radius: 4px;
			/*overflow: hidden;*/


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
	<?php echo $__env->yieldContent('contents'); ?>
</body>
</html>