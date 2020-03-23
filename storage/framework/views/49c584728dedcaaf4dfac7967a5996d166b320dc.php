<?php $__env->startSection('title'); ?>
PMS Inventory
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<input type="hidden" value="<?php echo e(session('user_school')); ?>" id="myschool_realid" name="">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Manage My Account</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navitem" aria-controls="navitem" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navitem">
  <!--   <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#addnewstatmodal"><i class="fas fa-arrow-right"></i> Ad</a>
      </li>
    </ul> -->
  </div>
</nav>

<div class="row mt-3">
  <div class="col-sm-12">
    <table class="table table-bordered table-striped">
      <tr>
        <td>
          <h5 class="card-title">Change Password</h5>
          <h6 class="card-subtitle text-muted mb-3">Change your account's security password</h6>
          <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#m_cp">Change Password</button>
        </td>

      </tr>
      <tr>
         <td>
          <h5 class="card-title">Change Account Name</h5>
          <h6 class="card-subtitle text-muted mb-3">Change the name of your Innoventory Account</h6>
          <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#m_cn">Change Account Name</button>
        </td>
      </tr>

    </table>
  </div>
</div>

<form action="../../cha_pass" method="POST">
  <div class="modal" tabindex="-1" id="m_cp" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Change Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php echo e(csrf_field()); ?>

         <div class="form-group">
           <label>Type your current password here</label>
           <input class="form-control" type="password" required="" placeholder="Type here..." name="olpas">
         </div>
         <div class="row">
           <div class="col-sm-6">
                 <div class="form-group">
           <label>New Password</label>
           <input class="form-control" type="password" required="" placeholder="Type here..." name="newpas">
         </div>
           </div>
           <div class="col-sm-6"> 
            <div class="form-group">
           <label>Re-type New Password</label>
           <input class="form-control" type="password" required="" placeholder="Type here..." name="renewpas">
         </div>
           </div>
         </div>
              
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Change Password</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</form>

<form action="../../cha_acname" method="POST">
  <div class="modal" tabindex="-1" id="m_cn" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Account Name</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <center>Feature unavailable in development stage.</center>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>