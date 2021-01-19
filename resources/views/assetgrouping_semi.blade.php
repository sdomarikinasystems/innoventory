@extends('master.master')

@section('title')
Generate Appendix 66 Report
@endsection

@section('contents')

<h2>Generate Appendix 66 Report</h2>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb mb-3">
		<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('dboard') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('asset_scanned') }}">Inventory</a></li>
		<li class="breadcrumb-item active" aria-current="page">Generate Report</li>
	</ol>
</nav>

<div class="row">
	<div class="col-sm-6 mb-3">
		<a class="btn btn-success" onclick="FetchSelectedPropertyNumbers()" href="#"><i class="fas fa-layer-group"></i> Group Selected</a>
		<a class="btn btn-secondary" data-toggle="modal" data-target="#modal_printdoc" href="#"><i class="fas fa-print"></i> Print</a>
	</div>
</div>

<div class="row">
	<div class="col-sm-6 mb-3">
		<h5>Room Number: <strong id="rnumbhtml"></strong></h5>
        <h6><?php echo $_GET["my_category"]; ?></h6>
    </div>
	<div class="col-sm-6 mb-3">
	
	</div>
</div>

<table class="table table-hover table-bordered">
  <thead>
    <tr>
      <th scope="col">Select</th>
      <th scope="col">Asset Item</th>
      <th scope="col">Property Number</th>

      <th scope="col">Unit of Mesure</th>
      <th scope="col">Date of Aquisition</th>
      <th scope="col">Estimated Total Lifeyears</th>

      <th scope="col">Current Condition</th>
      <th scope="col">Asset Location</th>
      <th scope="col">Count</th>
    </tr>
  </thead>
  <tbody id="myfiltered">
    
  </tbody>
</table>


<form action="printdoc_a66" method="GET" target="_blank">
  {{ csrf_field() }}
  <div class="modal" tabindex="-1" role="dialog" id="modal_printdoc">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Print</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Print preview document report?</p>



        <input type="hidden" name="room_id" value="<?php echo $_GET['my_room']; ?>">
        <input type="hidden" name="roomnum" id="roonumreal" value="">
        <input type="hidden" name="assetactegory" value="<?php echo $_GET['my_category']; ?>">


        <!-- // ROOM DISPLAY INFORMATION --> 
        <input type="hidden" name="roomname" id="room_name" value="">


      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Continue Print</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
</form>


  <div class="modal" tabindex="-1" id="modalgroupitems" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Group Assets</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Group Name</label>
            <input type="text" class="form-control" placeholder="Type here..." id="group_name">
          </div>
          <div class="form-group">
            <label>Balance Per Card</label>
            <input type="number" value="0" class="form-control" placeholder="Type here..." id="group_bal_per">
          </div>
          <table class="table table-sm">
            <thead>
              <tr>
                <th>Property Number</th>
                <th>Asset Item</th>
              </tr>
            </thead>
            <tbody id="tbl_assets">
              
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" onclick="GroupAllSelectedDatum()" class="btn btn-primary">Group</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" tabindex="-1" id="ungroup_modal" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ungroup Items</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to ungroup these items?</p>
          <input type="hidden" id="inp_groupname">
           <input type="hidden" id="inp_groupnumber">
            <input type="hidden" id="inp_category">
        </div>
        <div class="modal-footer">
          <button type="button" onclick="UngroupItems()" class="btn btn-primary">Ungroup</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

<script type="text/javascript">
  var total_items_to_group = 0 ;
  var current_togroup = 0;
  var autoname = "";
  var room_numberreal = "";
