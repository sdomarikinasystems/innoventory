

<?php $__env->startSection('title'); ?>
ProcMS - Innoventory
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>

<h2>Inventory - Items Not Found</h2>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('dboard')); ?>">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('asset_scanned')); ?>">Inventory</a></li>
		<li class="breadcrumb-item active" aria-current="page">Items Not Found</li>
	</ol>
</nav>

<div class="row mt-3">
	<div class="col-md-12 table-responsive table-striped"> 
		<table class="table table-hover table-bordered" id="td_scanned_nf">
			<thead>
				<tr>
					<th scope="col">Property Number</th>
					<th scope="col">Asset Item</th>
					<th scope="col">Asset Classification</th>
					<th scope="col">Current Condition</th>
					<th scope="col">Asset Location</th>
					<th scope="col">Room</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody id="allmyassests_ni">
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
  
  var asset_station = <?php echo json_encode($_GET["myschool_id"]); ?>;
  // alert(asset_station);
fetch_data();
  function fetch_data(){
    $.ajax({
      type: "POST",
      url: "geallscannedass_notincluded",
      data: {_token:"<?php echo e(csrf_token()); ?>",station_info:asset_station },
      success: function(data){
        // alert(data);
        $("#allmyassests_ni").html(data);
        $("#td_scanned_nf").DataTable();
      }
    })
  }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>