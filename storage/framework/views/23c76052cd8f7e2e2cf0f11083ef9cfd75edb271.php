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


<body>
	<?php echo $__env->make('sweet::alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<div class="container-fluid">
		


<?php echo $__env->yieldContent('contents'); ?>

	</div>
</body>
</html>
