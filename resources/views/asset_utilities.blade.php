@extends('master.master')

@section('title')
Inno... - Utilities
@endsection

@section('contents')
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Home</li>
		<li class="breadcrumb-item active" aria-current="page">QR Stickers</li>
	</ol>
</nav>

<div class="card-deck mb-3">
	<div class="card">
		<div class="card-body">
			<a href="" class="float-right" data-toggle="modal" data-target="#modal_miss"><i class="fas fa-question-circle"></i></a>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
				<label>Service Center</label>
					<select class="form-control" onchange="LoadContentsbyservicecenter()" id="id_qrfilter">
					</select>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Asset Type</label>
					<select onchange="LoadContentsbyservicecenter()" class="form-control" id="asset_type">
						<option value="co" id="val_co">Capital Outlay</option>
						<option value="se" id="val_se">Semi-Expendable</option>
					</select>
				</div>
			</div>
		</div>
		</div>
		<div class="card-footer">
			<i class="fas fa-filter"></i> Filter
		</div>
	</div>
	<div class="card" id="startinginfo">
		<div class="card-body">	
			<h6>You can <strong>Check All</strong> to print all QR Stickers for your asset(s) or individually select and filter them.</h6>
		</div>
		<div class="card-footer">
			<i class="fas fa-tasks"></i> Check item(s) to Generate
		</div>
	</div>
	<div class="card" id="selectinginfo">
		<div class="card-body">
			<h5 id="selected_count"></h5>	
		</div>
		<div class="card-footer">
			<button class="btn btn-primary btn-sm" id="print"><i class="fas fa-qrcode"></i> Print to QR Stickers</button>
		</div>
	</div>
	

	
</div>

<div class="modal" tabindex="-1" role="dialog" id="modal_miss">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">More Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		  <p>LGU, Disposed asset(s), Missing Room Number and Service Center(s) are not included in your QR Generation Page.</p>
      </div>
    </div>
  </div>
</div>
<div class="row">
	<div class="col-sm-12 table-responsive">
		<div id="warning" style="display: none;">
			<div class="card">
				<div class="card-body">
					<h3 class="text-danger mt-4"><i class="fas fa-times"></i> <span id="asstypename"></span></h3>
					<p id="whattodo" class="mb-4"></p>
				</div>
				<div class="card-footer">
					<a class="btn btn-secondary" href="{{ route('assetregistry') }}">Fix Discrepancies</a>
				</div>
			</div>
		</div>
		<div id="thedistable">
			<table class="table table-hover table-bordered" id="tbl_ass">
		<thead>
			<tr>
				<th scope="col">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" onclick="toggle(this);" id="master_check">
						<label class="form-check-label" for="defaultCheck1">
							&nbsp;
							Check All
						</label>
					</div>
				</th>
				<th scope="col" width="150" id="tblhead_propnum">Property Number</th>
				<th scope="col" id="tblhead_assetitem">Asset Item</th>
				<th scope="col" id="tblhead_assclass">Asset Classification</th>
				<th scope="col" id="tblhead_currcond">Current Condition</th>
				<th scope="col" id="tblhead_servcent">Service Center</th>
				<th scope="col" id="tblhead_roomnum">Room</th>
			</tr>
		</thead>
		<tbody id="tbl_qrcontents">
		</tbody>
		</table>
		</div>
	</div>
</div>

