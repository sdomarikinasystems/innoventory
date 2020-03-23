
<form action="load_log_records" method="POST">
	<div class="modal" tabindex="-1" role="dialog" id="cus_logview_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
      	<h4 class="ultrabold">View My Logs</h4>
        <div class="row">
        	<div class="col-sm-6">
        		<div class="form-group">
        			<label>Starting From</label>
        			<input type="date" class="form-control" id="id_starting_date">
        		</div>
        	</div>
        	<div class="col-sm-6">
        		<div class="form-group">
        			<label>To</label>
        			<input type="date" class="form-control" id="id_ending_date">
        		</div>
        	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="LoadLogRecords_custom()" class="btn btn-sm btn-primary" data-dismiss="modal">Load Logs</button>
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</form>

<form action="dispute_apply" method="POST">
	<div class="modal" tabindex="-1" role="dialog" id="m_applydispute">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
      	<h5 class="card-title ultrabold">APPLY DISPUTE</h5>
	      	<h6 class="card-subtitle text-muted mb-2">No worries. Dispute is here to the rescue!</h6>
	      	<br>
      	<?php echo e(csrf_field()); ?>

      	<input type="hidden" id="inp_dispute_date" name="disp_date_of_dispute">
        <div class="form-group">
        	<h6 class="mb-2">Dispute Type: </h6>
        	<label><input type="radio" value="0" checked="disp_isoath" name="disp_dispute_type"> For Missing or Incorrect Timelog(s)</label><br>
        	<label><input type="radio" value="1" name="disp_dispute_type"> For Undertime</label>
        </div>
             <div class="form-group">
        	<label>Reason for Dispute</label>
        	<textarea class="form-control" placeholder="Type here..." required="" autocomplete="off" name="disp_reason"></textarea>
        </div>

         <div class="form-group">
        	<label><input type="checkbox" name="disp_isoath" value="1" required=""> I promise that all information provided in this <strong>Dispute Request Form</strong> is all true.</label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</form>
<form action="leave_apply" method="POST">
	<?php echo e(csrf_field()); ?>

	<div class="modal" tabindex="-1" role="dialog" id="m_applyleave">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-body">
	      	<h5 class="card-title ultrabold">APPLY LEAVE</h5>
	      	<h6 class="card-subtitle text-muted mb-2">Only entitlements with no zero balance can be applied here.</h6>
	      	<br>
	      	<input type="hidden" value="<?php echo e(session('user_formattedname')); ?>" name="inp_fullname">
	        <div class="form-group">
	        	<label>Leave Type</label>
	        	<select required="" class="form-control form-control-lg" name="inp_leavetype" id="inp_leavetype">
	        		
	        	</select>
	        	<input type="hidden" id="id_inp_theleavetype" name="inp_theleavetypeselected">
	        </div>
	       <div class="leave_preferences_panel" style="display: none;">
	       	 <div class="form-group">
	        	<table class="table table-sm table-bordered">
	        		<thead>
	        			<tr>
	        				<th class="text-muted">Leave Balance</th>
	        				<th class="text-muted">Days of Leave</th>
	        				<th class="text-muted">New Balance</th>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			<tr>
	        				<td id="txt_bal" style="text-align: center; font-size: 25px;">0</td>
	        				<td id="txt_leavedays" style="text-align: center; font-size: 25px;">0</td>
	        				<td id="txt_total" style="text-align: center; font-size: 25px;">0</td>
	        			</tr>
	        			<tr>
	        				<th colspan="3" class="text-muted">Leave Pay Information</th>
	        			</tr>
	        			<tr>
	        				<td colspan="3">
	        					<div class="row">
	        		<div class="col-sm-3">
	        			<small>With Pay</small>
	        			<input type="text" style="background-color: transparent; font-size: 20px; border: none !important;" readonly="true" class="form-control" value="0" id="inp_lwp" name="inp_dayswithpay">
	        		</div>
	        		<div class="col-sm-3">
	        			<small>Without Pay</small>
	        			<input type="text" style="background-color: transparent; font-size: 20px; border: none !important;" readonly="true" class="form-control" value="0" id="inp_lnp" name="inp_dayswithoutpay">
	        		</div>
	        	</div>
	        				</td>
	        			</tr>
	        		</tbody>
	        	</table>
	        	<!-- TRUE VALUES --> 
	        	<input type="hidden" id="inp_trueval_leavebalance" placeholder="leave balance" name="">
	        	<input type="hidden" id="inp_trueval_leavedays" placeholder="leave days taken" name="leave_taken_value">
	        	<input type="hidden" id="inp_trueval_total" placeholder="leave total of leave days" name="">
	        </div>
	      <div class="form-group">
	      	 <div class="card">
	       	<div class="card-body">
	       		<h5 class="card-title">Set Leave Date</h5>
	       		<h6 class="card-subtitle text-muted mb-2">Set the date(s) you want to start and end your leave.</h6>
	       		 <div class="row">
	        	<div class="col-sm-6">
	        		<div class="form-group">
	        	<label>FROM</label>
	        	<input type="date" required="" class="form-control" id="inp_from" onchange="LeaveDaysCounter()" value="<?php echo date('Y-m-d'); ?>" name="date_from">
	        </div>
	        	</div>
	        	<div class="col-sm-6">
	        		<div class="form-group">
	        	<label>TO</label>
	        	<input type="date" required="" class="form-control" id="inp_to" onchange="LeaveDaysCounter()" value="<?php echo date('Y-m-d'); ?>" name="date_to">
	        </div>
	        	</div>
	        </div>
	       	</div>
	       </div>
	      </div>

	        <div class="form-group">
	        	<div class="card" style="overflow: hidden;">
	        	<div class="card-body">
	        		<h5 class="card-title">Sick Leave Type</h5>
	        		<h6 class="card-subtitle mb-2 text-muted">Select one by clicking the circle that indicates your sick leave preference.</h6>
	        		<br>
	        		<div class="row">
	        	<div class="col-sm-12">
	        		<div class="form-group">
	        			<label><input type="radio" id="sick_sel_1" value="In Hospital" name="leavetype_status"> In Hospital</label>
	        			<div class="form-group" id="sick_selcont_1">
	        				<small>Type the name of the hospital</small>
	        			<input autocomplete="off" class="form-control" placeholder="Type here..." autocomplete="off" type="text-muted" name="location_1" id="inp_location_1">
	        			</div>
	        			
	        		</div>
	        	</div>
	        	<div class="col-sm-12">
	        		<div class="form-group">
	        			<label><input type="radio" id="sick_sel_2" value="Out Patient" name="leavetype_status"> Out Patient</label>
	        			<div class="form-group" id="sick_selcont_2">
	        				<small>Type where</small>
	        			<input autocomplete="off" class="form-control" placeholder="Type here..." autocomplete="off" type="text-muted" name="location_2" id="inp_location_2">
	        			</div>
	        			
	        		</div>
	        	</div>
	        </div>
	        	</div>
	        </div>
	        </div>
	       </div>
	      </div>
	      <div class="leave_preferences_panel modal-footer" style="display: none;">
	        <button type="submit" id="submitnutton" class="btn btn-primary"><i class="fas fa-plane"></i> Apply Leave for Approval</button>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="far fa-times-circle"></i> Cancel</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>
