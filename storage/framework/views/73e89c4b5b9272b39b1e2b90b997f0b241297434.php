<?php $__env->startSection('title'); ?>
CDTRS HR | Leave Reports
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contents'); ?>

 <h5 class="navbar-brand mt-2 ml-4" href="#"><i class="fas fa-address-book"></i> Leave Reports</h5>
<nav class="navbar navbar-expand-lg" style="margin-bottom: 15px;">
		 
		  <button class="navbar-toggler float-right" style="color: black;" type="button" data-toggle="collapse" data-target="#localcontent" aria-controls="localcontent" aria-expanded="false" aria-label="Toggle navigation">
		    <i class="fas fa-bars"></i>
		  </button>
		
		  <div class="collapse navbar-collapse" id="localcontent">
		    <ul class="navbar-nav mr-auto">
				<li class="nav-item"><span class="nav-link">Filter Report by Station</span></li>
				<li class="nav-item">
				<select id="inp_stationname" class="custom-select">
				
				</select>
				</li>
				<li class="ml-3 nav-item"><span class="nav-link">Month</span></li>
				<li class="nav-item">
				<select id="inp_genmonth" class="custom-select">
				<option value="01">January</option>
				<option value="02">February</option>
				<option value="03">March</option>
				<option value="04">April</option>
				<option value="05">May</option>
				<option value="06">June</option>
				<option value="07">July</option>
				<option value="08">August</option>
				<option value="09">September</option>
				<option value="10">October</option>
				<option value="11">November</option>
				<option value="12">December</option>
				</select>
				</li>
				<li class="ml-3 nav-item"><span class="nav-link">Year</span></li>
				<li class="nav-item">
				<select id="inp_genyear" class="custom-select">

				</select>
				</li>
				<li class="ml-3 nav-item">
				<button class="btn btn-primary" id="generate_abstract"><i class="fas fa-search"></i> Scan for Leave</button>
				</li>
		    </ul>
		  </div>
		</nav>

		<div class="container-fluid">
			
			<div class="card">
				<div class="loading_indicator" id="lod_abstract" style="display: block;">
				
			</div>
				<div class="card-body">
					<h5 class="card-title" id="id_gen_sc_name">Barangka Elementary School</h5>
					<h6 class="card-subtitle text-muted mb-4">ABSTRACT REPORT FOR THE MONTH OF <span id="id_gen_month">AUGUST</span> <span id="id_gen_year">2019</span></h6>
					<table class="table table-sm table-bordered" id="dt_abstract">
						<thead>
							<tr>
								<th>No.</th>
								<th>Emp #</th>
								<th>Fullname</th>
								<th>Designation</th>
								<th>Absences</th>
								<th>No of Absences</th>
								<th>Tardy days</th>
								<th>Service Credits (National)</th>
								<th>Deduct</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody id="all_leave_rep">
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
<script type="text/javascript">

	SetupLeaveGeneration();
	
	$("#generate_abstract").click(function(){
		GetLeaveSummary();
	})
	function SetupLeaveGeneration(){
			var inp_station = $("#inp_stationname");
			var inp_month = $("#inp_genmonth");
			var inp_year = $("#inp_genyear");

			// GET ALL STATION
			$.ajax({
				type : "POST",
				url : "get_supported_station_names",
				data : {_token: "<?php echo e(csrf_token()); ?>"},
				success : function(data){
					// alert(data);
					$("#inp_stationname").html(data);
					$("#inp_genmonth").val(<?php echo json_encode(date("m")); ?>);
					setyears();
				}
			})
			// GET CURRENT MONTH 
			// GET CURRENT YEAR
	}
	function setyears(){
					$.ajax({
			type : "POST",
			url : "get_years_lineup",
			data : {_token: "<?php echo e(csrf_token()); ?>"},
			success : function(data){
				// alert(data);
				$("#inp_genyear").html(data);
				GetLeaveSummary();
			}
		})
	}
	function GetLeaveSummary(){
		$("#all_leave_rep").html("");
		$("#lod_abstract").css("display","block");
		 $('#dt_abstract').DataTable().destroy();
		var inp_station = $("#inp_stationname").val();
		var inp_month = $("#inp_genmonth").val();
		var inp_year = $("#inp_genyear").val();
		$("#id_gen_sc_name").html(inp_station);
		$("#id_gen_month").html($("#inp_genmonth :selected").text().toUpperCase());
		$("#id_gen_year").html(inp_year);
		$.ajax({
		type : "POST",
		url : "generate_leave_reports",
		data : {
			_token: "<?php echo e(csrf_token()); ?>",
			gen_station:inp_station,
			gen_month:inp_month,
			gen_year:inp_year},
		success : function(data){
			$("#all_leave_rep").html(data);
			$("#lod_abstract").css("display","none");
			$("#dt_abstract").DataTable({
				"ordering": false,
			});
		}
	})
	}
	highlight_pagelink("#page_leavereports");

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master_admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>