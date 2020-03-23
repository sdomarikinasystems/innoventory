

<?php $__env->startSection('title'); ?>
ProcMS - Innoventory
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>

<h2>Asset Registry</h2>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page"><a href="/innoventory/dashboard">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Asset Registry</li>
	</ol>
</nav>

<input type="hidden" value="<?php echo e(session('user_school')); ?>" id="myschool_realid" name="">

<div class="row">
	<div class="col-sm mb-3">
		<?php
			if(session("user_type") < "4" && session("user_type") != "2"){
		?>
		<!-- FOR SUPPLY OFFICER AND PROPERTY CUSTODIAN ONLY -->
		<a class="btn btn-success" href="#" data-toggle="modal" data-target="#uploadnewcsv"><i class="fas fa-file-import"></i> Import Asset Package</a>
		<?php } ?>

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
					<div class=' mt-2'>
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
	<div class="col-sm">
		<table class="table table-sm table-bordered">
			<thead>
				<tr>
					<th>Total Assets</th>
					<th><span>Discrepancies</span></th>
            <th>Omitted</th>
					<th>Last Updated</th>
        
				</tr>
			</thead>
			<tbody id="assvalsum">
				<tr>
					<td>0</td>
					<td>0</td>
					<td>0</td>
          <td>0</td>
				</tr>
			</tbody>
		</table>
	</div>	
</div>

<script type="text/javascript">
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
   
    $("#myschool_realid").val($(control_obj).data("sourceid"));

     if($(control_obj).data("sourceid") != <?php echo session("user_school"); ?>){
            $("#sourcename").html($(control_obj).data("sourcename"));
          }else{
              $("#sourcename").html($(control_obj).data("sourcename"));
          }


		$("#lod_change_ass_source").css("display","block");
		LoadAssets();
		setTimeout(function(){
		$("#lod_change_ass_source").css("display","none");
		},1000)
	  }
	  function gotomyownassets(){

		var myassets = <?php echo json_encode(session("user_school")); ?>;
		$("#myschool_realid").val(myassets);
		 $("#lod_change_ass_source").css("display","block");
		LoadAssets();

		setTimeout(function(){
		$("#lod_change_ass_source").css("display","none");
		 $("#sourcename").html(<?php echo json_encode(session("user_schoolname")); ?>);
		},1000)

	  }
</script>

<div id="lod_change_ass_source" style="display:none; top: 0; right: 0; left: 0; bottom: 0; position: fixed; background-color: rgba(0,0,0,0.9); z-index: 100; color:white;">
 <center><br><br><br><h4 class="mt-5">Changing Asset Source</h4></center>
</div>


<!--ASSET REGISTRY-->
<div>

 <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active"  data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-database"></i> <span id="sourcename"><?php echo e(session('user_schoolname')); ?></span></a>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
    
      <table class="table table-hover table-bordered" id="tbl_ass">
    <thead>
      <tr>
        <th scope="col" width="150">Property Number</th>
        <th scope="col">Asset Item</th>
        <th scope="col">Specification</th>
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
<!--END-->

<form action="<?php echo e(route('archive_an_asset')); ?>" method="POST">
  <?php echo e(csrf_field()); ?>

  <div class="modal" tabindex="-1" id="m_remove" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Item Disposal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="the_asset_to_dispose_id" name="asset_id">
          <div class="form-group">
            <label>Disposal Type</label>
            <select class="form-control" name ="asset_archive_type">
              <option value="1">Condemnation / Destruction</option>
              <option value="2">Transfer of Property</option>
              <option value="3">Donation of Property</option>
              <option value="4">Sale of Unserviceable Property</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Dispose</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</form>

<form action="../../uploadassetregistrycsv" method="POST"  enctype="multipart/form-data">
 
  <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
  <div class="modal" tabindex="-1" id="uploadnewcsv" role="dialog">
    <div>
      
    </div>
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div id="lod_uploadass" style=" position: fixed; display: block; z-index: 100; top: 0; bottom: 0; left: 0; right: 0; height: 100%; width:  100%; background-color: white; display:none;">
    <center>
