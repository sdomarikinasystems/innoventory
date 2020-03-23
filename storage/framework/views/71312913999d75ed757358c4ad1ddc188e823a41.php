<?php $__env->startSection('title'); ?>
PMS Inventory
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>

<h2>Dashboard</h2>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Home</li>
	</ol>
</nav>
 
<div class="row">
	<div class="col-sm">
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
    <div class="col-sm">
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
    <div class="col-sm">
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
	<div class="col-sm">
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
<div>&nbsp;</div>

<!--REMINDERS-->
<div class="row">
	<div class="col-sm">
		<div class="card">
			<div class="card-header">
				<h5><i class="fas fa-bullhorn"></i> Announcements</h>
			</div>
			<div class="card-body table-responsive" style="padding:0">

				 <ul class="nav nav-tabs mb-3 mt-1" id="pills-tab" role="tablist">
				  <li class="nav-item">
				    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">New</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">All Announcements</a>
				  </li>
				</ul>
				<div class="tab-content" id="pills-tabContent">
				  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
				  		<table class="table">
				  <thead>
					<tr>
					  <th scope="col" width="150">Date</th>
					  <th scope="col">Title</th>
					  <th scope="col" width="150">Deadline</th>
					</tr>
				  </thead>
				  <tbody id="newann">
					<tr>
					  <th scope="row">1</th>
					  <td>Mark</td>
					  <td>Otto</td>
					</tr>
					<tr>
					  <th scope="row">2</th>
					  <td>Jacob</td>
					  <td>Thornton</td>
					</tr>
					<tr>
					  <th scope="row">3</th>
					  <td>Larry</td>
					  <td>the Bird</td>
					</tr>
				  </tbody>
				</table>	
				  </div>
				  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
				  		<table class="table">
				  <thead>
					<tr>
					  <th scope="col" width="150">Date</th>
					  <th scope="col">Title</th>
					  <th scope="col" width="150">Deadline</th>
					</tr>
				  </thead>
				  <tbody id="oladann">
					<tr>
					  <th scope="row">1</th>
					  <td>Mark</td>
					  <td>Otto</td>
					</tr>
					<tr>
					  <th scope="row">2</th>
					  <td>Jacob</td>
					  <td>Thornton</td>
					</tr>
					<tr>
					  <th scope="row">3</th>
					  <td>Larry</td>
					  <td>the Bird</td>
					</tr>
				  </tbody>
				</table>	
				  </div>
				</div>


						
			</div>
			<div class="card-footer">
				<a href="<?php echo e(route('manage_reminders')); ?>" class="float-right"><i class="fas fa-hand-point-right"></i> View All</a>
			</div>
		</div>
	</div>

	<div class="col-sm">

	</div>	
</div>


<script type="text/javascript">
  
LoadNewAnnouncements();
LoadAllAnnounce();
  function LoadNewAnnouncements(){
  	$.ajax({
  		type: "POST",
  		url: "<?php echo e(route('getmynewannouncements')); ?>",
  		data: {_token: "<?php echo e(csrf_token()); ?>",typeofget:"0"},
  		success:function(data){
  			// alert(data);
  			$("#newann").html(data);
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
      var d_data  = data.split(",");
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