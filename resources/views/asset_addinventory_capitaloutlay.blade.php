@extends('master.master')

@section('title')
Innoventory - Inventory Mode
@endsection

@section('contents')
<div id="step_0" style="display: block;">
	<div class="container">
		<div class="mt-5">
			<h5>Recovering last session...</h5>
		</div>
	</div>
</div>
<div id="session_restore" style="display: none;">
	<div class="container">
		<div style="margin-top: 25vh;">
			<div class="card card-shadow" style="margin: auto; width: 600px;">
				<div class="card-body">
					<div class="mt-3 mb-3">
						<h5 class="mb-2">Continue your last session in<br><?php echo $_GET["station_full_name"]; ?>?</h5>
						<p class="text-muted mb-4 mt-0">Continuing will recover your last unsubmitted scanned data. New scan will completely remove your last scanned data and start a new.</p>
					</div>
				</div>
				<div class="card-footer">
					<button class="btn btn-primary" onclick="SessionAbsoluteRestore()"><i class="fas fa-redo"></i> Continue Session</button>
						<button class="btn btn-secondary" onclick="SessionAbsoluteCancel()">New Scan</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="select_service_center_page" style="display: none;">
	<div class="container">
		<div style="margin-top: 25vh;">
			<div class="card card-shadow" style="margin: auto; width: 600px;">
				<div class="card-body">
					<div class="mt-3 mb-3">
						<h5 class="mb-2">Service Center to begin with</h5>
						<div class="form-group">
							<label>Service Centers</label>
							<select class="form-control" id="custom_service_center_ofstation"></select>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<button class="btn btn-primary" onclick="AbsoluteServiceCenterSelect()"><i class="fas fa-arrow-circle-right"></i> Select</button>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="step_1" style="display: none;">
<div class="row mb-2">
	<div class="col-sm-8">
		<h5><?php echo $_GET["station_full_name"]; ?> <small class="text-muted">Inventory Mode</small></h5>
	</div>
	<div class="col-sm-4">
		<button class="btn-success btn-sm m-0 btn float-right" data-toggle="modal" data-target="#modal_inventorysubmitssion"><i class="fas fa-check-circle"></i> Submit Inventory</button>
	</div>