<img class="mt-5" src="https://icon-library.net/images/ajax-loading-icon/ajax-loading-icon-2.jpg" style="width: 40px; padding-top: 100px;">
     <div class="container">
        <h5 class="mt-3 card-title">Validating Records</h5>
      <h6 class="card-subtitle text-muted">Please standby for a moment, this may take some time depending on your asset count.</h6></center>
     </div>

        <div class="modal-header">
          <h5 class="modal-title">Upload Asset Registry</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <div class="row">
           <div class="col-md-6">
          <div class="card" style="min-height: 145px;">
            <div class="card-body" >
               <div class="form-group" style="display: none;">
            <label>Station</label><br>
            <p id="theval"></p>
            <select class="form-control" required="" id="st_all" name="sc_id">
             
           </select>
          </div>
          <div class="form-group">
            <label>Upload Asset Registry CSV File</label><br>
             <input type="file" id="file" required="" accept=".csv"  name="thecsvfile" onchange="return fileValidation()">
          </div>
            </div>
          </div>
           </div>
           <div class="col-md-6">
                <div class="alert alert-success" role="alert">
            <h6 class="card-title"><i class="fas fa-tasks"></i> Requirements</h6>
            <ol>
              <li>File format needs to be <span class="badge badge-success">.CSV</span></li>
              <li>File size must be below <span class="badge badge-success">5 MB</span></li>
              <li>CSV has <span class="badge badge-success">22 columns</span></li>
            </ol>
          </div>
           </div>
         </div>
       
          <div class=" mt-2">
           <div class="card">
             <div class="card-body">
                <label>Preview <i class="text-muted">Limited by 3 rows</i></label>
            <table class="table table-sm table-responsive" style="font-size: 12px;">
              <tbody id="thetable">
                <tr><td><center>Please upload a valid Asset Registry CSV file for the preview.</center></td></tr>
              </tbody>
            </table>
             </div>
           </div>
          </div>
  
        </div>
        <div class="modal-footer">
          <button type="submit" id="sub_butt" onclick="$('#lod_uploadass').css('display','block');" class="btn btn-primary">Import</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    $("#tbl_ass").DataTable();
    var isokcsv = false;
    setInterval(function(){
      if($("#file").val() == "" || isokcsv == false){
        $("#sub_butt").css("display","none");
      }else{
        $("#sub_butt").css("display","block");
      }
    },300)
  $.ajax({
    type: "POST",
    url: "<?php echo e(route('load_all_school_names')); ?>",
    data : {_token: "<?php echo e(csrf_token()); ?>"},
    success: function(data){
      $("#st_all").append(data);
      $("#st_all").val(<?php echo json_encode(session("user_school")); ?>);
    }
  })
  function OpenAssetToDispose(control_obj){
    $("#the_asset_to_dispose_id").val($(control_obj).data("asset_id"));
  }
    LoadAssets();
    function LoadAssets(){
      var school_real_id = $("#myschool_realid").val();
      $.ajax({
        type : "POST",
        url : "<?php echo e(route('display_all_encoded_assets')); ?>",
        data : {_token:"<?php echo e(csrf_token()); ?>",selected_realid: school_real_id},
         success : function(data){
          // alert(data);
            $("#tbl_ass").DataTable().destroy();
            $("#allmyassests").html(data);
          
            $("#tbl_ass").DataTable();
             LoadAssetRegistrySummary(school_real_id);
         }
      })
    }


      function LoadAssetRegistrySummary(sc_id){
 $.ajax({
    type: "POST",
    url: "<?php echo e(route('loadassetvalsum')); ?>",
    data: {_token:"<?php echo e(csrf_token()); ?>",selected_realid:sc_id},
    success: function(data){
      $("#assvalsum").html(data);
    }
  })

  }
    function fileValidation(){
      var fileInput = document.getElementById('file');
      var filePath = fileInput.value;
      var allowedExtensions = /(\.csv)$/i;
      var fd = new FormData();
      var files = $('#file')[0].files[0];
      fd.append('thecsvfile',files);
      fd.append('_token',"<?php echo e(csrf_token()); ?>");

      if(!allowedExtensions.exec(filePath)){
      alert("Only .csv file is allowed.");
      fileInput.value = '';
      $("#thetable").html("<tr><td><center>Please upload a valid Asset Registry CSV file for the preview.</center></td></tr>");
      return false;
      }else{
      // alert(filevalue);
      // Display CSV Preview
      $.ajax({
      type : "POST",
      url : "<?php echo e(route('preview_csv')); ?>",
      contentType: false,
      processData: false,
      enctype: 'multipart/form-data',
      data:fd,
      success: function(data){
        if(data == ""){
          isokcsv = false;
           $("#thetable").html("<tr><td><center>The CSV file does not met the specifications to be recognized as Asset Registry CSV file.</center></td></tr>");
        }else{
          isokcsv = true;
           $("#thetable").html(data);
        }
     
      }
      })
      }
  }
  </script>
