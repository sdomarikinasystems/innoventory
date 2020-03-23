<?php $__env->startSection('title'); ?>
CDTRS Online Portal
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<style type="text/css">
	body{

		background-image: url("<?php echo e(asset('images/bliss.jpeg')); ?>");
	}
</style>
<script type="text/javascript">
    $("#mynavbar").css("display","none");
</script>
<!-- <div class="backfill"> -->
	<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-md-3">

        </div>
        <div class="col-md-6">
            <div class="card" style="margin-top: 60px;">
                <div class="card-body">

                    <h3 class="ultralight"><i class="far fa-user-circle"></i> CDTRS Online Portal | <span style="color: rgba(0,0,0,0.5);">Sign-in</span></h3>
                    <p>Employee Dashboard</p>
                    <br>
                    <br>
                    <br>
                    <div class="container">
                        <form action="portal_signin" method="POST">
                            <?php echo e(csrf_field()); ?>

                            <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><i class="far fa-id-card"></i> DepEd Email</label>
                                    <input required="" autocomplete="off" type="email" placeholder="Type your DepEd Email here..." class="form-control" name="username">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><i class="fas fa-shield-alt"></i> Password</label>
                                    <input required="" autocomplete="off" type="password" placeholder="Type your Password here..." class="form-control" name="password">
                                </div>
                            </div>
                            <div class="col-md-12">
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
        <div class="col-md-3">

        </div>
    </div>
</div>
<!-- </div> -->

<center>
    <small style="display: inline-block; margin: 0; bottom: 0;  color: rgba(255,255,255,0.5); left: 0; right: 0; position: fixed; z-index: -1;">Developed by SDO - Marikina ICTU</small>
</center>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>