<script type="text/javascript">
	setInterval(function(){
		var countofselected = 0;
		$('table tr').each(function(i) {
				    // Cache checkbox selector
				    var chkbox = $(this).find('input[class="form-check-input checkbox_y"]');

				    // Only check rows that contain a checkbox
				    if(chkbox.prop('checked') == true) {
				    	countofselected ++;
				    }
				});
		if(countofselected == 0){
			$("#selectinginfo").hide();
$("#startinginfo").show();

		}else{
			$("#selected_count").html("<i class='fas fa-print'></i> Print <strong>" + countofselected + "</strong> Visible Selected Asset(s)");
			$("#selectinginfo").show();
			$("#startinginfo").hide();
		}
		
	},100)
	var currentlyready = "";
	var hasfilterlocaded = false;
	LoadServiceCenterFilter();


	function LoadServiceCenterFilter(){
		$("#id_qrfilter").prop("disabled",true);
		$("#asset_type").prop("disabled",true);
		if(hasfilterlocaded == false){
			$.ajax({
			type:"POST",
			url: "{{ route('get_ser_of_sta_fo_fil') }}",
			data: {_token:"{{ csrf_token() }}"},
			success: function(data){
				$("#id_qrfilter").html(data);
				CheckRediness();

			}
		})
		}else{
				CheckRediness();
		}
		hasfilterlocaded = true;
	}
	function CheckRediness(){

		

	$.ajax({
		type: "POST",
		url: "{{ route('stole_checkready_specific') }}",
		data: {_token: "{{ csrf_token() }}",user_school: <?php echo json_encode(session("user_school")); ?>},
		success:function(data){
			// alert(data);
			currentlyready = data;
			LoadContentsbyservicecenter();
		}
	})
	}
	function LoadContentsbyservicecenter(){
		$("#thedistable").hide();

		$("#id_qrfilter").prop("disabled",true);
		$("#asset_type").prop("disabled",true);
		// alert("runned!");
		$("#master_check").prop("checked",false);
		var myval = $("#id_qrfilter").val().split("|");
		var ass_type = $("#asset_type").val();

		if(currentlyready.includes(ass_type)){
				$("#thedistable").show();
				$("#warning").hide();
				if(ass_type == "co"){
			// CAPITAL OUTLAY
			$("#tblhead_propnum").html("Property Number");
			$("#tblhead_assetitem").html("Asset Item");
			$("#tblhead_assclass").html("Asset Classification");
			$("#tblhead_currcond").html("Current Condition");
			$("#tblhead_servcent").html("Service Center");
			$("#tblhead_roomnum").html("Room");
		}else{
			// SEMI-EXPENDABLE
			$("#tblhead_propnum").html("Stock Number");
			$("#tblhead_assetitem").html("Description");
			$("#tblhead_assclass").html("Article");
			$("#tblhead_currcond").html("Unit of Mesure");
			$("#tblhead_servcent").html("Service Center");
			$("#tblhead_roomnum").html("Room");
		}
		$.ajax({
			type:"POST",
			url: "{{ route('Loadqrbyservicecen') }}",
			data: {_token:"{{ csrf_token() }}",
			service_center:myval[0],
			room_number:myval[1],
			asset_type: ass_type},
			success: function(data){
				// alert(data);
				  $("#tbl_ass").DataTable().destroy();
				$("#tbl_qrcontents").html(data);
				// $("#tbl_ass").DataTable();
				$('#tbl_ass').DataTable({  "bPaginate": false,"ordering":false});
				$("#id_qrfilter").prop("disabled",false);
				$("#asset_type").prop("disabled",false);
			}
		})
		}else{
			$("#thedistable").hide();
			$("#warning").show();

			if(ass_type == "co"){
				$("#asstypename").html("Capital Outlay");
				$("#whattodo").html("Please fix all discrepancies in your " + "Capital Outlay" + " assets in your Asset Registry page first before you generate QR Stickers.");
			}else{
				$("#asstypename").html("Semi-Expendable");
				$("#whattodo").html("Please fix all discrepancies in your " + "Semi-Expendable" + " assets in your Asset Registry page first before you generate QR Stickers.");
			}
setTimeout(function(){
	$("#id_qrfilter").prop("disabled",false);
				$("#asset_type").prop("disabled",false);
			},1000)
			
		}

		
	}
	function toggle(source) {
	var checkboxes = document.querySelectorAll('input[type="checkbox"]');
		for (var i = 0; i < checkboxes.length; i++) {
			if (checkboxes[i] != source)
		    	checkboxes[i].checked = source.checked;
		}
	}
	$('#print').click(function(){
		var arr1 = [];
		$('table tr').each(function(i) {
		    // Cache checkbox selector
		    var chkbox = $(this).find('input[class="form-check-input checkbox_y"]');

		    // Only check rows that contain a checkbox
		    if(chkbox.prop('checked') == true) {
		    	// console.log(chkbox.data('propno'));
				arr1.push(chkbox.data('propno'));
		    }
		});
		if(arr1.length == 0) {
			alert("Please select and asset first before you print QR Stickers!");
		} else {
			localStorage.setItem('pnumber_arr', JSON.stringify(arr1));
			window.open('{{ route("pr_asset") }}?ass_type=' + $("#asset_type").val() + '&locationinfo=' + $("#id_qrfilter").val(), '_blank'); // <- This is what makes it open in a new window.
		}
	})
</script>

@endsection