<script type="text/javascript">

	var hasspecifiedinfosick = false;
	$("#sick_sel_1").click(function(){
		$("#sick_selcont_1").css("display","block");
		$("#sick_selcont_2").css("display","none");

		$("#inp_location_1").prop("required",true);
		$("#inp_location_2").prop("required",false);
		hasspecifiedinfosick = true;
		AttemptShowSubmitLeaveButton();
	})
	$("#sick_sel_2").click(function(){
		$("#sick_selcont_1").css("display","none");
		$("#sick_selcont_2").css("display","block");

		$("#inp_location_1").prop("required",false);
		$("#inp_location_2").prop("required",true);
		hasspecifiedinfosick = true;
		AttemptShowSubmitLeaveButton();
	})
	function AttemptShowSubmitLeaveButton(){

		var hasprob = false;

		if (hasspecifiedinfosick == false) {
			hasprob = true;
		}
		if($("#txt_leavedays").html() == "0"){
			hasprob = true;
		}

		if (hasprob) {
			$("#submitnutton").css("display","none");
		}else{
			$("#submitnutton").css("display","inline-block");
		}
	}
	function PrepareApplyLeave(){
		$(".leave_preferences_panel").css("display","none");
		var utype= "<?php echo e(session('user_type')); ?>";
		$("#inp_leavetype").html("");
		$.ajax({
		type: "POST",
		url: "get_employee_leavetypes",
		data: {_token:"<?php echo e(csrf_token()); ?>"},
		success: function(data){
			$("#inp_leavetype").append("<option disabled selected value=''>Choose a Leave Type...</option>");
			data = JSON.parse(data);
			if (utype == "1" || utype == "3") {
				$("#inp_leavetype").append("<option value='" + data[0]["sick_leave"] + "'>Sick Leave</option>");
				$("#inp_leavetype").append("<option value='0'>Leave Without Pay</option>");

			}else if(utype == "2"){
				$("#inp_leavetype").append("<option value='" + data[0]["service_credit"] + "'>Service Credit</option>");
				$("#inp_leavetype").append("<option value='0'>Leave Without Pay</option>");
			}
		ApplyLeavePreferences();
		LeaveDaysCounter();


		}
		})

		
	}

		$("#inp_leavetype").change(function(){
		ApplyLeavePreferences();
	})
	function ApplyLeavePreferences(controOBJ){
		$("#txt_bal").html($("#inp_leavetype").val());
		$("#inp_trueval_leavebalance").val($("#inp_leavetype").val());
		// alert($("#inp_leavetype").val());
		if ($("#inp_leavetype").val() != "" && $("#inp_leavetype").val() != null) {
			$(".leave_preferences_panel").css("display","block");
		}else{
			$(".leave_preferences_panel").css("display","none");
		}

		$("#id_inp_theleavetype").val($("#inp_leavetype :selected").text())

		$("#sick_sel_1").prop("checked",false);
		$("#sick_sel_2").prop("checked",false);

		$("#sick_selcont_1").css("display","none");
		$("#sick_selcont_2").css("display","none");
		$("#submitnutton").css("display","none");
		ComputeFutureLeaveBalance();
	}

	function LeaveDaysCounter(){
		var inp_from = $("#inp_from").val();
		var inp_to =  $("#inp_to").val();
		$.ajax({
			type : "POST",
			url: "days_leave_counter",
			data: {_token:"<?php echo e(csrf_token()); ?>",date_inp_from:inp_from,date_inp_to:inp_to},
			success: function(data){
				// alert(data);
				$("#txt_leavedays").html(data);
				$("#inp_trueval_leavedays").val(data);
				ComputeFutureLeaveBalance();
				AttemptShowSubmitLeaveButton();
			}
		})
	}
	function ComputeFutureLeaveBalance(){
		var LeaveBalance = parseInt($("#inp_trueval_leavebalance").val());
		var DaysOfLeave = parseInt($("#inp_trueval_leavedays").val());
		var TotalFutureBalance =parseInt(LeaveBalance - DaysOfLeave);
		var lnp = "";
		var lwp = "" ;
		var txt_leavedays = parseInt($("#txt_leavedays").html());
		var txt_bal = parseInt($("#txt_bal").html());

		




		if (TotalFutureBalance < 0) {
			lnp += TotalFutureBalance;
			lnp = lnp.replace("-","");
			TotalFutureBalance = 0;
		}else{
			lnp = 0;
		}

		if(txt_bal > txt_leavedays){
			lwp += txt_leavedays;
		}else{
			if(txt_bal != 0){
				lwp +=  txt_bal;
			}else{
				lwp =0;
			}
		}
		$("#inp_lnp").val(lnp);
		$("#inp_lwp").val(lwp);
		$("#txt_total").html(TotalFutureBalance);
		$("#inp_trueval_total").val(TotalFutureBalance);
	}
