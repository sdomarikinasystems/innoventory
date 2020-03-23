<?php $__env->startSection('title'); ?>
CDTRS Online Portal
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<div class="container-fluid mt-2">
<div class="row mb-3">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<h4 class="float-right" id="aal">...</h4>
				<img style="width: 30px;" src="<?php echo e(asset('images/check.png')); ?>">
				<h5 class="card-title">Approved Leave</h5>
				<h6 class="card-subtitle text-muted mb-3">Applied leave that is approved.</h6>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<h4 class="float-right" id="dss">...</h4>
				<img style="width: 30px;" src="<?php echo e(asset('images/times.png')); ?>">
				<h5 class="card-title">Disapproved Leave</h5>
				<h6 class="card-subtitle text-muted mb-3">Disapproved leave reports that is converted to Leave Without Pay.</h6>
			</div>
		</div>
	</div>
</div>
			<div class="row">
			<div class="col-lg-9">
				<!-- <div class="loading_indicator"></div> -->
				<div class="form-group">
					<h3 class="card-title">Employee Dashboard</h3>
					<div class="card" style="overflow: hidden;">

						<div class="card-body table-responsive">
							<h6 class="card-subtitle text-muted mb-2">Displaying logs from <strong id="dd_from">April 11</strong> To <strong id="dd_to">July 19</strong></h6>
							<div id="logcountpanel_x" class="loading_indicator"></div>
							<table class="table table-bordered table-striped table-sm" id="tbl_logs">
					<thead>
						<tr>
							<th>Date</th>
							<th>IN</th>
							<th>OUT</th>
							<th>IN</th>
							<th>OUT</th>
							<th>Action</th>
							<th>Remarks</th>
							
						</tr>
					</thead>
					<tbody id="thelogcountbody">
												<?php 

if(session()->has("mylogcache")){
echo session("mylogcache");
}
						?>
					</tbody>
				</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="form-group">
					<button class="btn btn-success btn-block btn-sm" onclick="PrepareApplyLeave()" data-toggle="modal" data-target="#m_applyleave">APPLY LEAVE</button>
				</div>
				<div class="form-group">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title">Recent Leaves</h4>
							<table class="table table-sm table-bordered">
								<tbody id="cont_myrecentlogs">
							
								</tbody>
							</table>
							<div class="form-group">
								<a href="<?php echo e(route('goto_leavehistory')); ?>" class="float-right">View All</a>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group" style="display: none;">
					<div class="card">
						<div class="card-body">
							
							<div class="form-group">
								<p>Viewing Options</p>
								<a href="#" data-toggle="modal" data-target="#cus_logview_modal"><i class="far fa-calendar-alt"></i> Customize</a>
							</div>

						</div>
					</div>
				</div>
			</div>
	</div>
</div>

<script type="text/javascript">
	setTimeout(function(){
		ReloadDataLog();
	},1000)


	function ReloadDataLog(){

	$.ajax({
			type: "POST",
			url:"get_history_leave",
			cache:true,
			data:{_token:"<?php echo e(csrf_token()); ?>"}
			,success: function(data){
				// alert(data);
				$("#cont_myrecentlogs").html(data);
				GetApprovedAndDisapprovedLeave();

			}
		})
		}


	function GetApprovedAndDisapprovedLeave(){
		$.ajax({
			type : "POST",
			url : "get_appr_and_disapp",
			data : {_token: "<?php echo e(csrf_token()); ?>"},
			success : function(data){
				data = JSON.parse(data);
				$("#aal").html(data[0]);
				$("#dss").html(data[1]);
			}
		})
	}

		$("#mynavbar").css("display","inline-flex");
		activ_link("#ll_dash");
</script>
<?php echo $__env->make('comp.dashboard_modals', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>