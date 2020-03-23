<?php
$acc_badge = "";
$at = "";
if (session("user_uname") == "" || session("user_uname") == null) {
  ?>
  <script type="text/javascript">
  	window.location.href = "proc_logout_now";
  </script>
  <?php
}else{
	$at = session("user_type");
	// <span class="badge badge-warning">ADMIN</span>
	switch (session("user_type")) {
		case '0':
		$acc_badge = '<span title="Administrator" class="badge badge-primary">ADMIN</span>';
		break;
		case '1':
		$acc_badge = '<span title="Supply Officer" class="badge badge-secondary">SUPPOFF</span>';
		break;
		case '2':
		$acc_badge = '<span title="Principal" class="badge badge-success">PRINC</span>';
		break;
		case '3':
		$acc_badge = '<span title="Property Custodian" class="badge badge-warning">PROPCOS</span>';
		break;
		case '4':
		$acc_badge = '<span title="Division or Teaching Personnel" class="badge badge-info">DOT</span>';
		break;
	}
}
?>
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
	<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
	<link type="text/javascript" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css"></link>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
	
	<link href="https://fonts.googleapis.com/css?family=Work+Sans&display=swap" rel="stylesheet">
	<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> -->
	
<style>

body {
	font-family: 'Work Sans', sans-serif;
}
.navbar-brand {
	color: #fff !important;
}

</style>

</head>
<style type="text/css">
	.btn{
		border-radius: 2px;
	}
	.card{
		border-radius: 2px !important;
	}
	.alert{
		border-radius: 2px !important;
	}
	.breadcrumb{
		border-radius: 2px !important;
	}
	.modal-content{
		border-radius: 2px !important;
	}
	.form-control{
		border-radius: 2px !important;
	}
</style>
<body>
	
	<?php echo $__env->make('sweet::alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<nav class="navbar navbar-expand-lg navbar-light bg-dark">
	  <a class="navbar-brand" href="#">INNOVENTORY <small>by SDO - Marikina City</small></a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	
	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	  	<form class="form-inline">
		<!-- <input class="form-control mr-sm-2" type="search" placeholder="QUICK SIGHT" aria-label="Search"> -->
		</form>
	    <ul class="navbar-nav mr-auto">

	    </ul>
	    <div class="dropdown">
	      <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #fff;"><i class="far fa-user-circle"></i> <?php echo strtoupper(session("user_uname")) . " <small>" . $acc_badge . "</small>"; ?>
	      </a>
	    <form action="proc_logout_now" method="GET" class="form-inline my-2 my-lg-0">
	      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
			<a class="dropdown-item" href="manage_myaccount"><i class="fas fa-user"></i> My Account</a>
	        <button class="dropdown-item" type="submit"><i class="fas fa-sign-out-alt"></i> Sign-out</button>
	      </div>
	    </div>
	      </form>
	  
	  </div>
	</nav>

	<div class="container-fluid">
	<div class="row mt-3">
		<div class="col-lg-2 mb-3">
			<h6>CORE</h6>
			<ul class="list-group mb-3">
				<li class="list-group-item"><a href="/innoventory/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
				<li class="list-group-item"><a href="/innoventory/asset/registry"><i class="fas fa-clipboard-check"></i> Asset Registry</a></li>
				<li class="list-group-item"><a href="/innoventory/asset/inventory"><i class="fas fa-search"></i> Inventory</a></li>
				<li class="list-group-item"><a href="/innoventory/asset/disposal"><i class="fas fa-trash"></i> Disposed Assets</a></li>
				<li class="list-group-item"> <a href="/innoventory/asset/inventory/reports"><i class="fas fa-chart-bar"></i> Reports</a></li>
				<li class="list-group-item"><a href="/innoventory/asset/resources"><i class="fas fa-folder"></i> Resources</a></li>
			</ul>
			
			<h6>ADD-ON</h6>
			<ul class="list-group mb-3">
				
					<?php
					if(session("user_type") < "4" && session("user_type") != "2"){
					?>
					<!-- NOT FOR TEACHERS -->					
					<li class="list-group-item"><a href="/innoventory/manage/users"><i class="fas fa-users"></i> Manage Users</a></li>
					<?php
					}
					if(session("user_type") == "0" || session("user_type") == "1"){
					?>
					<!-- FOR ADMIN ONLY -->
					<!--<li class="list-group-item"><a href="/innoventory/manage/schools"><i class="fas fa-school"></i> Manage Schools</a></li>-->
						<?php
						}
						?>
					<?php
					if(session("user_type") < "4"){
						?>
						<!-- FOR SUPPLY OFFICER AND PROPERTY CUSTODIAN ONLY -->
						<li class="list-group-item"> <a href="/innoventory/manage/service_centers"><i class="fas fa-warehouse"></i> Manage Service Centers</a></li>
						<li class="list-group-item"> <a href="/innoventory/manage/reminders"><i class="fas fa-bell"></i> Reminders</a></li>
						<li class="list-group-item"> <a href="<?php echo e(route('fetch_asset')); ?>"><i class="fas fa-tools"></i> Print QR Label</a></li>
						<?php
						}
					?>
				<li class="list-group-item"><a href="<?php echo e(route('ass_transhistory')); ?>"><i class="fas fa-history"></i> History</a></li>
				<li class="list-group-item"><a href="<?php echo e(route('abouts_sys')); ?>"><i class="fas fa-robot"></i> About the System</a></li>
			</ul>
		</div>
		<div class="col-lg-10">
			<?php echo $__env->yieldContent('contents'); ?>
		</div>
	</div>

	</div>
</body>
</html>
