<?php $__env->startSection('title'); ?>
PMS Inventory
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Scanned Items</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navitem" aria-controls="navitem" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navitem">
    <ul class="navbar-nav mr-auto">
    </ul>
  </div>
</nav>
<div class="row mt-3">
  <div class="col-sm-3">
    <!-- <div class="card"> -->
      <!-- <div class="card-body" style="min-height: 110px;"> -->
           <h5 class="card-title"><i class="fas fa-calculator"></i> Total Scanned</h5>
        <h6 class="card-subtitle text-muted mb-2" id="itms_total">0</h6>
      <!-- </div> -->
    <!-- </div> -->
  </div>
   <div class="col-sm-3">
    <!-- <div class="card"> -->
      <!-- <div class="card-body" style="min-height: 110px;"> -->
        <h5 class="card-title"><i class="far fa-calendar"></i> From/To</h5>
        <h6 class="card-subtitle text-muted" id="mytimeline">Aprill 11, 2018 to December 12, 2019</h6>
      </div>
    <!-- </div> -->
  <!-- </div> -->
  <div class="col-sm-3">
    <!-- <div class="card"> -->
      <!-- <div class="card-body" style="min-height: 110px;"> -->
        <h5 class="card-title"><i class="far fa-times-circle"></i> Items Not Found</h5>
        <form action="viewallnoentryitems" method="get">
            <input type="hidden" name="myschool_id" id="inp_sc_id" value="">
            <button type="submit" class="btn btn-warning btn-sm" id="notextsum">View 0</button>
        </form>
      </div>
    <!-- </div> -->
  <!-- </div> -->
  <div class="col-sm-4">
    <label class="mt-3">Filter: </label>
    <select class="form-control form-control-sm" id="scnamesselection" onchange="LoadAssets($('#scnamesselection').val())">
    </select>
  </div>
</div>
<div class="alert alert-primary mt-3" role="alert" id="lodass">
  Loading scannned assets.
</div>
<div class="row mt-3">
  <div class="col-md-12">
    
<table class="table table-sm" id="tbl_sc">
  <thead>
    <tr>
      <th scope="col">School ID</th>
      <th scope="col">Service Center</th>
      <th scope="col">Asset Item</th>
      <th scope="col">Property Number</th>
      <th scope="col">Scanned Date/Time</th>
    </tr>
  </thead>
  <tbody id="scannedassets">
  </tbody>
</table>

  </div>
</div>
<script type="text/javascript">
  $("#tbl_sc").DataTable();
  var ss = <?php echo json_encode(session("user_school")); ?>;
  LoadAssets(ss);

  function LoadAssets(sc_id){
    $("#lodass").css("display","block");
    $("#inp_sc_id").val(sc_id);
    $.ajax({
    type: "POST",
    url: "get_scanned_assets",
    data: {_token:"<?php echo e(csrf_token()); ?>","station_number":sc_id},
    success: function(data){
       $("#tbl_sc").DataTable().destroy();
      $("#scannedassets").html(data);
      $("#lodass").css("display","none");
      $("#tbl_sc").DataTable();
    }
  })

 $.ajax({
    type: "POST",
    url: "get_sca_totalitems",
    data: {_token:"<?php echo e(csrf_token()); ?>","station_number":sc_id},
    success: function(data){
      $("#itms_total").html(data);
    }
  })

$.ajax({
    type: "POST",
    url: "get_no_ent_sca",
    data: {_token:"<?php echo e(csrf_token()); ?>","station_number":sc_id},
    success: function(data){
      $("#notextsum").html("View " + data + " items");
    }
  })
        $.ajax({
    type: "POST",
    url: "get_sca_occupied_dates",
    data: {_token:"<?php echo e(csrf_token()); ?>","station_number":sc_id},
    success: function(data){
      $("#mytimeline").html(data);
    }
  })

  }
  var utype = <?php echo json_encode(session("user_type")); ?>;
  $.ajax({
    type: "POST",
    url: "getallscnames",
    data : {_token: "<?php echo e(csrf_token()); ?>"},
    success: function(data){
      if(utype == "0" || utype == "1"){
 $("#scnamesselection").html("<option value='all'>Show All</option>");
      }
      
      
      $("#scnamesselection").append(data);
   $("#scnamesselection").val(<?php echo json_encode(session("user_school")); ?>);
    }
  })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>