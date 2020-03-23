

<?php $__env->startSection('title'); ?>
ProcMS - Innoventory
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>

<h2>Transactions History</h2>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('dboard')); ?>">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Transactions History</li>
	</ol>
</nav>

<div class="row mt-3">
	<div class="col-sm-9">
		<table class="table" id="tbl_tra">
			<thead>
				<tr>
					<th>Account</th>
					<th>Action Taken</th>
					<th>User</th>
				</tr>
			</thead>
			<tbody id="alltranstbl">

			</tbody>
		</table>
	</div>
  <div class="col-sm-3">
    <div class="card">
      <div class="card-body">
         <h5 class="mb-3"><i class="fas fa-tags"></i> Action Tags</h5>
        <table class="table">
         <thead>
           <tr>
             <th>Code</th>
             <th>Action</th>
           </tr>
         </thead>
         <tbody>
            <tr>
            <td>a01</td>
            <td>Imported asset package</td>
          </tr>
          <tr>
            <td>a02</td>
            <td>Generated Report</td>
          </tr>
          <tr>
            <td>a03</td>
            <td>Disposed an asset</td>
          </tr>
           <tr>
            <td>a04</td>
            <td>Created new account</td>
          </tr>
          <tr>
            <td>a05</td>
            <td>Deleted an Account</td>
          </tr>
          <tr>
            <td>a06</td>
            <td>Edited an Account Info</td>
          </tr>
          <tr>
            <td>a07</td>
            <td>Restored an Asset</td>
          </tr>
         </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $.ajax({
    type: "POST",
    url: "<?php echo e(route('get_trhisto')); ?>",
    data: {_token:"<?php echo e(csrf_token()); ?>"},
    success: function(data){
      // alert(data);
      $("#alltranstbl").html(data);
      $("#tbl_tra").DataTable();
    }
  })
  var showed = false;
  $("#btn_myactlogs").click(function(){
    if(!showed){
      $("#c1").removeClass("col-sm-12");
       $("#c1").addClass("col-sm-9");
       $("#c2").css("display","block");
       showed = true;
       $("#btn_myactlogs").html('<i class="fas fa-tags"></i> Hide Action Tags');
    }else{
$("#c1").removeClass("col-sm-9");
       $("#c1").addClass("col-sm-12");
       $("#c2").css("display","none");
      showed = false;
       $("#btn_myactlogs").html('<i class="fas fa-tags"></i> Show Action Tags');
    }
  })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>