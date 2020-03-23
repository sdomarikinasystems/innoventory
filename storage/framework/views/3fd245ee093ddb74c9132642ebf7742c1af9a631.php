<?php $__env->startSection('title'); ?>
PMS Inventory
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">My Innoventory</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navitem" aria-controls="navitem" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navitem">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#modal_addassloc"><i class="fas fa-arrow-right"></i> New Asset Location</a>
      </li>
    </ul>
  </div>
</nav>

<div class="row mt-3">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Asset Location</h5>
        <h6 class="card-subtitle text-muted mb-3">This will the the masterlist that will use by the system to validate the location of your assets.</h6>
        <table class="table-sm table">
          <thead>
            <tr>
              <th>Station ID</th>
               <th>Office</th>
                 <th>Room Number</th>
                   <th>Action</th>
            </tr>
          </thead>
          <tbody id="tbl_assloc">
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Station Preferences</h5>
        <h6 class="card-subtitle text-muted mb-3">Your systems indicators</h6>
        <table class="table-sm table mt-3">
          <thead>
            <tr>
              <th>Preference</th>
               <th>Set Value</th>
            </tr>
          </thead>
          <tbody id="lodstapref">
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<form action="addsloccnow" method="POST">
  <div class="modal" tabindex="-1" id="modal_addassloc" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">New Asset Location</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php echo e(csrf_field()); ?>

          <div class="row">
            <div class="col-sm-12">
             <div class="form-group">
                <label>Select Station</label>
              <select name="xstation" id="station_school" class="form-control">
                <option>All</option>
              </select>
             </div>
            </div>
            <div class="col-sm-12">
             <div class="form-group">
                <label>Office</label>
                <input type="text" required="" class="form-control" placeholder="Office name" name="xoffice">
             </div>
            </div>
             <div class="col-sm-12">
             <div class="form-group">
                <label>Room Number</label>
            <input type="text" required="" placeholder="#" class="form-control" name="xroomnum">
             </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Add Location</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</form>

  <form action="remloc" method="POST">
    <div class="modal" tabindex="-1" id="myremovelocmodal" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Remove Location</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php echo e(csrf_field()); ?>

            <p>Are you sure you want to remove this location from your station?</p>
            <input type="hidden" id="toremoveid" name="loc_id">
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-danger">Remove</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </form>



<script type="text/javascript">
  LoadAssetLocations();
  LoadStationPreferences();
  function showremovelocmodal(control_obj){
    $("#toremoveid").val($(control_obj).data("cont_id"));
  }
function LoadAssetLocations(){
    $.ajax({
      type: "POST",
      url: "loadallassetlocationsencoded",
      data: {_token:"<?php echo e(csrf_token()); ?>"},
      success: function(data){
        $("#tbl_assloc").html(data);
      }
    })
}
function LoadStationPreferences(){
$.ajax({
      type: "POST",
      url: "loadstationpreferences",
      data: {_token:"<?php echo e(csrf_token()); ?>"},
      success: function(data){
        // console.log(data);
        $("#lodstapref").html(data);
      }
    })
}
 var utype = <?php echo json_encode(session("user_type")); ?>;
  $.ajax({
    type: "POST",
    url: "getallscnames",
    data : {_token: "<?php echo e(csrf_token()); ?>"},
    success: function(data){
  
      $("#station_school").html(data);
    }
  })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>