</form>

<form action="addnewregistryreocrd" method="POST">
<input type="hidden" value="<?php echo e(csrf_token()); ?>" name="_token">
  <div class="modal" tabindex="-1" role="dialog" id="modal_newaccount">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Encode New Asset</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
          <label>Office Type</label>
          <input type="text" class="form-control form-control-sm" name="office_type">
        </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
          <label>Regional/ Division</label>
          <input type="text" class="form-control form-control-sm" name="office_name">
        </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
          <label>Asset Classification</label>
          <input type="text" class="form-control form-control-sm" name="asset_classification">
        </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
          <label>Asset Sub Class</label>
          <input type="text" class="form-control form-control-sm" name="asset_sub_class">
        </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
          <label>UACS Object Code</label>
          <input type="text" class="form-control form-control-sm" name="uacs_object_code">
        </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
          <label>Manufacturer</label>
          <input type="text" class="form-control form-control-sm" name="manufacturer">
        </div>
      </div>
          <div class="col-md-3">
            <div class="form-group">
          <label>Asset Item</label>
          <input type="text" class="form-control form-control-sm" name="asset_item">
        </div>
          </div>
           <div class="col-md-3">
            <div class="form-group">
          <label>Model</label>
          <input type="text" class="form-control form-control-sm" name="model">
        </div>
          </div>
           <div class="col-md-3">
            <div class="form-group">
          <label>Serial Number</label>
          <input type="text" class="form-control form-control-sm" name="serial_number">
        </div>
          </div>
           <div class="col-md-8">
            <div class="form-group">
          <label>Specification</label>
          <input type="text" class="form-control form-control-sm" name="specification">
        </div>
          </div>
           <div class="col-md-6">
            <div class="form-group">
          <label>Property Number</label>
          <input type="text" class="form-control form-control-sm" name="property_number">
        </div>
          </div>
           <div class="col-md-6">
            <div class="form-group">
          <label>Current Condition</label>
          <input type="text" class="form-control form-control-sm" name="current_condition">
        </div>
          </div>
           <div class="col-md-3">
            <div class="form-group">
          <label>Source of Fund</label>
          <input type="text" class="form-control form-control-sm" name="source_of_fund">
        </div>
          </div>
           <div class="col-md-3">
            <div class="form-group">
          <label>Cost of Acquisition</label>
          <input type="text" class="form-control form-control-sm" name="cost_of_acquisition">
        </div>
      </div>
         <div class="col-md-3">
            <div class="form-group">
          <label>Date of Acquisition</label>
          <input type="text" class="form-control form-control-sm" name="date_of_acquisition">
        </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
          <label>Estimated Lifespan</label>
          <input type="text" class="form-control form-control-sm" name="estimated_total_life_years">
        </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
          <label>Name of Accountable Officers</label>
          <input type="text" class="form-control form-control-sm" name="name_of_accountable_officer">
        </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
          <label>Asset Location</label>
          <input type="text" class="form-control form-control-sm" name="asset_location">
        </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
          <label>Remarks</label>
          <textarea type="text" class="form-control form-control-sm" name="remarks"></textarea>
        </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
          <label>Unit of Mesure</label>
          <input type="text" class="form-control form-control-sm" name="unit_of_measure">
        </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
          <label>Service Center</label>
          <input type="text" class="form-control form-control-sm" name="service_center">
        </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
          <label>Room Number</label>
          <input type="text" class="form-control form-control-sm" name="room_number">
        </div>
          </div>
        </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>