</div>
<div class="row">
	<div class="col-sm-6">
		<!-- <p id="current_time"></p> -->
		<div class="alert alert-secondary" style="display: none" role="alert">
		  <h3 class="mt-3 mb-0" id="disp_time">9:46 am</h3>
		<h5 class="mb-3 mt-0" id="disp_date">Sunday March 12, 2020</h5>
		</div>
		
	
		  <div class="card mb-3">
		  	<div class="card-header">
		  		<button class="btn btn-sm btn-danger float-right" data-toggle="modal" data-target="#modal_changeassetlocationsource" id="chooseserv" onclick="OnSelect_ServiceCenterQuickInfo()"><i class="fas fa-sync"></i> Service Center</button>
				<h5 class="mt-0 "><strong class="text-dark curr_roomname"></strong></h5>
				<p class="mb-0"><span class="mb-0" id="curr_roomnumber">Room: <strong>...</strong></span> / <span class="mb-0">In-charge: <strong id="curr_roomincharge">...</strong></span></p>
		  	</div>
		  	<div class="card-body">
				<h5 class="mt-0">Property / Stock Number</h5>
				<div class="form-group" style="height: 50px; display: block; width: 100%;">
					 <span class="deleteicon">
				<input type="text" autocomplete="off" class="form-control form-control-lg" id="inp_qrfocus" placeholder="Scan Result" name="">
				 <span onclick="$('#inp_qrfocus').val(''); $('#inp_qrfocus').focus();"></span>
				 </span>

				</div>
		<label class="float-left mt-2"><input type="checkbox" id="inp_autorecieve" name=""> Auto-Recieve</label>
		<button class="btn btn-primary float-right" id="btn_addtoinventory"><i class="fas fa-plus-circle"></i> Add to <span class="curr_roomname"></span></button>
		  	</div>
		  </div>

		  <div id="errorlogscontainer">
		  		
		  	</div>
		
		<div class="form-group mt-3" style="display: none;">
			<label>Raw Data Preview</label>
			<textarea id="rawdatatext" rows="15" style="widows: 100%;" class="form-control" disabled=""></textarea>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="card-deck">
			<div class="card " style="border : none !important; border-radius: 0px !important;" onclick="filtershow_all()">
				<div class="clickablething ff_all" style="border: 2px solid transparent; border-radius: 10px;">
					<div class="card-body">
						<h5 class="m-0 float-right" ><span id="allscannedassets"></span>/<span id="allscannedassets_max"></span></h5>
				<small><span class="text-muted">All</span></small>
				<progress id="prog_all" style="width: 100%;" value="34" max="100">
			</div>
				</div>
		</div>
		<div class="card" style="border : none !important; border-radius: 0px !important;" onclick="filtershow_co()">
			<div class="clickablething ff_co" style="border: 2px solid transparent; border-radius: 10px;">
				<div class="card-body">
					<h5 class="m-0 float-right"><span id="allscannedassets_capitaloutlay"></span>/<span id="allscannedassets_capitaloutlay_max"></span></h5>
				<small><i class="fas fa-circle" style="color: #4EDD57;"></i> <span class="text-muted">CO</span></small>
				
				<progress id="prog_co" style="width: 100%;" value="22" max="100">
			</div>
			</div>
		</div>
		<div class="card" style="border : none !important; border-radius: 0px !important;" onclick="filtershow_se()">
			<div class="clickablething ff_se" style="border: 2px solid transparent; border-radius: 10px;">
				<div class="card-body">
					<h5 class="m-0 float-right"><span id="allscannedassets_semiexpendable"></span>/<span id="allscannedassets_semiexpendable_max"></span></h5>
				<small><i class="fas fa-circle" style="color: #FF3530;"></i> <span class="text-muted">SE</span></small>
				
				<progress id="prog_se" style="width: 100%;" value="67" max="100">
			</div>
			</div>
		</div>
		</div>
		<div class="card  mt-3">
			<div class="card-header" style="display: none">
				<div class="card-deck">
			<div class="card" style="display: none;">
				<div class="card-body">
					<span class="text-muted">Overall</span>
					<h4 class="mb-0" id="item_count_scanned">0</h4>
				</div>
			</div>
		</div>
			</div>
			<div class="card-body announcement_card_body" style="padding:0; background-color: #E9ECEF !important;" >	
				<div id="asset_data_reflection" style="background-color: #E9ECEF !important; margin: 20px;">

					<div class="mt-5 mb-5">
						<center>
							<h4 class="text-muted">Scanned asset will appear here.</h4>
						</center>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
</div>
<div id="step_2" style="display: none;">
	<div class="container">
		<div class="mb-5" style="margin-top: 20vh;">
		<h1 class="text-primary float-right" id="trans_percentage">34%</h1>
		<h3><i class="fas fa-save"></i> Saving your inventory data</h3>
		<p class="text-muted">Please don't leave this page while the saving process is running...</p>
		<progress value="45" max="100" id="trans_progress" style="width: 100%;"></progress>
		<button class="btn btn-secondary float-right mt-3" onclick="SaveData_Cancel()">Cancel</button>
		<div class="text-muted" id="visual_data_representation">
			
		</div>
	</div>
	</div>
</div>

<div id="step_3" style="display: none;">
	<div class="container">
		<div class="mb-5" style="margin-top: 20vh;">
		<h3><i class="fas fa-check-circle"></i> Submission Complete</h3>
		<p class="text-muted">Thank you for submitting us your inventory data.</p>
		<a class="btn btn-success mt-5" href="{{ route('asset_scanned') }}">Finish</a>
	</div>
	</div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="modal_changeassetlocationsource" >
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Select Service Center</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
      	<div class="col-md-12">
      		  <div class="form-group">
        	<label>Service Center</label>
        	<select autocomplete="off" required="" id="toloadservicecenters" class="form-control form-control-lg" onchange="OnSelect_ServiceCenterQuickInfo()"></select>
        </div>
      	</div>
      </div>
        <h5 class="m-0 ">Room Information</h5>
        <p class="m-0 mb-4"><span class="text-muted">Person In-charge:</span> <span id="prev_incharge" >...</span></p>
        <div class="card-deck">
        <div class="card">
        	<div class="card-header">
        		<span class="float-right badge badge-danger" ><span id="prev_totalscannedasset"></span>/<span id="prev_totalscannedasset_max"></span></span>
        		<p class="m-0 text-muted  ">Total Scanned Asset</p>
        	</div>
        	<div class="card-body">
        		<div class="row">
        			<div class="col-sm-6">
        				<p class="m-0 text-muted" title="Capital Outlay">Capital Outlay </p>
        		<h6 ><span id="prev_capitaloutlay"></span>/<span id="prev_capitaloutlay_max"></span></h6>
        			</div>
        			<div class="col-sm-6">
        				<p class="m-0 text-muted" title="Semi-Expendable">Semi-Expendable </p>
        		<h6 ><span id="prev_semiexpendable"></span>/<span id="prev_semiexpendable_max"></span></h6>
        			</div>
        		</div>
        	</div>
        </div>	
        <div class="card">
        	<div class="card-body">
        		<p class="m-0 text-muted">Last Scan Time</p>
        		<h6 id="prev_lastscantime">...</h6>
        		<p class="m-0 text-muted">Recent Item</p>
        		<h6 id="prev_lastscanitem">...</h6>
        	</div>
        </div>	
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="chlocbtn" onclick="GetRoomInformationByID(false)" data-dismiss="modal"><i class="fas fa-sync-alt"></i> Change Service Center</button>
      </div>
    </div>
  </div>
