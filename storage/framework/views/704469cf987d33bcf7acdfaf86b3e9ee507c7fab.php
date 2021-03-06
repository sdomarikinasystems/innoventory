<?php $__env->startSection('title'); ?>
PMS Inventory
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>

<h2>Service Centers</h2>

<input type="hidden" value="<?php echo e(session('user_school')); ?>" id="myschool_realid" name="">
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Home</li>
		<li class="breadcrumb-item active" aria-current="page">Manage Service Centers</li>
	</ol>
</nav>

<div class="row">
	<div class="col-sm" style="padding-left:0">
		<ul class="nav">
		<?php
			if(session("user_type") < "4" && session("user_type") != "2"){
		?>
		<!-- FOR SUPPLY OFFICER AND PROPERTY CUSTODIAN ONLY -->
			<li class="nav-item active">
				<a class="nav-link" href="#" data-toggle="modal" data-target="#modal_addassloc"><i class="fas fa-plus-square"></i> Add Service Center</a>
			</li>
			<?php } ?>

			<?php
				if(session("user_type") == "0" || session("user_type") == "1"){
			?>

			<?php
			}

			?>
		</ul>
	</div>
	<div class="col-sm">
	</div>	
</div>
<div class="row mt-3">
	<div class="col-md-12">
		<table class="table-sm table">
		  <thead>
			<tr>
				<th>Service Center</th>
				<th>Room Number</th>
				<th>In-Charge</th>
        <th>Action</th>
				<!--<th>Action</th> ADD THIS-->
			</tr>
		  </thead>
		  <tbody id="tbl_assloc">
			
		  </tbody>
		</table>
	</div>
</div>

<form action="<?php echo e(route('addnewassloc')); ?>" method="POST">
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
            <div class="col-sm-12" style="display: none;">
             <div class="form-group" >
                <label>Select Station</label>
            <!--   <select name="xstation" id="station_school" class="form-control">
                <option>All</option>
              </select>--> 
              <input type="text" value="<?php echo e(session('user_school')); ?>" name="xstation">
             </div>
            </div>
            <div class="col-sm-12">
             <div class="form-group">
                <label>Service Center</label>
                <input type="text" required="" class="form-control" placeholder="Office name" name="xoffice">
             </div>
            </div>
             <div class="col-sm-12">
             <div class="form-group">
                <label>Room Number</label>
            <input type="text" required="" placeholder="#" class="form-control" name="xroomnum">
             </div>
            </div>
            <div class="col-sm-12">
               <div class="form-group">
                <label>Center Manager</label>
               <select name="incharge" class="form-control" required="" id="mycentermanagerselection">
                 
               </select>
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
<script type="text/javascript">
  getcentermanagerselection();
  function getcentermanagerselection(){
    $.ajax({
      type: "POST",
      url: "<?php echo e(route('getcentermanselection')); ?>",
      data: {_token: "<?php echo e(csrf_token()); ?>"},
      success: function(data){
        $("#mycentermanagerselection").html(data);
      }

    })
  }
</script>
  <form action="<?php echo e(route('removelocation')); ?>" method="POST">
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

  function apply_inchange_change(control_obj){
    alert($(control_obj).data("eid"));
    alert($(control_obj).val());
  }
  function showremovelocmodal(control_obj){
    $("#toremoveid").val($(control_obj).data("cont_id"));
  }
function LoadAssetLocations(){
    $.ajax({
      type: "POST",
      url: "<?php echo e(route('lodasslocenc')); ?>",
      data: {_token:"<?php echo e(csrf_token()); ?>"},
      success: function(data){
        $("#tbl_assloc").html(data);
      }
    })
}
function LoadStationPreferences(){
$.ajax({
      type: "POST",
      url: "<?php echo e(route('lodstaprefx')); ?>",
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
    url: "<?php echo e(route('load_all_school_names')); ?>",
    data : {_token: "<?php echo e(csrf_token()); ?>"},
    success: function(data){
  
      $("#station_school").html(data);
    }
  })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>