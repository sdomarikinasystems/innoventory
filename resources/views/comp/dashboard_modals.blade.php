
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
    	<div class="loading_indicator" id="lod_checkifavailableonleave">
    		
    	</div>
    	<div id="dispute_excuse" style="display: block; position: absolute; top: 0; left: 0; right : 0; bottom: 0; height: 100%; width: 100%; z-index: 2; background-color: white; padding:20px;">
      		<h5 class="card-title">Dispute date is on leave.</h5>
      		<h6 class="card-subtitle mb-5 text-muted">This selected dispute date is not available because it's scheduled to be on-leave.</h6>
      		<a href="{{ route('goto_leavehistory') }}"><i class="fas fa-arrow-right"></i> Check my Leave Reports</a><br>
      		<a href="#" data-dismiss="modal"><i class="fas fa-arrow-right"></i> Cancel</a>
      	</div>


      <div class="modal-body">
      	
      	<h5 class="card-title ultrabold">APPLY DISPUTE</h5>
	      	<h6 class="card-subtitle text-muted mb-2">No worries. Dispute is here to the rescue!</h6>
	      	<br>
      	{{ csrf_field() }}
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
	{{ csrf_field() }}
	<div class="modal" tabindex="-1" role="dialog" id="m_applyleave">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">


	    	<div id="hasnoleavepanel" style="display: block; position: absolute; top: 0; left: 0; right : 0; bottom: 0; height: 100%; width: 100%; z-index: 2; background-color: white; padding:20px;">
      		<h5 class="card-title">You have no entitlements</h5>
      		<h6 class="card-subtitle mb-5 text-muted">Please consult your School Clerk or ICT Coordinator to add your Leave Entitlements in your school CDTRS.</h6>
      		<a href="#" data-dismiss="modal"><i class="fas fa-arrow-right"></i> Go Back</a>
      	</div>



	      <div class="modal-body">
	      	<div class="loading_indicator" id="apply_load"></div>
	      	<h5 class="card-title ultrabold">APPLY LEAVE</h5>
	      	<h6 class="card-subtitle text-muted mb-2">Only entitlements with no zero balance can be applied here.</h6>
	      	<br>
	      	<input type="hidden" value="{{ session('user_formattedname') }}" name="inp_fullname">
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
	        	<div class="card" id="vacation_leave_type">
	        		<div class="card-body">
	        			<h5 class="card-title">Vacation Leave Type</h5>
	        		<h6 class="card-subtitle mb-4 text-muted">Indicate what type of Vacation Leave you what to apply.</h6>
	        			<div class="form-group">
	        				<label><input type="radio" name="vacation_leave_type" id="id_vac_check_1" value="To Seek Employment"> To Seek Employment</label>
	        			</div>
	        			<div class="form-group">
	        				<label><input type="radio" name="vacation_leave_type" id="id_vac_check_2" value="Others (Specify)"> Others (Specify)</label><br>
	        				<input type="text" class="form-control" id="id_vac_check_2_field" name="vac_type_specify" placeholder="Type here...">
	        			</div>
	        		<h6 class="card-title mb-4">Where the leave will be spent?</h6>
	        		<div class="row">
	        			<div class="col-md-6">
	        				<label><input type="radio" name="vacation_leave_location" value="Within the Philippines" id="vac_loc_1"> Within the Philippines</label>
	        			</div>
	        			<div class="col-md-6">
	        				<label><input type="radio" name="vacation_leave_location" value="Abroad (Specify)" id="vac_loc_2"> Abroad (Specify)<br>
	        				<input type="text" class="form-control" name="vac_loc_specify" placeholder="Type here..." id="vac_loc_2_field"></label>
	        			</div>
	        		</div>
	        		</div>
	        	</div>
	        	<div class="card" style="overflow: hidden;" id="sick_leave_type">
	        	<div class="card-body">
	        		<h5 class="card-title">Sick Leave Type</h5>
	        		<h6 class="card-subtitle mb-4 text-muted">Select one by clicking the circle that indicates your sick leave preference.</h6>
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
	        <button type="submit" id="submitnutton" class="btn btn-primary"><i class="fas fa-plane"></i> Submit</button>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="far fa-times-circle"></i> Cancel</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>