</div>


<div class="modal" tabindex="-1" role="dialog" id="modal_inventorysubmitssion">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Submit Inventory</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>All scanned assets will be stored in your inventory. Are you sure you want to submit all of your data now?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="SaveData_Start()" data-dismiss="modal"><i class="fas fa-check-circle"></i> Submit Inventory</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
	$("#chooseserv").hide();
	$("#inp_qrfocus").focus();
	var current_location_id = "";
	var separator_word = "<|next|>";
	var col_XX = "<|and|>";
	var current_timestamp = "";
	var current_station_id = <?php echo json_encode($_GET["station_id"]); ?>;
	var current_station_fullname = <?php echo json_encode($_GET["station_full_name"]); ?>;
	var current_room_name = "";
	var current_room_incharge = "";
	var current_time_good = "";
	var active_filter = "all";

	var ref_max_co = 0;
	var ref_max_se = 0;
	var current_co_count =0;
	var current_se_count =0;

	var currently_transfered = 0; 
	var transfercount =0;

	var iscomplete = false;

	var isauto_recieve = false;
	var currentlyready = "";
	var col_s_COUNT = "<|count|>";
	var sessioned_data = "";

	var timer = 0;
	$("#inp_qrfocus").keyup(async function(){
		 if(isauto_recieve ){
		 	
	if($("#inp_qrfocus").val() != ""){
		await x_timer(500);
			clearTimeout (timer);
	        timer = setTimeout(function(){
	        	AddToInv();
	        }, 1000);
		}
		 }
	})


	CheckLastSession();

	function CheckLastSession(){
		$("#step_0").show();
		$.ajax({
			type:"POST",
			url: "{{ route('stole_last_session') }}",
			data: {_token: "{{ csrf_token() }}"},
			success : function(data){
				// alert(data);
				$("#step_0").hide();
				if(data != "false"){
					data = data.split("<|SLICER|>");
					if(current_station_id == data[0]){
						sessioned_data = data;
						$("#session_restore").show();
					}else{
						// NOT STATION SO NORMAL
					CheckRediness();
					}
				}else{
					// NO SESSION SO NORMAL
					CheckRediness();
				}
				}	
		})
	}


	function SessionAbsoluteRestore(){
		$("#session_restore").hide();
		// RESTORE SESSION
		current_station_id = sessioned_data[0];
		$("#rawdatatext").html(sessioned_data[1]);
		current_station_fullname = sessioned_data[2];
		CheckRediness();
	}
	function SessionAbsoluteCancel(){
		$("#session_restore").hide();
		//NORMAL
		RemoveLastSessionInStation();
	}




	function RemoveLastSessionInStation(){
		$.ajax({
			type: "POST",
			url: "{{ route('shoot_remove_last_session') }}",
			data: {_token: "{{ csrf_token() }}"},
			success: function(data){
				CheckRediness();
			}
		})
	}

	function CheckRediness(){
	$.ajax({
  		type: "POST",
  		url: "{{ route('stole_checkready_specific') }}",
  		data: {_token: "{{ csrf_token() }}",user_school: current_station_id},
  		success:function(data){
  			// alert(data);
  			currentlyready = data;
  		
  			setTimeout(function(){
				ApplyScanningSettings();
  			},600)
  			setTimeout(function(){
				LoadAllLocations();
  			},800)
  		}
  	})
}

	
	$("#inp_autorecieve").change(function(){
		ApplyScanningSettings();
	})
	function ApplyScanningSettings(){
		isauto_recieve = $("#inp_autorecieve").prop("checked");

		if(isauto_recieve){
			$("#btn_addtoinventory").hide();
			if ($("#inp_qrfocus").val() != "") {
				AddToInv();
		}
		}else{
			$("#btn_addtoinventory").show();
		}
		$("#inp_qrfocus").focus();
	}

	function SaveData_Cancel(){
		$("#step_2").hide();
		$("#step_1").show();
	}
	function SaveData_Start(){
		if($("#rawdatatext").val() != "" && $("#rawdatatext").val() != null){
			$("#step_2").show();
			$("#step_1").hide();
			RunDataSavingProcess();
		}else{
			AddToErrorLogs("No inventory data to send. Your inventory data is empty.");
		}
	}
	function AddToErrorLogs(error_message, silent = false){
		if(silent == false){
			if(isauto_recieve == false){
				alert(error_message);
			}
		}
		$("#errorlogscontainer").prepend("<div class='card mb-3 addcard_anim'><div class='card-body'><span class='text-muted'>" + current_time_good + "</span><br>" + htmlEntities(error_message) + "</div></div>");
		if(isauto_recieve == true){
				$("#inp_qrfocus").focus();
			}
	}
	var savetime = 1000;

