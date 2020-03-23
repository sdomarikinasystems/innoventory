<?php $__env->startSection('title'); ?>
CDTRS Online Portal
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<style type="text/css">
	body{

		background-image: url("<?php echo e(asset('images/loginbg.png')); ?>");
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
	}
</style>
<script type="text/javascript">
    $("#mynavbar").css("display","none");
</script>
<!-- <div class="backfill"> -->
	<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class='col-lg-12'>
            <center><h1 class='mt-5 ultratitle' style="color:white;">INNOVENTORY</h1></center>
        </div>
        <div class="col-lg-3">

        </div>
        <div class="col-lg-6">
            <div class="card" style="margin-top: 10px;">
                <div class="card-body">
                    <center><h3 class="ultralight ultratitle"><i class="far fa-user-circle"></i> ProcMS | <span style="color: rgba(0,0,0,0.5);">SIGN-IN</span></h3>
                    <p>Asset Management</p></center>
                    <br>
                    <br>
                    <br>
                    <div class="container">
                        <form action="proc_signin" method="POST">
                           <?php echo e(csrf_field()); ?>

                            <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label><i class="far fa-id-card"></i> DepEd Email</label>
                                    <input required="" autocomplete="off" type="email" placeholder="Type your DepEd Email here..." class="form-control" name="user_employee_id">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label><i class="fas fa-shield-alt"></i> Password</label>
                                    <input required="" autocomplete="off" type="password" placeholder="Type your ProcMS Password here..." class="form-control" name="user_employee_password">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button style="margin-top: 5px;" name="btn_login" class="btn btn-primary float-right" type="submit">Sign in <i class="fas fa-arrow-right"></i></button>
                            </div>
                        </div>
                        </form>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-lg-3">

        </div>
    </div>
</div>
<!-- </div> -->

<center>
    <small style="display: inline-block; margin: 0; bottom: 0;  color: rgba(255,255,255,0.5); left: 0; right: 0; position: fixed; z-index: -1;">Developed by SDO - Marikina ICTU</small>
</center>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master_login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>