<?php $__env->startSection('title'); ?>
PMS Inventory
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="/innoventory/asset/registry"><i class="fas fa-chevron-left"></i> Asset Registry</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navitem" aria-controls="navitem" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navitem">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
           <li class="nav-item">
        <a class="nav-link" href="#"><i class="fas fa-arrow-circle-right"></i> <span>Discrepancies</span></a>
    </ul>
  </div>
</nav>

<div class="row">
 
<?php

if($_GET["isown"]){
?>
 <div class="col-md-12">
    <div class="card mt-3">
  <div class="card-body">
    <h5 class="card-title mb-3">Last Transaction</h5>
    <div class="row">
  <div class="col-sm-3">
    <h6 class="text-muted">Last CSV Upload Count</h6>
    <h5 id="tca">0</h5>
  </div>
   <div class="col-sm-3">
    <h6 class="text-muted">Inserted</h6>
    <h5 id="ins">0</h5>
  </div>
  <div class="col-sm-3">
    <h6 class="text-muted">Updated</h6>
    <h5 id="upd">0</h5>
  </div>
    <div class="col-sm-3">
    <h6 class="text-muted">Incomplete</h6>
    <h5 id="inc">0</h5>
  </div>
    <div class="col-sm-3">
    <h6 class="text-muted">Not Inserted</h6>
    <h5 id="notins">0</h5>
  </div>
    <div class="col-sm-3">
    <h6 class="text-muted">Transaction Time</h6>
    <h5 ><a id="dtup" href="#" data-toggle="modal" data-target="#modal_th" title="Click to view import transaction history.">0</a></h5>
  </div>
</div>
  </div>
</div>
  </div>
<?php
}else{
  ?>
 <div class="col-md-12">
  
    <h5 class="mt-3">Asset Discrepancies of <span id="disc_sc_name">(Please wait)</span></h5>
  </div>
  <?php
}
 ?>
  <div class="col-md-12">
    <div class="card mt-3">
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