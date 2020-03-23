

<?php $__env->startSection('title'); ?>
ProcMS - Innoventory
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>

<h2>Innoventory - How to?</h2>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('dboard')); ?>">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">How to?</li>
	</ol>
</nav>

<div class="row">
	<div class="col-sm-12">
	<iframe src="https://docs.google.com/presentation/d/e/2PACX-1vTRNVdhYm2QG6ncYqPDL0a9NrApyPIwZuiiaG6-WmiIEtoDCJuKUcIX57QvcE3wHHrOvRnFNUIPiQrJ/embed?start=false&loop=true&delayms=3000" frameborder="0" width="1440" height="839" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>