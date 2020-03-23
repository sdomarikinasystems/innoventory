<?php $__env->startSection('title'); ?>
PMS Inventory
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">User Management</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navitem" aria-controls="navitem" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navitem">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="https://depedmarikina.ph" target="_blank"><i class="fas fa-globe"></i> DepEd Marikina Website</a>
      </li>

    </ul>
  </div>
</nav>

    <div class="card mt-3">
      <div class="card-body">
        <img src="<?php echo e(asset('images/icon.png')); ?>" style="width: 100px;">
        <h5 class="card-title mt-3">ProcMS - Innoventory <small>v.0.1</small></h5>
        <h6 class="card-subtitle text-muted">Developed by SDO - Marikina Information and Communication Technology Unit (ICTU)</h6>
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>