</script>

<script type="text/javascript">
	$("#tbl_logs").DataTable();
	setTimeout(function(){
		LoadLogRecords();
	},200)
	function PrepareApplyDispute(controlOBJ){
		// alert($(controlOBJ).data("dofdisp"));
		$("#inp_dispute_date").val($(controlOBJ).data("dofdisp"));
	}
	function LoadLogRecords(){
		$("#tbl_logs").DataTable().destroy();
		var starting = <?php echo json_encode(date("Y-m-d")); ?>;
		var ending = <?php echo json_encode(date('Y-m-d', strtotime('-50 days'))); ?>;

		$("#dd_to").html(starting);
		$("#dd_from").html(ending);
		$.ajax({
			type: "POST",
			url: "load_log_records",
			data: {_token: "<?php echo e(csrf_token()); ?>",starting_date:starting,ending_date:ending},
			success: function(data){
					// alert(data);
				$("#thelogcountbody").html(data);
				$("#tbl_logs").DataTable({
					"ordering": false,
				});
			
			}
		})
	}
		function LoadLogRecords_custom(){
		var starting = $("#id_ending_date").val();
		var ending = $("#id_starting_date").val();

		$("#dd_to").html(starting);
		$("#dd_from").html(ending);
		if (starting != "" && ending != "") {
					$("#tbl_logs").DataTable().destroy();
					$.ajax({
			type: "POST",
			url: "load_log_records",
			data: {_token: "<?php echo e(csrf_token()); ?>",starting_date:starting,ending_date:ending},
			success: function(data){
					// alert(data);
				$("#thelogcountbody").html(data);
				$("#tbl_logs").DataTable({
					"ordering": false,
				});
			
			}
		})
		}else{
			alert("Fill-up all the required fields for me to work properly.");
		}

	}
</script>