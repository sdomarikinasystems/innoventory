<?php $__env->startSection('title'); ?>
PMS Inventory
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>

<h2>Inventory</h2>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Home</li>
		<li class="breadcrumb-item active" aria-current="page">Inventory</li>
	</ol>
</nav>

<div class="row">
	<div class="col-sm mb-3">
		
		<?php
			if(session("user_type") < "4" && session("user_type") != "2"){
        ?>
        <!-- FOR SUPPLY OFFICER AND PROPERTY CUSTODIAN ONLY -->
		<a class="btn btn-success" href="#" data-toggle="modal" data-target="#m_generatereport" onclick="getcountofgen()"><i class="fas fa-file-pdf"></i> Generate Report</a>
		<?php } ?>

        <?php
			if(session("user_type") == "0" || session("user_type") == "1"){
		?>
		<!-- FOR ADMIN ONLY -->
		<a class="btn btn-secondary dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
		<i class="fas fa-filter"></i> Filter Inventory Source</a>
		<div class="dropdown-menu" style="width:450px; min-height: 300px;">
			<div class="container">
				<div class="form-group">
					<input type="text" class="form-control mt-3" id="searchss" placeholder="Search Station here..." name="">
				</div>
				<div class="form-group">
					<div class=' mt-2'>
						<a href='#' onclick="gotodefaultsource()" title='Switch to my own assets'>
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
	<script type="text/javascript">
	$("#searchss").change(function(){
	var skey = $("#searchss").val();
	$.ajax({
	type: "POST",
	url: "../../search_station_toview",
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
	</script>
	<div class="col-sm">
		<table class="table table-sm table-bordered">
			<thead>
				<tr>
					<th>Total Scanned</th>
					<th>From/To</th>
					<th>Items Not Found</th>
				</tr>
			</thead>
			<tbody id="assvalsum">
				<tr>
					<td id="itms_total">0</td>
					<td id="mytimeline">0</td>
					<td>
						<form action="../../viewallnoentryitems" method="get">
						<input type="hidden" name="myschool_id" id="inp_sc_id" value="">
						<button type="submit" class="btn btn-warning btn-sm" id="notextsum">View 0</button>
						</form>
					</td>
				</tr>
			</tbody>
		</table>	
	</div>
</div>

<div class="row mt-3">
  <div class="col-md-12">
    
<table class="table table-bordered" id="tbl_sc">

   <thead>
    <tr>
      <th scope="col" width="150">Property Number</th>
      <th scope="col">Asset Item</th>
      <th scope="col">Asset Classification</th>
      <th scope="col">Current Condition</th>
      <th scope="col">Service Center</th>
      <th scope="col">Room</th>
      <th scope="col">Inventory Date</th>
      <th scope="col">Action</th>
    </tr>
  </thead>


  <tbody id="scannedassets">
  </tbody>
</table>

  </div>
</div>

<form action="../../asset_grouptool" method="GET">
  <div id="m_generatereport" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Report Generation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php echo e(csrf_field()); ?>

          <div class="form-group">
            <label>Room</label>
            <select class="form-control" id="allroms" onchange="getcountofgen()" name="my_room">
              <option>Sample</option>
            </select>
          </div>
             <div class="form-group">
            <label>Category</label>
            <select class="form-control" id="allcats" onchange="getcountofgen()" name="my_category">
              <option>Sample</option>
            </select>
          </div>
        <div class="form-group">
         <label>Number of Assets to be Generated</label>
         <h5 id="asstobegennum">0 Item(s)</h5>
        </div>
        </div>
        <div class="modal-footer">
          <button type="submit" id="continueenrep_btn" class="btn btn-primary">Continue</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</form>
<script type="text/javascript">


  $.ajax({
    type: "POST",
    url: "../../get_grouped_rooms",
    data: {_token:"<?php echo e(csrf_token()); ?>"},
    success: function(data){
      $("#allroms").html(data);
    }
  })
  $.ajax({
    type: "POST",
    url: "../../get_grouped_categories",
    data: {_token:"<?php echo e(csrf_token()); ?>"},
    success: function(data){
      $("#allcats").html(data);
    }
  })
  function getcountofgen(){
    $("#continueenrep_btn").css("display","none");
    $("#asstobegennum").html("Getting reports, please wait...");
    var roomnum = $("#allroms").val();
    var category_class = $("#allcats").val();
    $.ajax( {
      type: "POST",
    url: "../../get_tobegenerated_report_count",
    data: {_token:"<?php echo e(csrf_token()); ?>",rn:roomnum,cc:category_class},
    success: function(data){
     
      if(data == "0"){
          $("#continueenrep_btn").css("display","none");
           $("#asstobegennum").html("The're no reports in the selected room and category.");
      }else{
          $("#continueenrep_btn").css("display","block");
           $("#asstobegennum").html(data + " item(s) are ready to be generated.");
      }
    }})
  }


  $("#tbl_sc").DataTable();
  var ss = <?php echo json_encode(session("user_school")); ?>;
  LoadAssets(ss);
  function gotodefaultsource(){
    LoadAssets(ss);
  }
  function changesource(control_obj){
    LoadAssets($(control_obj).data("sourceid"));
  }
  function LoadAssets(sc_id){
    $("#lodass").css("display","block");
    $("#inp_sc_id").val(sc_id);
    $.ajax({
    type: "POST",
    url: "<?php echo e(route('get_ass_scanned')); ?>",
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
    url: "../../get_sca_totalitems",
    data: {_token:"<?php echo e(csrf_token()); ?>","station_number":sc_id},
    success: function(data){
      $("#itms_total").html(data);
    }
  })

$.ajax({
    type: "POST",
    url: "../../get_no_ent_sca",
    data: {_token:"<?php echo e(csrf_token()); ?>","station_number":sc_id},
    success: function(data){
      $("#notextsum").html("View " + data + " items");
    }
  })
        $.ajax({
    type: "POST",
    url: "../../get_sca_occupied_dates",
    data: {_token:"<?php echo e(csrf_token()); ?>","station_number":sc_id},
    success: function(data){
      $("#mytimeline").html(data);
    }
  })

  }
  var utype = <?php echo json_encode(session("user_type")); ?>;
  $.ajax({
    type: "POST",
    url: "../../getallscnames",
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