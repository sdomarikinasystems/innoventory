<?php $__env->startSection('title'); ?>
CDTRS Online Portal
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<div class="container">
	<nav class="navbar navbar-expand-lg" style="background-color: #34495e !important;">
	  <a class="navbar-brand" href="#" style="color: white;"><i class="far fa-user-circle"></i> Employee Dashboard</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	    </ul>
	    <form action="portal_logout" method="GET" class="form-inline my-2 my-lg-0">
	    	<?php echo e(csrf_field()); ?>

	      <button class="btn btn-primary my-2 my-sm-0" type="submit">Sign-out</button>
	    </form>
	  </div>
	</nav>
	<div class="jumbotron" style="color : white; background-color: #2c3e50;">
		<div class="row">
			<div class="col-sm-2">
				<center>
					<div class="bgworthy" style="background-image: url(<?php echo e(asset('images/user.png')); ?>); width: 156px; height: 156px; border-radius: 50%;">
				</div>
				</center>
			</div>
			<div class="col-sm-10">
				<div class="form-group">
					<span><span class="lessen">Hi there,</span> <h3 class="ultrathin"><?php echo e(session('user_formattedname')); ?></h3></span>
					<span><span class="lessen">Employee Type:</span> <span><?php echo e(session('user_formattedusertype')); ?></span></span><br>
					<span><span class="lessen">Schedule:</span> <span><?php echo e(session('user_formattedschedule')); ?></span></span><br>
					<span><span class="lessen">Station:</span> <span><?php echo e(session('user_company')); ?></span></span><br>
				</div>

			</div>
		</div>
	</div>

		<div class="row">
			<div class="col-sm-9">
				<div class="form-group">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title">My Log Records</h5>
							<h6 class="card-subtitle text-muted mb-2">My generated logs from my station's CDTRS</h6>
							<table class="table table-bordered table-striped table-sm" id="tbl_logs">
					<thead>
						<tr>
							<th>Date</th>
							<th>IN</th>
							<th>OUT</th>
							<th>IN</th>
							<th>OUT</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="thelogcountbody">
						
					</tbody>
				</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<button class="btn btn-primary btn-block btn-sm" onclick="PrepareApplyLeave()" data-toggle="modal" data-target="#m_applyleave">APPLY LEAVE</button>
				</div>
				<div class="form-group">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title">Recent Leaves</h4>
							<h6 class="text-muted card-subtitle mb-2">Showing your last 5 Leave Request.</h6>
							<table class="table table-sm table-bordered">
								<tbody id="cont_myrecentlogs">
							
								</tbody>
							</table>
							<small>
								<i>To access full leave history, please ask for your ICT Coordinator.</i>
							</small>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="card">
						<div class="card-body">
							
							<div class="alert alert-primary" role="alert">
								<h4>Displaying</h4>
							  From <strong id="dd_from">April 11</strong><br>To <strong id="dd_to">July 19</strong>
							</div>
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
$.ajax({
		type: "POST",url:"get_history_leave",data:{
			_token:"<?php echo e(csrf_token()); ?>"
		},success: function(data){
			// alert(data);
			$("#cont_myrecentlogs").html(data);
		}
	})
	},1000)
</script>
<?php echo $__env->make('comp.dashboard_modals', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>