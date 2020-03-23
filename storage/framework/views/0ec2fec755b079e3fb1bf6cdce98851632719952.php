

<?php $__env->startSection('title'); ?>
ProcMS - Innoventory
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<h2>Disposed Assets</h2>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Home</li>
		<li class="breadcrumb-item active" aria-current="page">Disposed Assets</li>
	</ol>
</nav>

<div class="row mt-3">
  <div class="col-sm-7">
      <?php
      if(session("user_type") == "0" || session("user_type") == "1"){
    ?>
  <!-- FOR ADMIN ONLY -->
    <a class="btn btn-secondary dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
    <i class="fas fa-filter"></i> Filter Asset Source</a>
  
    <div class="dropdown-menu" style="width:450px; min-height: 300px;">
      <div class="container">
        <div class="form-group">
          <input type="text" class="form-control mt-3" id="searchss" placeholder="Search Station here..." name="">
        </div>
        <div class="form-group">
          <div class='mt-2'>
            <a onclick='gotomyownassets()' href='#' title='Switch to my own assets'>
            <span class="float-right text-muted"><i class="fas fa-home"></i></span>
            <small class='text-muted card-subtitle'>Switch to</small><br>
            <strong class='card-title' ><?php echo session("user_schoolname"); ?></strong>
            </a>
            <hr>
            <center id="search_narrative"><h5 class="text-muted mt-5"><i class="fas fa-search"></i> Search result will appear here...</h5></center>
          </div>
          <div id="school_search_cont" style=" overflow-y: auto; overflow-x: hidden; max-height: 300px;">
          <!-- result -->
          </div>
        </div>
      </div>
    </div>
  <?php
  }
  ?>

  </div>
  <div class="col-sm-5">
     <h5>Legends</h5>
        <small>
          <table class="table table-sm table-bordered table-striped">
          <tr>
            <td><i style="color: #c0392b;" class="fas fa-circle"></i></td><td>Condemnation / Destruction</td>
            <td><i style="color: #27ae60;" class="fas fa-circle"></i></td><td>Transfer of Property</td>
          </tr>
           <tr>
            <td><i style="color: #2980b9;" class="fas fa-circle"></i></td><td>Donation of Property</td>
             <td><i style="color: #8e44ad;" class="fas fa-circle"></i></td><td>Sale of Unserviceable Property</td>
          </tr>
        </table>
        </small>
  </div>
</div>
<div>
   <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-database"></i> <span id="sourcename"></span></a>
    </li>
  </ul>
  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
      <table class="table table-hover table-bordered" id="tbl_dis">
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
  <tbody id="allmyassests">
  </tbody>
</table>
    </div>
  </div>
</div>


<form action="" method="">
  <div class="modal" tabindex="-1" id="m_view" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">ITEM INFORMATION</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Modal body text goes here.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</form>

<form action="../../restore_asset" method="POST">
  <?php echo e(csrf_field()); ?>

  <div class="modal" tabindex="-1" id="m_remove" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">ITEM RESTORATION</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="the_asset_to_dispose_id" name="asset_id">
          <p>Restore this item from the Assets Registry?</p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Restore</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</form>

  <script type="text/javascript">
 $("#sourcename").html("<?php echo e(session('user_schoolname')); ?>");
  function OpenAssetToDispose(control_obj){
    $("#the_asset_to_dispose_id").val($(control_obj).data("asset_id"));
  }

  LoadAssets("<?php echo e(session('user_school')); ?>");
  function LoadAssets(station_id){
    $.ajax({
      type : "POST",
      url : "<?php echo e(route('asset_disp_disposed')); ?>",
      data : {_token:"<?php echo e(csrf_token()); ?>",id_of_something:station_id},
       success : function(data){
          $("#allmyassests").html(data);
          $("#tbl_dis").DataTable();
       }
    })
  }
   $("#searchss").change(function(){
    var skey = $("#searchss").val();
   $.ajax({
    type: "POST",
    url: "<?php echo e(route('search_asstov')); ?>",
    data: {_token: "<?php echo e(csrf_token()); ?>",searchkey:skey},
    success: function(data){
      if(data == ""){
        $("#search_narrative").html("No result found.");
        $("#school_search_cont").css("display","none");
          $("#search_narrative").css("display","block");
      }else{
         $("#school_search_cont").css("display","block");
          $("#search_narrative").css("display","none");

             $("#school_search_cont").html(data);
      
         
      }
      $("#searchss").val("");
    }
   })
  })

     function changesource(control_obj){
        var sourceid = $(control_obj).data("sourceid");
        var sourcename = $(control_obj).data("sourcename");
        // alert(sourceid);
        $("#sourcename").html(sourcename);
        LoadAssets(sourceid);
     }
     function gotomyownassets(){
      $("#sourcename").html("<?php echo e(session('user_schoolname')); ?>");
       LoadAssets("<?php echo e(session('user_school')); ?>");
     }
  </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>