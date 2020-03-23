<?php $__env->startSection('title'); ?>
PMS Inventory
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>

<h2>Asset Registry - Upload Summary</h2>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page"><a href="/innoventory/dashboard">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page"><a href="/innoventory/asset/registry">Asset Registry</a></li>
		<li class="breadcrumb-item active" aria-current="page">Upload Summary</li>
	</ol>
</nav>

<div class="row">
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
	<div class="col-md-2">
		<h6 class="text-muted">Omitted</h6>
		<h2><?php echo e($omcount); ?></h2>
	</div>
</div>

<div class="row">
	<div class="col-sm-12 mb-4">
		<div class="card">
			<div class="card-body table-responsive">
				<h5 class="card-title"><i class="fas fa-exclamation-triangle"></i> Assets with discrepancies</h5>
				<table class="table table-sm table-bordered table-striped " id="tbl_allregups">
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
</div>

<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body table-responsive">
				<h5 class="card-title"><i class="fas fa-search-minus"></i> Assets not found from the recent upload</h5>
				<table class="table table-sm table-bordered table-striped " id="tbl_allomitt">
					<thead>
						<tr>
						  <th scope="col">Property Number</th>
						  <th scope="col">Asset Item</th>
						  <th scope="col">Asset Classification</th>
						  <th scope="col">Current Condition</th>
						  <th scope="col">Service Center</th>
						  <th scope="col">Room</th>
						  <th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php echo $om_logs; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
  $("#tbl_allregups").DataTable();

  var omcount = <?php echo json_encode($omcount); ?>;
  if(omcount != ""){
 $("#tbl_allomitt").DataTable();
 $("#om_panel").css("display","block");
  }else{

    $("#om_panel").css("display","none");
  }
 
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>