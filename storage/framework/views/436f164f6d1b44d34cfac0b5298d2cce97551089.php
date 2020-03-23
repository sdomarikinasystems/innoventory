

<?php $__env->startSection('title'); ?>
ProcMS - Innoventory
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>

<h2>Asset Registry - Discrepancies</h2>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page"><a href="/innoventory/dashboard">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page"><a href="/innoventory/asset/registry">Asset Registry</a></li>
		<li class="breadcrumb-item active" aria-current="page">Discrepancies</li>
	</ol>
</nav>

<input type="hidden" value="<?php echo e(session('user_school')); ?>" id="myschool_realid" name="">


<div class="row">
 
<?php

if($_GET["isown"]){
?>

<?php
}else{
?>
	<div class="col-md-12">
		<h5>Asset Discrepancies of <span id="disc_sc_name">(Please wait)</span></h5>
	</div>
	<?php
	}
	?>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title mb-3">Assets with Discrepancy</h5>
				<table class="mt-3 table table-sm">
					<thead>
						<tr>
							<th scope="col">Property Number</th>
							<th scope="col">Asset Item</th>
							<th scope="col">Asset Classification</th>
							<th scope="col">Current Condition</th>
							<th scope="col">Service Center</th>
							<th scope="col">Room</th>
							<th scope="col">Discrepancy</th>
						</tr>
					</thead>
				<tbody id="allassdisctbl">
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal" tabindex="-1" id="modal_th" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title">Import Transaction Histroy</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-sm">
          <thead>
            <tr>
              <th>CSV Upload Count</th>
              <th>Inserted</th>
              <th>Updated</th>
              <th>Incomplete</th>
              <th>Not Inserted</th>
              <th>Transaction Time</th>
            </tr>
          </thead>
          <tbody id="tbl_trhis">
            
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">
  
  $.ajax({
    type: "POST",
    url: "get_export_his",
    data: {_token:"<?php echo e(csrf_token()); ?>"},
    success: function(data){
       $("#tbl_trhis").html(data);
    }
  })



  $.ajax({
    type: "POST",
    url: "get_sc_fn",
    data: {_token:"<?php echo e(csrf_token()); ?>",stationid:<?php echo json_encode($_GET["stationid"]); ?>},
    success: function(data){
       $("#disc_sc_name").html(data);
    }
  })


  Load_Discrepancy_Sum();
  function Load_Discrepancy_Sum(){
     $.ajax({
    type: "POST",
    url: "get_reg_last_sum",
    data: {_token:"<?php echo e(csrf_token()); ?>"},
    success: function(data){
      data = JSON.parse(data);
      $("#tca").html(data[0]["total_csv"]);
      $("#ins").html(data[0]["inserted"]);
      $("#upd").html(data[0]["updated"]);
      $("#inc").html(data[0]["incomplete"]);
      $("#notins").html(data[0]["notinserted"]);
       $("#dtup").html(data[0]["timestamp"]);
       // $("#uploderx").html("By: " + data[0]["username"]);
    }
  })

     $.ajax({
    type: "POST",
    url: "get_discrep_indetail",
    data: {_token:"<?php echo e(csrf_token()); ?>",stationid:<?php echo json_encode($_GET["stationid"]); ?>},
    success: function(data){
      $("#allassdisctbl").html(data);
    }
  })

  }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>