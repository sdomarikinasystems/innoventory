<?php $__env->startSection('title'); ?>
CDTRS Online Portal
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<form action="passwordchange_attempt" method="POST">
	<?php echo e(csrf_field()); ?>

	<center>
			<div class="card mt-5" style="max-width: 550px; ">
				<div class="card-body " style="text-align: left;">
			<img src="<?php echo e(asset('images/key.png')); ?>" style="width:60px;">
			<h5 class="card-title">Change your password first</h5>
			<h6 class="card-subtitle text-muted mb-5">In order to proceed to the Online Portal, you have to change your password first! to prevent others from signing-in to your CDTRS Online Portal account.</h6>
			<div class="container">
				<div class="alert alert-light" role="alert">
				  <i class="fas fa-question-circle"></i> Copy and paste is disabled on this page.
				</div>
				<div class="form-group">
					<label>New Password</label>
					<input type="password" required="" minlength="6" class="form-control nocops" id="p1" placeholder="Type here..." name="newpass">
				</div>
				<div class="form-group mb-5">
					<label>Repeat your Password</label>
					<input type="password" required="" minlength="6" class="form-control nocops" id="p2" placeholder="Type here..." name="repeatnewpass">
				</div>
				<div class="form-group">
					<button class="btn btn-success" id="btn_sv"><i class="fas fa-key"></i> Save</button>
				</div>
			</div>
		</div>	
			</div>
	</center>
</form>
<script type="text/javascript">

	$("#btn_sv").attr("disabled", true);
	$('.nocops').bind("cut copy paste",function(e) {
	 e.preventDefault();
	});

	$(".nocops").change(function(){
		if($("#p1").val() == $("#p2").val()){
			$("#btn_sv").attr("disabled", false);

		}else{
			$("#btn_sv").attr("disabled", true);
			popnotification("Password do not match","Your password needs to match in order to confirm your account.",false);
		}
	})

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>