<?php $__env->startSection('title'); ?>
ProcMS Innoventory
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<style type="text/css">
	@import  url('https://fonts.googleapis.com/css?family=Work+Sans&display=swap');
	body{
		font-family: 'work sans', sans-serif;
		background-image: url('https://images.pexels.com/photos/242236/pexels-photo-242236.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260');
		background-attachment: fixed;	
	}
	
	.login-container {
		width: 100%;
		margin: 12% auto;
	}
	
	h2, p {
		color: #fff;
	}
	
	p {
		margin-bottom: 0;
	}
	
</style>

<script type="text/javascript">
    $("#mynavbar").css("display","none");
</script>

<div class="container login-container">
	<div class="row">
		<div class="col-sm-6" style="padding: 20px; background-color: #2980b9; border: 1px solid #666;">
			<p>Procurement Management System</p>
			<h2>INNOVENTORY</h2>
			<hr>
			<p>A project of the Schools Division Office - Marikina City <br> for School Year 2020-2021</p>
		</div>
		<div class="col-sm-6 col-left">
			<div class="card">
				<div class="card-header">
					<h5>Sign-in</h3>
				</div>
				<div class="card-body">
					<form action="proc_signin" method="POST">
					   <?php echo e(csrf_field()); ?>

						<div class="row">
						<div class="col-lg-12">							
							<div class="form-group">
								<label><i class="far fa-id-card"></i> DepEd Email</label>
								<input required="" autocomplete="off" type="email" placeholder="" class="form-control form-control-lg" name="user_employee_id">
							</div>
						</div>
						<div class="col-lg-12 col-right">
							<div class="form-group">
								<label><i class="fas fa-shield-alt"></i> Password</label>
								<input required="" autocomplete="off" type="password" placeholder="" class="form-control form-control-lg" name="user_employee_password">
							</div>
						</div>
						<div class="col-lg-12">
							<button style="margin-top: 5px;" name="btn_login" class="btn btn-primary float-right" type="submit">Sign in <i class="fas fa-arrow-right"></i></button>
						</div>				
					</form>
					</div>			
				</div>
			</div>
		</div>
	</div>
</div>

<!-- </div> -->

<center>
    <small style="display: inline-block; margin: 0; bottom: 0;  color: rgba(255,255,255,0.5); left: 0; right: 0; position: fixed; z-index: -1;">Developed by SDO - Marikina ICTU</small>
</center>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master_login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>