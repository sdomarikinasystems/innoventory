

<?php $__env->startSection('title'); ?>
ProcMS - Innoventory
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>

<h2>Dashboard</h2>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Home</li>
	</ol>
</nav>
 
<div class="row" id="statbar" style="display: none;">
	<div class="col-sm-3">
		<div class="card">
			<div class="card-body">
				<div class="card-title float-left"><h5>Asset Registry</h5></div>
				<h3 class="float-right" id="count_ass_reg"></h3>
			</div>
			<div class="card-footer">
				<div class="float-left"><a href="/innoventory/asset/registry">Manage</a></div>
				<div class="float-right"><a href="/innoventory/asset/registry"><i class="fas fa-arrow-circle-right"></i></a></div>
			</div>
		</div>
    </div>
    <div class="col-sm-3">
		<div class="card">
			<div class="card-body">
				<div class="card-title float-left"><h5>Inventory Items</h5></div>
				<h3 class="float-right" id="count_sc_assets"></h3>
			</div>
			<div class="card-footer">
				<div class="float-left"><a href="/innoventory/asset/inventory">View Inventory</a></div>
				<div class="float-right"><a href="/innoventory/asset/inventory"><i class="fas fa-arrow-circle-right"></i></a></div>
			</div>
		</div>		
    </div>
    <div class="col-sm-3">
		<div class="card">
			<div class="card-body">
				<div class="card-title float-left"><h5>Disposed Items</h5></div>
				<h3 class="float-right" id="count_ass_disposed">0</h3>
			</div>
			<div class="card-footer">
				<a href="/innoventory/asset/disposal" class="float-right"><i class="fas fa-hand-point-right"></i> View</a>
			</div>
		</div>
    </div>
	<div class="col-sm-3">
		<div class="card">
			<div class="card-body">
				<div class="card-title float-left"><h5>Service Centers</h5></div>
				<h3 class="float-right" id="count_ass_disposed">0</h3>
			</div>
			<div class="card-footer">
				<a href="/innoventory/manage/service_centers" class="float-right"><i class="fas fa-hand-point-right"></i> View</a>
			</div>
		</div>
    </div>
	
</div>
<div id="lod_bar">
	<center><img src="<?php echo e(asset('images/loading.gif')); ?>" style="width: 80px;">
		<h5>Loading Summary...</h5>
	</center>
</div>
<div>&nbsp;</div>

<!--REMINDERS-->
<div class="row">
	<div class="col-sm-7">
		<div class="card">
			<div class="card-header">
				<h5><i class="fas fa-bullhorn"></i> Announcements</h>
			</div>
			<div class="card-body table-responsive" style="padding:0; background-color: #E9ECEF !important;" >

				
<div id="newann" style="background-color: #E9ECEF !important; margin: 20px;">
	
</div>
						
			</div>
			<div class="card-footer">
				<a href="<?php echo e(route('manage_reminders')); ?>" class="float-right"><i class="fas fa-hand-point-right"></i> View All</a>
			</div>
		</div>
	</div>

	<div class="col-sm-5">
		<div class="jumbotron" id="inv_status">
		<!-- 	<center> -->
				
		<!-- 	</center> -->
		</div>
			<?php
			if(session("user_type") == "0" || session("user_type") == "1"){
			?>
			<div class="card mt-3">
				<div class="card-body">
					<h5>Stations Inventory Status</h5>
					<table class="table table-hover table-striped">
						<thead>
							<tr>
								<th>Station</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody id="allstaconts">
							
						</tbody>
					</table>
				</div>
			</div>

			<script type="text/javascript">
				
					DisplayAllStationsInventoryStatus();
function DisplayAllStationsInventoryStatus(){
	$.ajax({
  		type: "POST",
  		url: "<?php echo e(route('seestationsinvstatus')); ?>",
  		data: {_token: "<?php echo e(csrf_token()); ?>"},
  		success:function(data){
  			$("#allstaconts").html(data);
  		}
  	})
}


			</script>
			<?php
			}

			?>
	</div>	
</div>


<script type="text/javascript">


	CheckIfReadyForInventory();
function CheckIfReadyForInventory(){
	$.ajax({
  		type: "POST",
  		url: "<?php echo e(route('checinvread')); ?>",
  		data: {_token: "<?php echo e(csrf_token()); ?>"},
  		success:function(data){
  			$("#inv_status").html(data);
  		}
  	})
}
LoadNewAnnouncements();
// LoadAllAnnounce();
$("#statbar").css("display","none");
  	$("#lod_bar").css("display","block");
setInterval(function(){

LoadDashboardInfo();
},3000)
  function LoadNewAnnouncements(){
  	$.ajax({
  		type: "POST",
  		url: "<?php echo e(route('getmynewannouncements')); ?>",
  		data: {_token: "<?php echo e(csrf_token()); ?>",typeofget:"0"},
  		success:function(data){
  			// alert(data);
  			$("#newann").html(urlify(data));
  		}
  	})
  }
  function LoadAllAnnounce(){
  		$.ajax({
  		type: "POST",
  		url: "<?php echo e(route('getmynewannouncements')); ?>",
  		data: {_token: "<?php echo e(csrf_token()); ?>",typeofget:"1"},
  		success:function(data){
  			// alert(data);
  			$("#oladann").html(data);
  		}
  	})
  }
  function LoadDashboardInfo(){
  	
  	
  	  $.ajax({
    type : "POST",
    url: "<?php echo e(route('count_all_created_asset_loc')); ?>",
    data: {_token:"<?php echo e(csrf_token()); ?>"},
    success: function(data){
	$("#lod_bar").css("display","none");
	$("#statbar").css("display","flex");
      var d_data  = data.split(",");
      // alert("Done Loading!");
      $("#count_assloc_created").html(d_data[0]);
      $("#count_ass_reg").html(d_data[1]);
      $("#count_sc_assets").html(d_data[2]);
      $("#count_ass_disposed").html(d_data[3]);
       $("#count_trans").html(d_data[4]);
       $("#count_accounts").html(d_data[5]);
    }
  })
  }


</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>