var loaded_data_pausetime =0;
	async function RunDataSavingProcess(){

		var currentdata = $("#rawdatatext").val();
		var data_fragment = currentdata.split(separator_word);
		var totalscannedasset = data_fragment.length;

		$("#visual_data_representation").html("");
		$("#trans_percentage").html("0%");
		$("#trans_progress").prop("max",totalscannedasset);
		$("#trans_progress").val(transfercount);

		for(var i = 0; i < totalscannedasset;i++){
			// location id,code,timestamp, item name, asset type, gorg timestamp
			if(data_fragment[i] != ""){
var single_data = data_fragment[i].split(col_XX);
				var ss_locationid = single_data[0];
				var ss_assetcode = single_data[1];
				var ss_timestamp = single_data[2];
				var ss_asset_name = single_data[3];
				var ss_assettype = single_data[4];
		if(loaded_data_pausetime < 100){
			await x_timer(315);
			AddDataOnline(ss_locationid,ss_assetcode,ss_timestamp,ss_asset_name,ss_assettype);
			loaded_data_pausetime++;
		}else{
			await x_timer(1000);
			// alert("pausetime");
			AddDataOnline(ss_locationid,ss_assetcode,ss_timestamp,ss_asset_name,ss_assettype);
			loaded_data_pausetime = 0;
		}

			}
		}
	}


	function AddDataOnline(ss_locationid,ss_assetcode,ss_timestamp,ss_asset_name,ss_assettype){
		// setTimeout(function(){

		if(currentlyready.includes(ss_assettype)){
			$.ajax({
			type:"POST",
			url:"{{ route('shoot_submit_scanned_data') }}",
			data: {
				_token: "{{ csrf_token() }}",
				loc_id: ss_locationid,
				ass_cd: ss_assetcode,
				timesp: ss_timestamp,
				ass_type: ss_assettype,
				stationid: current_station_id,
				asset_name: ss_asset_name
			},success: function(data){
				transfercount++;
				Revisualize_percentage_transferUI();
				$("#visual_data_representation").prepend("<span class='addtext_anim'>(" + ss_assettype + ") " + ss_assetcode + " -> " + ss_asset_name + " <i class='fas fa-check-circle'></i><span><br>");
				savetime -= 333;
			}
			})	
		}else{
				transfercount++;
				Revisualize_percentage_transferUI();
				$("#visual_data_representation").prepend("<span class='addtext_anim text-danger'>(" + ss_assettype + ") " + ss_assetcode + " -> " + ss_asset_name + " <i class='fas fa-check-circle'></i><span><br>");		
		}
		// },savetime)
		// savetime += 555;
	}
	function x_timer(ms) { return new Promise(res => setTimeout(res, ms)); }

	async function Revisualize_percentage_transferUI(){
		var currentdata = $("#rawdatatext").val();
		var data_fragment = currentdata.split(separator_word);
		var totalscannedasset = data_fragment.length;

		$("#trans_progress").prop("max",totalscannedasset);
		$("#trans_progress").val(transfercount);

		var percentage_value_trans = ((transfercount / totalscannedasset) * 100).toFixed(0) + "%";
		$("#trans_percentage").html(percentage_value_trans);

		if(percentage_value_trans == "100%"){
			//COMPLETE SUBMISSION SCREEN

			$("#step_2").hide();
			$("#step_1").hide();
			$("#step_3").show();


			if(iscomplete == false){
				await x_timer(355);
				$.ajax({
					type: "POST",
					url: "{{ route('shoot_clear_recovery_data') }}",
					data: {_token: "{{ csrf_token() }}"},
					success: function(data){
						// alert(data);
					}
				})
			}
			iscomplete = true;
			

		}
	}
	
	async function OnSelect_ServiceCenterQuickInfo(){
		await x_timer(351);
		$("#toloadservicecenters").prop("disabled",true);
		$("#chooseserv").hide();
		$("#chlocbtn").hide();
		var idof_servicecenter = $("#toloadservicecenters").val();
		$.ajax({
			type:"POST",
			url: "{{ route('stole_single_service_center_data_byid') }}",
			data: {_token: "{{ csrf_token() }}",service_center_id: idof_servicecenter},
			success: function(data){
					
				data = JSON.parse(data);
				// display in-charge
				if(data[0]["username"] != "" && data[0]["username"] != null){
					$("#prev_incharge").html(data[0]["username"]);
				}else{
					$("#prev_incharge").html("<span class='text-muted'>(not set)</span>");
				}
				var currentdata = $("#rawdatatext").val();
				var data_fragment = currentdata.split(separator_word);
				var allscanned =0;
				var co_count =0;
				var se_count=0;
				var last_scannedtime = "n/a";
				var last_scannedasset = "n/a";
				for(var i = 0; i < data_fragment.length;i++){
					// location id,code,timestamp, item name, asset type, gorg_timestamp
					if(data_fragment[i] != ""){
					var single_data = data_fragment[i].split(col_XX);
					if(single_data[0] == $("#toloadservicecenters").val()){
					allscanned++;
					var newdt = "";
					var colour_head = "";
					var classname = "";
					if(single_data[4] == "co"){
					co_count ++;
					}else{
					se_count ++;
					}
					last_scannedtime = single_data[5];
					var sc_code = single_data[3].split(col_s_COUNT);
					last_scannedasset = sc_code[0];
				}}
				}
				$("#prev_capitaloutlay").html(co_count);
				$("#prev_semiexpendable").html(se_count);
				$("#prev_totalscannedasset").html(allscanned);
				RunPreviewOfMaxValIn_servicecenters($("#toloadservicecenters").val());
				$("#prev_lastscantime").html(last_scannedtime);
				$("#prev_lastscanitem").html(last_scannedasset);

			}
		})
	}

	async function RunPreviewOfMaxValIn_servicecenters(prev_service_center_id){
		await x_timer(351);
		$.ajax({
			type:"POST",
			url: "{{ route('stole_get_max_values_of_CoSe') }}",
			data: {_token: "{{ csrf_token() }}",sta_id: current_station_id,service_centerid: prev_service_center_id},
			success: function(data){
				data = data.split(",");
				$("#prev_totalscannedasset_max").html((parseInt(data[0]) + parseInt(data[1])));
				$("#prev_capitaloutlay_max").html( data[0]);
				$("#prev_semiexpendable_max").html(data[1]);
			
				$("#toloadservicecenters").prop("disabled",false);
				$("#chooseserv").show();
				$("#chlocbtn").show();
			
			}
		})
	}
	$(window).bind('beforeunload', function(){
		if($("#rawdatatext").val() != "" && $("#rawdatatext").val() != null){
			if(iscomplete == false){
				return 'All your scanned data will be lost if not submitted.';
			}
		}
	});
	setInterval(function(){

	$("#prog_all").prop("max",(parseInt(ref_max_co) + parseInt(ref_max_se)));
	$("#prog_co").prop("max",ref_max_co);
	$("#prog_se").prop("max",ref_max_se);

	$("#prog_all").val(parseInt(current_co_count) + parseInt(current_se_count));
	$("#prog_co").val(current_co_count);
	$("#prog_se").val(current_se_count);

	var date = new Date();
	date = convertTZ(date, "Asia/Manila");

	var year = date.getFullYear();
	var month = date.getMonth() + 1;
	var day = date.getDate();
	var hours = date.getHours();
	var minutes = date.getMinutes();
	var seconds = date.getSeconds();


	var am_or_pm = "";

	if(hours >= 12){ am_or_pm = "pm";}else{am_or_pm = "am";}

	current_timestamp = year + "-" + month + "-" + day + " " + hours + ":" + minutes + ":" + seconds;
	current_time_good = parseInt(hours / 12) + ":" + minutes + ":" + seconds + " " + am_or_pm;
	$("#disp_time").html(current_time_good);

	var m_name = new Array();

	m_name[0] = "January";
	m_name[1] = "February";
	m_name[2] = "March";
	m_name[3] = "April";
	m_name[4] = "May";
	m_name[5] = "June";
	m_name[6] = "July";
	m_name[7] = "August";
	m_name[8] = "September";
	m_name[9] = "October";
	m_name[10] = "November";
	m_name[11] = "December";

	var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
	var dayName = days[date.getDay()];

	$("#disp_date").html(m_name[(month - 1)] + " " + day + " " + year + ", " + dayName);

	},500);


	function convertTZ(date, tzString) {
    return new Date((typeof date === "string" ? new Date(date) : date).toLocaleString("en-US", {timeZone: tzString}));   
}
	
	function LoadAllLocations(){

		$("#select_service_center_page").show();
		$("#step_1").hide();

		$.ajax({
			type:"POST",
			url: "{{ route('stole_getallservicecenters') }}",
			data: {_token: "{{ csrf_token() }}",station_id: current_station_id},
			success: function(data){
				// alert(data);
				$("#toloadservicecenters").html(data);
				$("#custom_service_center_ofstation").html(data);
				// Store current service center ID in variable
				
			}
		})
	}

	function AbsoluteServiceCenterSelect(){
		$("#select_service_center_page").hide();
		current_location_id = $("#custom_service_center_ofstation").val();
		$("#toloadservicecenters").val(current_location_id);
		GetRoomInformationByID();
		$("#step_1").show();
	}

	var selected_location_info = "";
	 function GetRoomInformationByID(is_silent = true){

		current_location_id = $("#toloadservicecenters").val();
		$.ajax({
			type:"POST",
			url: "{{ route('stole_single_service_center_data_byid') }}",
			data: {_token: "{{ csrf_token() }}",service_center_id: current_location_id},
			success:async function(data){
				// alert(data);
				data = JSON.parse(data);
				if(data.length != 0){
					// Apply in UI
					selected_location_info = data;
					ApplySelectedLocationInfoToUI();
					await x_timer(351);
					GetMaxValues();
					if(is_silent == false){
						alert("Service Center successfully selected!");
						$("#inp_qrfocus").focus();
					}
				}else{
					AddToErrorLogs("Problem in getting service center info. No service center selected.");
				}
			}
		})
	}

	function GetMaxValues(){
		$.ajax({
			type:"POST",
			url: "{{ route('stole_get_max_values_of_CoSe') }}",
			data: {_token: "{{ csrf_token() }}",sta_id: current_station_id,service_centerid: current_location_id},
			success: function(data){
				data = data.split(",");
				ref_max_co = data[0];
				ref_max_se = data[1];

				$("#allscannedassets_max").html((parseInt(ref_max_co) + parseInt(ref_max_se)));
				$("#allscannedassets_capitaloutlay_max").html(ref_max_co);
				$("#allscannedassets_semiexpendable_max").html(ref_max_se);
$("#chooseserv").show();
			}
		})
	}


	function ApplySelectedLocationInfoToUI(){
		$(".curr_roomname").html(selected_location_info[0]["office"]);
		$("#curr_roomnumber").html("Room: <strong>" + selected_location_info[0]["room_number"] + "</strong>");
		if(selected_location_info[0]["username"] == null || selected_location_info[0]["username"] == ""){
			$("#curr_roomincharge").html("<span class='text-muted'>(not yet assigned)</span>");
		}else{
			$("#curr_roomincharge").html(selected_location_info[0]["username"]);
		}
		current_room_name = selected_location_info[0]["office"];
		current_room_incharge = selected_location_info[0]["username"];
		ReflectDataToHTML();
	}

	$("#btn_addtoinventory").click(function(){
		AddToInv();
	})

	 function AddToInv(){
		$("#inp_qrfocus").prop("disabled",true);
		var data_code =  htmlEntities($("#inp_qrfocus").val());
		data_code = data_code.trim();
		if(data_code != ""){
			if(current_location_id != ""){
				if(CheckIfAssetCodeIsExisiting(data_code) == false){

					AddCodeToRawData(data_code);
				}else{
					AddToErrorLogs("You already scanned this code(" + data_code + ").");
					$("#inp_qrfocus").prop("disabled",false);
					$("#inp_qrfocus").focus();
					
				}
			}else{
				AddToErrorLogs("No service center selected.");
				$("#inp_qrfocus").prop("disabled",false);
			
			}
			
		}else{
			AddToErrorLogs("Can't insert an empty inventory data.");
			$("#inp_qrfocus").prop("disabled",false);
			$("#inp_qrfocus").focus();
			
		}
		$("#inp_qrfocus").val("");

	}
	 function AddCodeToRawData(newdata){
		 $("#inp_qrfocus").prop("placeholder","Proccessing....");
		var currentdata = $("#rawdatatext").val();
		if(currentdata != "" && currentdata != null){
			//Add if has existing data
			currentdata += separator_word;
		}
		
		// GET SCANNED CODE INRMATION IF HAS EXISTING REFERENCE IN REGISTRY
		var current_moreinfo = "";

		$.ajax({
			type:"POST",
			url: "{{ route('stole_scanned_item_details') }}",
			data: {_token: "{{ csrf_token() }}",
				sta_id: current_station_id,
				scanned_cod: newdata,
				location_id: current_location_id},
			success: function(data){
				current_moreinfo = JSON.parse(data);
				if(current_moreinfo.length !=0){
				// BUILD DATA IF REFERENCE IS EXISTING-----
				// location id,code,timestamp,item name, asset type, gorg_timestamp

				var asset_type = "";
				var asset_name = "";
				var result = "";
				if(current_moreinfo[0]["property_number"]){
					asset_type = "co";
					asset_name = current_moreinfo[0]["asset_item"];
				}else{
					result = prompt("Enter Semi-Expendable Item Quantity");
					asset_type = "se";
					asset_name = current_moreinfo[0]["description"];
				}

				
				var semi_count_sep = col_s_COUNT;
				// Pass data
				var goodtogo = false;
				if(asset_type == "se" && isNumeric(result) && result != ""){
					// good semi-expendable data
					if(parseInt(result) >= 1){
						goodtogo = true;
					}else{
						AddToErrorLogs("Given quantity to Semi-Expendable (" + htmlEntities(newdata) + ") can't be less than 1.");
					}
				}else if(asset_type == "se" && (isNumeric(result) == false || result == "")){
					// bad semi-expendable data
					AddToErrorLogs("Semi-Expendable (" + htmlEntities(newdata) + ") given quantity is invalid.");
				}else if(asset_type == "co"){
					//good capital outlay data
					result = "";
					goodtogo = true;
					semi_count_sep = "";
				}

				currentdata += current_location_id + col_XX +
				newdata + col_XX +
				current_timestamp + col_XX +
				asset_name + semi_count_sep + result + col_XX +
				asset_type + col_XX +
				current_time_good;

				if(goodtogo){
					$("#rawdatatext").val(currentdata);
				}

				filtershow_all();
				}else{
				// REFERENCE NOT FOUND
				AddToErrorLogs("Reference not found in asset registry. Make sure you are on the right service center and this asset(" + newdata  + ") is in the registry.");
				}

				$("#inp_qrfocus").val("");
				setTimeout(function(){
				$("#inp_qrfocus").prop("disabled",false);
				$("#inp_qrfocus").prop("placeholder","Scan Result");
				ReflectDataToHTML();
				$("#inp_qrfocus").focus();
				SaveSession();
				},300);

			}
		})
		
	}
	function SaveSession(){
		var current_raw = $("#rawdatatext").val();
		$.ajax({
			type:"POST",
			url: "{{ route('shoot_save_last_session') }}",
			data: {_token: "{{ csrf_token() }}",
					stationid: current_station_id,
					rawdata:current_raw,
					user_last_schoolname:current_station_fullname},
			success: function(data){
				// alert(data);
			}
		})
	}

	function isNumeric(num){
		return !isNaN(num)
	}
	function CheckIfAssetCodeIsExisiting(asset_code){
		var existing = false;
		var currentdata = $("#rawdatatext").val();
		var data_fragment = currentdata.split(separator_word);
		var totalscannedasset = data_fragment.length;

		for(var i = 0; i < totalscannedasset;i++){
			// location id,code,timestamp, item name, asset type
			if(data_fragment[i] != ""){
			var single_data = data_fragment[i].split(col_XX);

			if(single_data[4] == "co"){
				//CAPITAL
				if(single_data[1] == asset_code){
					existing = true;
				}
			}else{
				//SEMI 
				if(single_data[0] == current_location_id){
					if(single_data[1] == asset_code){
						existing = true;
					}
				}
			}
			}
		}
		return existing;
	}

	function ReflectDataToHTML(){
		$("#asset_data_reflection").html("");
		var currentdata = $("#rawdatatext").val();
		var data_fragment = currentdata.split(separator_word);
		var totalscannedasset = data_fragment.length;
		if(currentdata != "" && currentdata != null){
			$("#item_count_scanned").html(totalscannedasset);
		}else{
			$("#item_count_scanned").html("0");
		}
		
		var compiled_toadd = "";
		var allscanned =0;
		var co_count =0;
		var se_count=0;
		for(var i = 0; i < totalscannedasset;i++){
			// location id,code,timestamp, item name, asset type, gorg_timestamp
			if(data_fragment[i] != ""){
			var single_data = data_fragment[i].split(col_XX);

			if(single_data[0] == current_location_id){
				allscanned++;
				var newdt = "";
				var colour_head = "";
				var classname = "";
				if(single_data[4] == "co"){
					co_count ++;
					colour_head = "#4EDD57";
					classname = "cl_co";
				}else{
					se_count ++;
					colour_head = "#FF3530";
					classname = "cl_se";
				}

				newdt = "<div class='card announcement_card card-shadow mb-3 " + classname + "' style='border-top: 2px solid "+ colour_head + " !important;'>" + 
				"<div class='card-body'>"+ 
				"<span class='float-right text-muted' style='text-align: right;'>" + single_data[5] + "</span>" + 
				"<strong>" + single_data[1] + "</strong>" + 
				"<h6 class='mt-0 mb-0'>";


				if(single_data[4] == "se"){
					var se_name_fragments = single_data[3].split(col_s_COUNT);
					newdt +=  se_name_fragments[0] + " <span class='text-primary'>Quantity: " + se_name_fragments[1] + "</span>";
				}else{
					newdt +=  single_data[3];
				}
				newdt += "</h6>";




				if(!currentlyready.includes(single_data[4])){
					if(single_data[4] == "co"){
						newdt += "<p class='text-muted mt-4 mb-0'><i class='fas fa-exclamation-circle'></i> This Capital Outlay is not ready for inventory so this will be ignored.</p>";
					}else{
						newdt += "<p class='text-muted mt-4 mb-0'><i class='fas fa-exclamation-circle'></i> This Semi-Expendable is not ready for inventory so this will be ignored.</p>";
					}
				}
				newdt += "</div>" + 
				"</div>";
				// compiled_toadd = newdt + compiled_toadd;
				$("#asset_data_reflection").prepend(newdt);
			}
			}
		}

		$("#allscannedassets").html(allscanned);
		$("#allscannedassets_capitaloutlay").html(co_count);
		$("#allscannedassets_semiexpendable").html(se_count);

		current_co_count = co_count;
		current_se_count = se_count;

		if($("#asset_data_reflection").html() == ""){
			$("#asset_data_reflection").html('<div class="mt-5 mb-5">'+ 
				'<center>' +
							'<h4 class="text-muted">Scanned asset will appear here.</h4>' + 
						'</center>' + 
					'</div>');
		}
		switch(active_filter){
			case "all":
			filtershow_all();
			break;
			case "co":
			filtershow_co();
			break;
			case "se":
			filtershow_se();
			break;
		}
	}

	function reset_filteration_button(){
		$(".ff_all").css("border","2px solid transparent");
		$(".ff_co").css("border","2px solid transparent");
		$(".ff_se").css("border","2px solid transparent");
	}
	function filtershow_all(){
		active_filter = "all";
		reset_filteration_button();
		$(".cl_co").css("display","block");
		$(".cl_se").css("display","block");
		$(".ff_all").css("border","2px solid #007DFF");
	}
	function filtershow_co(){
		active_filter = "co";
		reset_filteration_button();
		$(".cl_co").css("display","block");
		$(".cl_se").css("display","none");
		$(".ff_co").css("border","2px solid #007DFF");
	}
	function filtershow_se(){
		active_filter = "se";
		reset_filteration_button();
		$(".cl_co").css("display","none");
		$(".cl_se").css("display","block");
		$(".ff_se").css("border","2px solid #007DFF");
	}
	function htmlEntities(str) {
	return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
	}



</script>


@endsection