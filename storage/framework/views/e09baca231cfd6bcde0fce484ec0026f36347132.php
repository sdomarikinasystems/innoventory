<?php $__env->startSection('title'); ?>
PMS Inventory
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Asset Upload Result</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navitem" aria-controls="navitem" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navitem">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="assetregistry"><i class="fas fa-arrow-left"></i> Back to Asset Registry</a>
      </li>
    </ul>
  </div>
</nav>
<div class="container-fluid">
  <div class="row mt-2">
  <div class="col-md-12 mb-4">
    <center><h4>Summary</h4></center>
  </div>
  <div class="col-md-2">
    <h6 class="text-muted">Total CSV Assets</h6>
    <h2><?php echo e($total_assets); ?></h2>
  </div>
  <div class="col-md-2">
    <h6 class="text-muted">Inserted</h6>
    <h2><?php echo e($i_newly); ?></h2>
  </div>
  <div class="col-md-2">
    <h6 class="text-muted">Updated</h6>
    <h2><?php echo e($i_existing); ?></h2>
  </div>
    <div class="col-md-2">
     <h6 class="text-muted">Incomplete</h6>
    <h2><?php echo e($i_incomplete); ?></h2>
  </div>
  <div class="col-md-2">
    <h6 class="text-muted">Not Inserted</h6>
    <h2><?php echo e($i_not); ?></h2>
  </div>

  <div class="col-md-12">
    <table class="table table-sm table-bordered table-striped mt-3">
    <thead>
      <tr>
        <th>Property Number</th>
        <th>Asset Item</th>
        <th>Issue</th>
      </tr>
    </thead>
    <tbody>
      <?php echo $i_logs ?>
    </tbody>
  </table>

  </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>