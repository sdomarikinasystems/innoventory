<?php $__env->startSection('title'); ?>
PMS Inventory
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<div class="container">
  <center><h1 class="mt-5 mb-5">DASHBOARD</h1></center>
  <h5 class="card-title mb-3"><i class="fas fa-home"></i> <?php echo strtoupper(session("user_schoolname")); ?></h5>
  <table class="table table-striped table-bordered">
  	<tr>
  		<td>
        <small><a href="mystation" class="float-right"><i class="fas fa-hand-point-right"></i> Manage</a></small>
  			<h5>Asset Locations</h5>
  			<h6 id="count_assloc_created">0</h6>
  		</td>
          <td>
            <small><a href="ass_scnd" class="float-right"><i class="fas fa-hand-point-right"></i> Manage</a></small>
        <h5>Asset Registry</h5>
        <h6 id="count_ass_reg">0</h6>
      </td>
  		<td>
        <small><a href="items_disposed" class="float-right"><i class="fas fa-hand-point-right"></i> Manage</a></small>
  			<h5>Scanned Assets</h5>
  			<h6 id="count_sc_assets">0</h6>
  		</td>
 
  		<td>
  			<h5>Disposed</h5>
  			<h6 id="count_ass_disposed">0</h6>
  		</td>
  	</tr>
  	<tr>
  		<td>
  			<h5>Transactions</h5>
  			<h6 id="count_trans">0</h6>
  		</td>
		<?php 
		if(session("user_type")== "1" || session("user_type") == "0"){
		// DIVISION AND ADMIN ONLY
      ?>
            <td>
        <h5>Overall Accounts</h5>
        <h6 id="count_accounts">0</h6>
      </td>
      <?php
    }
		?>
  	</tr>
  </table>
</div>


<script type="text/javascript">
  
  $.ajax({
    type : "POST",
    url: "get_dash_info",
    data: {_token:"<?php echo e(csrf_token()); ?>"},
    success: function(data){
      var d_data  = data.split(",");
      $("#count_assloc_created").html(d_data[0]);
      $("#count_ass_reg").html(d_data[1]);
      $("#count_sc_assets").html(d_data[2]);
      $("#count_ass_disposed").html(d_data[3]);
       $("#count_trans").html(d_data[4]);
       $("#count_accounts").html(d_data[5]);
    }
  })

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>