<script type="text/javascript">


	$("#sick_sel_1").click(function(){
		$("#sick_selcont_1").css("display","block");
		$("#sick_selcont_2").css("display","none");

		$("#inp_location_1").prop("required",true);
		$("#inp_location_2").prop("required",false);
	
		AttemptShowSubmitLeaveButton();
	})
	$("#sick_sel_2").click(function(){
		$("#sick_selcont_1").css("display","none");
		$("#sick_selcont_2").css("display","block");

		$("#inp_location_1").prop("required",false);
		$("#inp_location_2").prop("required",true);
	
		AttemptShowSubmitLeaveButton();
	})

	$("#id_vac_check_1").click(function(){
		$("#id_vac_check_2_field").prop("required",false);
		AttemptShowSubmitLeaveButton();
	})
	$("#id_vac_check_2").click(function(){
		
		$("#id_vac_check_2_field").prop("required",true);
		AttemptShowSubmitLeaveButton();
	})
	$("#vac_loc_1").click(function(){
		$("#vac_loc_2_field").prop("required",false);
		AttemptShowSubmitLeaveButton();
	})
	$("#vac_loc_2").click(function(){
		$("#vac_loc_2_field").prop("required",true);
		AttemptShowSubmitLeaveButton();
	})


	function AttemptShowSubmitLeaveButton(){
	var l_type = $("#inp_leavetype :selected").text();
		var hasprob = false;

		if($("#txt_leavedays").html() == "0"){
			hasprob = true;
		}


		if(l_type == "Vacation Leave"){
			if($("#vac_loc_1").prop("checked") == false && $("#vac_loc_2").prop("checked") == false){
				hasprob = true;
		}

		if($("#id_vac_check_1").prop("checked") == false && $("#id_vac_check_2").prop("checked") == false){
				hasprob = true;
		}
		}
		if (hasprob) {
			$("#submitnutton").css("display","none");
		}else{
			$("#submitnutton").css("display","inline-block");
		}

	}
	function PrepareApplyLeave(){
		$("#apply_load").css("display","block");
		$(".leave_preferences_panel").css("display","none");
		var utype= "{{ session('user_type') }}";
		var issigleparent = <?php echo json_encode(session("user_issingle")) ?>;
		// alert(issigleparent);
		$("#inp_leavetype").html("");
		$.ajax({
		type: "POST",
		url: "get_employee_leavetypes",
		data: {_token:"{{ csrf_token() }}"},
		success: function(data){
			$("#inp_leavetype").append("<option disabled selected value=''>Choose a Leave Type...</option>");
			data = JSON.parse(data);

			if(data.length != 0){

							if (utype == "1" || utype == "3") {
				// NON TEACHING / DIVISION PERSONNEL
				$("#inp_leavetype").append("<option value='" + data[0]["sick_leave"] + "'>Sick Leave</option>");
				$("#inp_leavetype").append("<option value='" + data[0]["vacation_leave"] + "'>Vacation Leave</option>");
				$("#inp_leavetype").append("<option value='" + data[0]["special_leave"] + "'>Special Leave</option>");
				GetLatestCTO();
			}else if(utype == "2"){
				// TEACHING PERSONNEL
				$("#inp_leavetype").append("<option value='" + data[0]["service_credit"] + "'>Service Credit</option>");
			}
			// UNIVERSAL LEAVES

			// CHECK IF SINGLE PARENT
			if(issigleparent == "1"){
				$("#inp_leavetype").append("<option value='" + data[0]["single_parent_leave"] + "'>Single Parent Leave</option>");
			}


			// LEAVE WITHOUT PAY
			$("#inp_leavetype").append("<option value='0'>Leave Without Pay</option>");
		ApplyLeavePreferences();
		LeaveDaysCounter();


				$("#hasnoleavepanel").css("display","none");
			}else{
				$("#hasnoleavepanel").css("display","block");
			}


		$("#apply_load").css("display","none");
		}
		})

		
	}

		$("#inp_leavetype").change(function(){
		ApplyLeavePreferences();
	})

	function GetLatestCTO(){
		$.ajax({
			type : "POST",
			url: "cto_latest_get",
			data: {_token:"{{ csrf_token() }}"},
			success: function(data){
				data = JSON.parse(data);
				if(data.length == 1){
						$("#inp_leavetype").append("<option value='" + data[0]["entitlement"] + "'>CTO</option>");
				}
			}
		})
	}
	function ApplyLeavePreferences(controOBJ){

		$("#inp_location_1").prop("required",false);
		$("#inp_location_2").prop("required",false);
		$("#id_vac_check_1").prop("required",false);
		$("#id_vac_check_2").prop("required",false);
		$("#id_vac_check_2_field").prop("required",false);

		$("#txt_bal").html($("#inp_leavetype").val());
		$("#inp_trueval_leavebalance").val($("#inp_leavetype").val());

		if ($("#inp_leavetype").val() != "" && $("#inp_leavetype").val() != null) {
			$(".leave_preferences_panel").css("display","block");
		}else{
			$(".leave_preferences_panel").css("display","none");
		}
		// RESET SPECIAL INPUTS 
		$("#sick_leave_type").css("display","none");
		$("#vacation_leave_type").css("display","none");
		$("#id_inp_theleavetype").val($("#inp_leavetype :selected").text());

		var current_leavetype = $("#inp_leavetype :selected").text();
		switch(current_leavetype){
			case "Service Credit":
				ApplyValidation_SickLeave();
			break;
			case "Sick Leave":
				ApplyValidation_SickLeave();
			break;
			case "Leave Without Leave":
				ApplyValidation_SickLeave();
			break;
			case "Vacation Leave":
				ApplyValidation_VacationLeave();
			break;
			case "Special Leave":

			break;
		}
		ComputeFutureLeaveBalance();
	}
	function ApplyValidation_SickLeave(){
		$("#sick_leave_type").css("display","block");
		

		$("#sick_sel_1").prop("checked",false);
		$("#sick_sel_2").prop("checked",false);

		$("#sick_selcont_1").css("display","none");
		$("#sick_selcont_2").css("display","none");
		$("#submitnutton").css("display","none");
	}
	function ApplyValidation_VacationLeave(){
		$("#vacation_leave_type").css("display","block");
		$("#submitnutton").css("display","none");
	}
	function LeaveDaysCounter(){
		var inp_from = $("#inp_from").val();
		var inp_to =  $("#inp_to").val();
		$.ajax({
			type : "POST",
			url: "days_leave_counter",
			data: {_token:"{{ csrf_token() }}",date_inp_from:inp_from,date_inp_to:inp_to},
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
<?php
$cache_available = 0;
$catche_logs = "";
if(session()->has("mylogcache")){
$cache_available = 1;
$catche_logs = session("mylogcache");
}
?>
<script type="text/javascript">
	$("#tbl_logs").DataTable();
	setTimeout(function(){
		$("#logcountpanel_x").css("display","block");
		var hascache = <?php echo json_encode($cache_available); ?>;
		if(hascache == "0"){

			LoadLogRecords();
		}else{
			$("#tbl_logs").DataTable().destroy();
$("#logcountpanel_x").css("display","none");
				$("#tbl_logs").DataTable({
					"ordering": false,
				});
				LoadLogRecords_silent();
}
			
		
	},500)

	function PrepareApplyDispute(controlOBJ){

		$("#lod_checkifavailableonleave").css("display","block");
		$("#dispute_excuse").css("display","block");
		$("#inp_dispute_date").val($(controlOBJ).data("dofdisp"));
		var dateofdisp = $(controlOBJ).data("dofdisp");
		$.ajax({
			type : "POST",
			url : "{{ route('check_if_disputabledate') }}",
			data: {_token:"{{ csrf_token() }}",dispute_date:dateofdisp},
			success: function(data){
				$("#lod_checkifavailableonleave").css("display","none");
				if(data == "false"){
					$("#dispute_excuse").css("display","none");
				}
			}
		})
	}
		function LoadLogRecords_silent(){
		var starting = <?php 
		$custom_date_starting =  date("Y-m-d");
		echo json_encode($custom_date_starting);
		 ?>;
		var ending = <?php 

		$custom_date_ending =  date('Y-m-d', strtotime( date("Y-") . (date("m") - 1) . "-11"));
		echo json_encode($custom_date_ending);
		 ?>;


		var s_f_date = <?php
			echo json_encode(date("F d, Y",strtotime($custom_date_starting)));
		 ?>;
		var e_f_date = <?php
			echo json_encode(date("F d, Y",strtotime($custom_date_ending)));
		 ?>;
		$("#dd_to").html(s_f_date);
		$("#dd_from").html(e_f_date);
		$.ajax({
			type: "POST",
			url: "load_log_records",
			cache: true,
			data: {_token: "{{ csrf_token() }}",starting_date:starting,ending_date:ending},
			success: function(data){
				// alert(data);
				$("#tbl_logs").DataTable().destroy();
				$("#thelogcountbody").html(data);
				$("#tbl_logs").DataTable({
					"ordering": false,
				});
			
			}
		})
	}

	function LoadLogRecords(){
	
		$("#tbl_logs").DataTable().destroy();
		var starting = <?php 

		$custom_date_starting =  date("Y-m-d");
		echo json_encode($custom_date_starting);
		 ?>;
		var ending = <?php 

		$custom_date_ending =  date('Y-m-d', strtotime( date("Y-") . (date("m") - 1) . "-11"));
		echo json_encode($custom_date_ending);
		 ?>;


		var s_f_date = <?php
			echo json_encode(date("F d, Y",strtotime($custom_date_starting)));
		 ?>;
		var e_f_date = <?php
			echo json_encode(date("F d, Y",strtotime($custom_date_ending)));
		 ?>;
		$("#dd_to").html(s_f_date);
		$("#dd_from").html(e_f_date);
		$.ajax({
			type: "POST",
			url: "load_log_records",
			cache: true,
			data: {_token: "{{ csrf_token() }}",starting_date:starting,ending_date:ending},
			success: function(data){

				$("#logcountpanel_x").css("display","none");

					// alert(data);
				$("#thelogcountbody").html(data);
				$("#tbl_logs").DataTable({
					"ordering": false,
				});
			
			}
		})
	}
		function LoadLogRecords_custom(){
			$("#logcountpanel_x").css("display","block");
		var starting = $("#id_ending_date").val();
		var ending = $("#id_starting_date").val();

		$("#dd_to").html(starting);
		$("#dd_from").html(ending);
		if (starting != "" && ending != "") {
					$("#tbl_logs").DataTable().destroy();
					$.ajax({
			type: "POST",
			url: "load_log_records",
			data: {_token: "{{ csrf_token() }}",starting_date:starting,ending_date:ending},
			success: function(data){
					// alert(data);
				$("#thelogcountbody").html(data);
				$("#tbl_logs").DataTable({
					"ordering": false,
				});
			$("#logcountpanel_x").css("display","none");
			}
		})
		}else{
			alert("Fill-up all the required fields for me to work properly.");
		}

	}
</script>