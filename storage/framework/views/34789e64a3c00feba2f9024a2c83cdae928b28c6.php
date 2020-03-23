<?php $__env->startSection('title'); ?>
CDTRS Online Portal
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>

	<div class="jumbotron" >
		<div class="row">
			<div class="col-lg-2">
				<center>
					<div class="bgworthy" style="background-image: url(<?php echo e(asset('images/user.png')); ?>); width: 156px; height: 156px; border-radius: 50%;">
				</div>
				</center>
			</div>
			<div class="col-lg-10">
				<div class="form-group">
					<span><span class="lessen">Hi there,</span> <h3 class="ultrathin"><?php echo e(session('user_formattedname')); ?></h3></span>
					<span><span class="lessen">Employee Type:</span> <span><?php echo e(session('user_formattedusertype')); ?></span></span><br>
					<span><span class="lessen">Schedule:</span> <span><?php echo e(session('user_formattedschedule')); ?></span></span><br>
					<span><span class="lessen">Station:</span> <span><?php echo e(session('user_company')); ?></span></span><br>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">
		$("#mynavbar").css("display","inline-flex");
		activ_link("#ll_ad");
</script>
<?php echo $__env->make('comp.dashboard_modals', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>