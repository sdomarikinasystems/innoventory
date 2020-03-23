<?php $__env->startSection('title'); ?>
CDTRS HR | Dashboard
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contents'); ?>

<nav class="navbar navbar-expand-lg" style=" margin-top: 5px; margin-bottom: 15px;">
		  <a class="navbar-brand" href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		
		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
		    </ul>
		  </div>
		</nav>



<div class="container-fluid">
	<div class="row">
	<div class="col-lg-12">
	<h5 class="card-title">Today's Report</h5>
	<h6 class="card-subtitle text-muted mb-3">See today's report in a quick glance</h6>
	</div>
	<div class="col-lg-3">
		<div class="card">
			<div class="card-body">
				<button class="btn btn-secondary btn-sm float-right"><i class="fas fa-arrow-right"></i></button>
				<h5 class="card-title">Attendance</h5>
				<h6 class="card-subtitle text-muted mb-2">234/1,245</h6>
			</div>
		</div>
	</div>
	<div class="col-lg-3">
		<div class="card">
			<div class="card-body">
				<button class="btn btn-secondary btn-sm float-right"><i class="fas fa-arrow-right"></i></button>
				<h5 class="card-title">Applied Leave</h5>
				<h6 class="card-subtitle text-muted mb-2">56 new Leave Report</h6>
			</div>
		</div>
	</div>
	<div class="col-lg-3">
		<div class="card">
			<div class="card-body">
				<button class="btn btn-secondary btn-sm float-right"><i class="fas fa-arrow-right"></i></button>
				<h5 class="card-title">Whereabouts</h5>
				<h6 class="card-subtitle text-muted mb-2">23 today</h6>
			</div>
		</div>
	</div>
	<div class="col-lg-3">
		<div class="card">
			<div class="card-body">
				<button class="btn btn-secondary btn-sm float-right"><i class="fas fa-arrow-right"></i></button>
				<h5 class="card-title">Filed ATA</h5>
				<h6 class="card-subtitle text-muted mb-2">78 today</h6>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="card">
			<div class="card-body">
				<button class="btn btn-secondary btn-sm float-right"><i class="fas fa-arrow-right"></i></button>
				<h5 class="card-title">Online Portal Users</h5>
				<h6 class="card-subtitle text-muted mb-2">399 overall and 12 new</h6>
			</div>
		</div>
	</div>
</div>
</div>

<script type="text/javascript">
	highlight_pagelink("#page_dashboard");
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master_admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>