@extends('master.master')

@section('title')
Innoventory - Inventory Mode
@endsection

@section('contents')
<div id="step_1" style="display: block;">
	<button class="float-right btn-success btn" data-toggle="modal" data-target="#modal_inventorysubmitssion"><i class="fas fa-check-circle"></i> Submit Inventory</button>
<h4><?php echo $_GET["station_full_name"]; ?> <small class="text-muted">Inventory Mode</small></h4>
<br>
<div class="row">
	<div class="col-sm-6">
		<!-- <p id="current_time"></p> -->
		<div class="alert alert-secondary" style="display: none" role="alert">
		  <h3 class="mt-3 mb-0" id="disp_time">9:46 am</h3>
		<h5 class="mb-3 mt-0" id="disp_date">Sunday March 12, 2020</h5>
		</div>
		 <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
		  <li class="nav-item">
		    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Scanning</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Error Logs</a>
		  </li>

		</ul>
		<div class="tab-content" id="pills-tabContent">
		  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
		  <div class="card mb-3">
		  	<div class="card-body">
			<button class="btn btn-sm btn-danger float-right" data-toggle="modal" data-target="#modal_changeassetlocationsource" onclick="OnSelect_ServiceCenterQuickInfo()"><i class="fas fa-sync"></i></button>
				<h5>Service Center</h5>
				<div class="alert alert-secondary" role="alert">
				
				<h5 class="mt-0 "><strong class="text-dark curr_roomname"></strong></h5>
				<p class="mb-0"><span class="mb-0" id="curr_roomnumber">Room: <strong>...</strong></span> / <span class="mb-0">In-charge: <strong id="curr_roomincharge">...</strong></span></p>
				</div>
				<h5>QR Code Result</h5>
				<div class="form-group">
				<input type="text" autocomplete="off" class="form-control form-control-lg" id="inp_qrfocus" placeholder="Scan Result" name="">
				</div>
		
		<button class="btn btn-primary" id="btn_addtoinventory"><i class="fas fa-plus-circle"></i> Add To <span class="curr_roomname"></span></button>
		  	</div>
		  </div>
		  </div>
		  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
		  	<div id="errorlogscontainer">
		  		
		  	</div>
		  	
		  </div>
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
				<small><i class="fas fa-circle" style="color: #4EDD57;"></i> <span class="text-muted">Capital Outlay</span></small>
				
				<progress id="prog_co" style="width: 100%;" value="22" max="100">
			</div>
			</div>
		</div>
		<div class="card" style="border : none !important; border-radius: 0px !important;" onclick="filtershow_se()">
			<div class="clickablething ff_se" style="border: 2px solid transparent; border-radius: 10px;">
				<div class="card-body">
					<h5 class="m-0 float-right"><span id="allscannedassets_semiexpendable"></span>/<span id="allscannedassets_semiexpendable_max"></span></h5>
				<small><i class="fas fa-circle" style="color: #FF3530;"></i> <span class="text-muted">Semi-Expendable</span></small>
				
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