GetRealRoomNumber();
  function GetRealRoomNumber(){
    $.ajax({
      type:"POST",
      url: "{{ route('stole_single_service_center_data_byid') }}",
      data: {_token: "{{ csrf_token() }}",service_center_id: <?php echo json_encode($_GET["my_room"]) ?>},
      success: function(data){
        // alert(data);
        data = JSON.parse(data);
        room_numberreal = data[0]["room_number"];
        $("#rnumbhtml").html(room_numberreal);
        $("#roonumreal").val(room_numberreal);
        $("#room_name").val(data[0]["office"]);
          LoadAssets();
      }
    })
  }
  function UngroupItems(){
     $("#ungroup_modal").modal("hide");
    var inp_groupname = $("#inp_groupname").val();
    var inp_groupnumber = $("#inp_groupnumber").val();
    var inp_category = $("#inp_category").val();

    $.ajax({
      type : "POST",
      url : "ung_ims",
      data : {_token: "{{ csrf_token() }}",groupname:inp_groupname,groupnumber:inp_groupnumber,category:inp_category},
      success: function(data){
       SignalReload();

      }
    })
  }

  function OpenUngroupItems(control_obj){
    $("#inp_groupname").val($(control_obj).data("gname"));
    $("#inp_groupnumber").val($(control_obj).data("rnum"));
    $("#inp_category").val($(control_obj).data("assclass"));
  }
  function SignalReload(){
    LoadAssets();
  }

  function LoadGroupedAssets(){
    $.ajax({
      type : "POST",
      url : "{{ route('viewassetgrouped') }}",
      data : {_token: "{{ csrf_token() }}",rnum:room_numberreal,catname:<?php echo json_encode($_GET["my_category"]) ?>,station_id:<?php echo json_encode($_GET["station_id"]); ?>},
      success : function(data){
        // alert(data);
        $("#myfiltered").append(data);
      }
    })
  }

  function GroupAllSelectedDatum(){
  current_togroup = 0;
  $("#modalgroupitems").modal("hide");
  
    if($("#group_name").val() != "" && $("#group_bal_per").val() != ""){
          
      $(".selected_datum").each(function(){
      $.ajax({
        type : "POST",
        url: "add_new_assgr",
        data: {_token:"{{ csrf_token() }}",ass_gname:$("#group_name").val(),ass_propnum:$(this).data("val"),ass_roomnum:room_numberreal,ass_assclass: <?php echo json_encode($_GET["my_category"]); ?>,ass_balpercard:$("#group_bal_per").val()},
        success: function(data){
          current_togroup ++;
          if(total_items_to_group == current_togroup){
        SignalReload();
          }
          $("#group_bal_per").val("0");
        }
      })
    })
    }else{
      alert("Please name this asset group first.");
    }
  }
  function FetchSelectedPropertyNumbers(){

    var id_of_conts_tovalidate = "";
    // CHECK IF ASSET IS VALID GROUPING TOGETHER
    var ccount =0;
   $('.asset_item_check[type="checkbox"]:checked').each(function() {
       if(ccount == 0){
        // ENCODE BASIS
         id_of_conts_tovalidate = $(this).data("dateofaq") + $(this).data("totlifey") + $(this).data("unitofmea");
        ccount++;
       }
    });

   var haserror = false;


   $('.asset_item_check[type="checkbox"]:checked').each(function() {
      
        // ENCODE BASIS
         var myidentity = $(this).data("dateofaq") + $(this).data("totlifey") + $(this).data("unitofmea");
         if(myidentity != id_of_conts_tovalidate){
          haserror = true;
         }
      
    });


   // PROCEED
   if(haserror){
    alert("Items can't be grouped because preferences does not match.");
   }else{
    $("#tbl_assets").html("");
    var countselection = 0;
    autoname = "";
    $('.asset_item_check[type="checkbox"]:checked').each(function() {
      countselection ++;

      if(autoname == ""){
        autoname = $(this).data("itemname");
      }
     $("#tbl_assets").append("<tr><td class='selected_datum' data-itemname='" + $(this).data("itemname") + "' data-val='" + $(this).data("propnum") + "'>" + $(this).data("propnum") + "</td><td>" + $(this).data("assetitem") + "</td></tr>");
    });
    total_items_to_group = countselection;
    if(countselection >= 2){

      $("#group_name").val(autoname);
      $("#modalgroupitems").modal("show");
    }else{
      alert("Selected value must be 2 or more.");
    }
   }
  }

  function LoadAssets(){
    $.ajax({
      type : "POST",
      url : "{{ route('lod_asset_filtered') }}",
      data: {_token:"{{ csrf_token() }}",rnum:room_numberreal,catname:<?php echo json_encode($_GET["my_category"]) ?>},
      success: function(data){
        $("#myfiltered").html(data);
        LoadGroupedAssets();
      }
    })
  }
</script>
@endsection