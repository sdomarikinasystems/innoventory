<?php $__env->startSection('title'); ?>
CDTRS HR | Leave Credits for Non-Teaching Personnel
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contents'); ?>

<nav class="navbar navbar-expand-lg" style=" margin-top: 5px; margin-bottom: 15px;">
		  <a class="navbar-brand" href="#"><i class="fas fa-shield-alt"></i> Maintenance and Security Options</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		
		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
		    </ul>
		  </div>
		</nav>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h5 class="mb-4 mt-4 text-muted">Actions</h5>
		</div>
		<div class="col-lg-4">
			<div class="card" style="height: 190px;">
				<div class="card-body">
					<h5>Data Duplication</h5>
					<h6 class="card-subtitle text-muted mb-5">Remove all duplicated data from Attendance, Leave, Entitlements, etc...</h6>
					<button class="btn btn-sm btn-secondary">Scan</button>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="card" style="height: 190px;">
				<div class="card-body">
					<h5>Suspicious Activities</h5>
					<h6 class="card-subtitle text-muted mb-5">See all suspicious activities in all CDTRS stations.</h6>
					<button class="btn btn-sm btn-secondary">Scan</button>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="card" style="height: 190px;">
				<div class="card-body">
					<h5>Manage CDTRS Stations</h5>
					<h6 class="card-subtitle text-muted mb-5">Deactivate & Block, Communicate and manage to every CDTRS stations available.</h6>
					<button class="btn btn-sm btn-secondary">Scan</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	// highlight_pagelink("#page_lc_nonteaching");
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master_admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>