<div class="modal" tabindex="-1" role="dialog" id="modal_changeassetlocationsource" onclick="OnSelect_ServiceCenterQuickInfo()">
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
        <button type="button" class="btn btn-primary" onclick="GetRoomInformationByID(false)" data-dismiss="modal"><i class="fas fa-sync-alt"></i> Change Service Center</button>
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
			alert(error_message);
		}
		$("#errorlogscontainer").prepend("<div class='card mb-3'><div class='card-body'><span class='text-muted'>" + current_time_good + "</span><br>" + htmlEntities(error_message) + "</div></div>");
	}

	function RunDataSavingProcess(){

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

				AddDataOnline(ss_locationid,ss_assetcode,ss_timestamp,ss_asset_name,ss_assettype);
			}
		}
	}

	function AddDataOnline(ss_locationid,ss_assetcode,ss_timestamp,ss_asset_name,ss_assettype){
		$.ajax({
					type:"POST",
					url:"{{ route('shoot_submit_scanned_data') }}",
					data: {_token: "{{ csrf_token() }}",
							loc_id: ss_locationid,
							ass_cd: ss_assetcode,
							timesp: ss_timestamp,
							ass_type: ss_assettype,
							stationid: current_station_id
					},success: function(data){
						transfercount++;
						Revisualize_percentage_transferUI();
						$("#visual_data_representation").prepend("<span class='addtext_anim'>(" + ss_assettype + ") " + ss_assetcode + " -> " + ss_asset_name + " <i class='fas fa-check-circle'></i><span><br>");
					}
				})	
	}


	function Revisualize_percentage_transferUI(){
		var currentdata = $("#rawdatatext").val();
		var data_fragment = currentdata.split(separator_word);
		var totalscannedasset = data_fragment.length;

	
		$("#trans_progress").prop("max",totalscannedasset);
		$("#trans_progress").val(transfercount);

		var percentage_value_trans = ((transfercount / totalscannedasset) * 100).toFixed(0) + "%";
		$("#trans_percentage").html(percentage_value_trans);

		if(percentage_value_trans == "100%"){
			//COMPLETE SUBMISSION SCREEN
			iscomplete = true;
			$("#step_2").hide();
			$("#step_1").hide();
			$("#step_3").show();
		}
	}

	function OnSelect_ServiceCenterQuickInfo(){
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
					$("#prev_incharge").html("<span class='text-muted'>(no set)</span>");
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
					last_scannedasset = single_data[3];
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

	function RunPreviewOfMaxValIn_servicecenters(prev_service_center_id){
		$.ajax({
			type:"POST",
			url: "{{ route('stole_get_max_values_of_CoSe') }}",
			data: {_token: "{{ csrf_token() }}",sta_id: current_station_id,service_centerid: prev_service_center_id},
			success: function(data){
				data = data.split(",");
				$("#prev_totalscannedasset_max").html((parseInt(data[0]) + parseInt(data[1])));
				$("#prev_capitaloutlay_max").html( data[0]);
				$("#prev_semiexpendable_max").html(data[1]);

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
	LoadAllLocations();
	function LoadAllLocations(){
		$.ajax({
			type:"POST",
			url: "{{ route('stole_getallservicecenters') }}",
			data: {_token: "{{ csrf_token() }}",station_id: current_station_id},
			success: function(data){
				// alert(data);
				$("#toloadservicecenters").html(data);
				// Store current service center ID in variable
				current_location_id = $("#toloadservicecenters").val();
				GetRoomInformationByID();
			}
		})
	}

	var selected_location_info = "";
	function GetRoomInformationByID(is_silent = true){

		current_location_id = $("#toloadservicecenters").val();
		$.ajax({
			type:"POST",
			url: "{{ route('stole_single_service_center_data_byid') }}",
			data: {_token: "{{ csrf_token() }}",service_center_id: current_location_id},
			success: function(data){
				// alert(data);
				data = JSON.parse(data);
				if(data.length != 0){
					// Apply in UI
					selected_location_info = data;
					ApplySelectedLocationInfoToUI();
					GetMaxValues();
					if(is_silent == false){
						alert("Service Center successfully selected!");
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
				}
			}else{
				AddToErrorLogs("No service center selected.");
				$("#inp_qrfocus").prop("disabled",false);
			}
			
		}else{
			AddToErrorLogs("Can't insert an empty inventory data.");
			$("#inp_qrfocus").prop("disabled",false);
		}

		$("#inp_qrfocus").val("");
	})
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
			data: {_token: "{{ csrf_token() }}",sta_id: current_station_id,scanned_cod: newdata},
			success: function(data){
				current_moreinfo = JSON.parse(data);
				if(current_moreinfo.length !=0){
				// BUILD DATA IF REFERENCE IS EXISTING-----
				// location id,code,timestamp,item name, asset type, gorg_timestamp

				var asset_type = "";
				var asset_name = "";

				if(current_moreinfo[0]["property_number"]){
					// alert("Capital Outlay Item");
					asset_type = "co";
					asset_name = current_moreinfo[0]["asset_item"];
				}else{
					// alert("Semi-Expendable Item");
					asset_type = "se";
					asset_name = current_moreinfo[0]["description"];
				}

				currentdata += current_location_id + col_XX +
				newdata + col_XX +
				current_timestamp + col_XX +
				asset_name + col_XX +
				asset_type + col_XX +
				current_time_good;

				// Pass data
				$("#rawdatatext").val(currentdata);
				filtershow_all();
				}else{
				// REFERENCE NOT FOUND
				AddToErrorLogs("Reference not found in asset registry.\n\nCause: Not encoded in registry, Asset is encoded but contains discrepancies");
				}

				$("#inp_qrfocus").val("");
				setTimeout(function(){
				$("#inp_qrfocus").prop("disabled",false);
				$("#inp_qrfocus").prop("placeholder","Scan Result");
				ReflectDataToHTML();
				},300);

			}
		})
		
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
			// if(single_data[0] == current_location_id){
					if(single_data[1] == asset_code){
						existing = true;
					}
				// }
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
				"<h6 class='mt-0 mb-0'>" + single_data[3] + "</h6>" + 
				"</div>" + 
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