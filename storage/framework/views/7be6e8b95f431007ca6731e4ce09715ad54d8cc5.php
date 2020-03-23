<?php $__env->startSection('title'); ?>
CDTRS Online Portal
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>


		<div class="container-fluid mt-5">
			<div class="row">
			<div class="col-lg-9">
				<!-- <div class="loading_indicator"></div> -->
				<div class="form-group">
					<h3 class="card-title">Leave History</h3>
					<div class="card" style="overflow: hidden;">

						<div class="card-body table-responsive">
							<h6 class="card-subtitle text-muted mb-2">Displaying all of my leave report</h6>
							<table class="table table-bordered table-striped table-sm " id="tbl_logsx">
					<thead>
						<tr>
							<th>Submitted</th>
							<th>Leave</th>
							<th>From</th>
							<th>To</th>
							<th>Status</th>
							<th>Option</th>
						</tr>
					</thead>
					<tbody id="allofmylvreps">

					</tbody>
				</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="form-group">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title">Related Topics</h5>
							<h6 class="card-subtitle mb-2 text-muted">All related information about your Leave</h6>
							<div id="accordion">
							
							  <div class="card">
							    <div class="card-header">
							      <a class="card-link" data-toggle="collapse" href="#collapseOne">
							        When do i recieve my Form 6?
							      </a>
							    </div>
							    <div id="collapseOne" class="collapse show" data-parent="#accordion">
							      <div class="card-body">
							        When the Leave Report's status is approved, you can now get the printed copy of your Form 6 to the school CDTRS clerk.
							      </div>
							    </div>
							  </div>
							
							  <div class="card">
							    <div class="card-header">
							      <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
							        How do i cancel my leave?
							      </a>
							    </div>
							    <div id="collapseTwo" class="collapse" data-parent="#accordion">
							      <div class="card-body">
							        If you are a Division or a Non-Teaching personnel, you can go to the ICT if you are on the division or school clerk if you are a non-teaching personnel.
							      </div>
							    </div>
							  </div>
							
							  <div class="card">
							    <div class="card-header">
							      <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
							        What Leave type can i file in the CDTRS Online Portal?
							      </a>
							    </div>
							    <div id="collapseThree" class="collapse" data-parent="#accordion">
							      <div class="card-body">
							      	<h5>Disvision Personnel and Non-Teaching</h5>
							        You can only file <strong>Sick Leave</strong> and <strong>Leave Without Pay.</strong>
							        <hr>
							        <h5>Teaching Personnel</h5>
							        You can only file <strong>Service Credit</strong> and <strong>Leave Without Pay.</strong>
							      </div>
							    </div>
							  </div>
							
							</div>
						</div>
					</div>
				</div>
			</div>
	</div>

		</div>
<script type="text/javascript">
		$.ajax({
			type: "POST",
			url: "get_empl_leavereports",
			data: {_token:"<?php echo e(csrf_token()); ?>"},
			success: function(data){
				// alert(data);
				$("#allofmylvreps").html(data);
				$("#tbl_logsx").DataTable({
					"ordering": false,
				});
			}
		})
				$("#mynavbar").css("display","inline-flex");
		activ_link("#ll_lh");
</script>
<?php echo $__env->make('comp.dashboard_modals', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>