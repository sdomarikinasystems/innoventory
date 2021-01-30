@extends('master.master')
@section('title')
Generate Appendix 73 Report
@endsection
@section('contents')
<nav aria-label="breadcrumb">
	<ol class="breadcrumb mb-3">
		<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('dboard') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('asset_scanned') }}">Inventory</a></li>
		<li class="breadcrumb-item active" aria-current="page">Generate Appendix 73 Report</li>
	</ol>
</nav>
<div class="card-deck mb-4">
  <div class="card card-shadow">
    <div class="card-body">
    <p class="text-muted m-0 mb-2">Category</p>
      <h5 class="m-0"><?php echo $_GET["my_category"]; ?></h5>
    </div>
  </div>
  <div class="card card-shadow">
    <div class="card-body">
      <p class="text-muted m-0 mb-2">Service Center</p>
      <h5 class="m-0"><span id="rnumbhtml"></span></h5>
    </div>
  </div>
  <div class="card card-shadow">
    <div class="card-body">
      <p class="text-muted m-0 mb-2">Actions</p>
      <a class="btn btn-success btn-sm" onclick="FetchSelectedPropertyNumbers()" href="#"><i class="fas fa-layer-group"></i> Group Selected</a>
    <a class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal_printdoc" href="#"><i class="fas fa-print"></i> Print</a>
    </div>
  </div>
</div>
 <div class="xload" style="display: none;" id="loadgdata">
    <div class="container">
    <div style="margin:auto; width: 540px; margin-top: 35vh; ">
      <div class="card card-shadow">
        <div class="card-body">
          <div class="mt-4 mb-4">
            <h4 id="percentagecounter" class="float-right text-primary"></h4>
    <h4 ><img src="https://uploads.toptal.io/blog/image/122385/toptal-blog-image-1489082610696-459e0ba886e0ae4841753d626ff6ae0f.gif" style="width: 30px; margin-right: 10px;">Grouping Asset(s)</h4>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
<table class="table table-hover table-bordered">
  <thead>
    <tr>
      <th scope="col">Select</th>
      <th style="width: 20%;">Asset Item</th>
      <th style="width: 20%;">Property Number</th>
      <th scope="col">Unit of Mesure</th>
      <th style="width: 20%;">Date of Aquisition</th>
      <th >Cost of Acquisition</th>
      <th style="width: 20%;">Current Condition</th>
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
        <input type="hidden" id="htinp_invyear" name="inv_year">
        <input type="hidden" id="htinp_invmonth" name="inv_month">
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

          <div class="row">
            <div class="col-lg-6">
               <div class="form-group">
            <label>Group Name</label>
            <input type="text" class="form-control" placeholder="Type here..." id="group_name">
          </div>
            </div>
             <div class="col-lg-6">
              <div class="form-group">
            <label>Balance Per Card</label>
            <input type="number" value="0" class="form-control" placeholder="Type here..." id="group_bal_per">
          </div>
            </div>
          </div>
         
          
          <table class="table table-bordered">
            <thead>
              <tr>
                 <th>#</th>
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
            <input type="hidden" id="inp_unik">
        </div>
        <div class="modal-footer">
          <button type="button" onclick="UngroupItems()" class="btn btn-primary">Ungroup</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

 

<script type="text/javascript">
  var g_invyear = <?php echo json_encode($_GET["inv_year"]); ?>;
  var g_invmonth = <?php echo json_encode($_GET["inv_month"]); ?>;
  $("#htinp_invyear").val(g_invyear);
  $("#htinp_invmonth").val(g_invmonth);
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
        $("#rnumbhtml").html(data[0]["office"] + "(" + room_numberreal + ")");
        $("#roonumreal").val(room_numberreal);
        $("#room_name").val(data[0]["office"]);
          LoadGroupedAssets();
      }
    })
  }
  function UngroupItems(){
     $("#ungroup_modal").modal("hide");
    var inp_groupname = $("#inp_groupname").val();
    var inp_groupnumber = $("#inp_groupnumber").val();
    var inp_category = $("#inp_category").val();
    var inp_unik = $("#inp_unik").val();
    $.ajax({
      type : "POST",
      url : "{{ route('ungroup_items') }}",
      data : {_token: "{{ csrf_token() }}",groupname:inp_groupname,groupnumber:inp_groupnumber,category:inp_category,idunik: inp_unik},
      success: function(data){
       SignalReload();

      }
    })
  }
  function OpenUngroupItems(control_obj){
    $("#inp_groupname").val($(control_obj).data("gname"));
    $("#inp_groupnumber").val($(control_obj).data("rnum"));
    $("#inp_category").val($(control_obj).data("assclass"));
    $("#inp_unik").val($(control_obj).data("unik"));
  }
  function SignalReload(){
    LoadGroupedAssets();
  }
 function timer(ms) { return new Promise(res => setTimeout(res, ms)); }
  function GroupAllSelectedDatum(){
    if($("#group_bal_per").val() > 0){
var unik_id = IDGenerator();
  current_togroup = 0;
  $("#modalgroupitems").modal("hide");
  
    if($("#group_name").val() != "" && $("#group_bal_per").val() != ""){
          
      $(".selected_datum").each(async function(){
         $("#loadgdata").css("display","block");
        await timer(256);
      $.ajax({
        type : "POST",
        url: "{{ route('add_new_asset_group') }}",
        data: {_token:"{{ csrf_token() }}",ass_gname:$("#group_name").val(),ass_propnum:$(this).data("val"),ass_roomnum:room_numberreal,ass_assclass: <?php echo json_encode($_GET["my_category"]); ?>,ass_balpercard:$("#group_bal_per").val(),
        inv_year:g_invyear,
        inv_month:g_invmonth,
        unikid: unik_id},
        success:  async function(data){
  await timer(256);
          current_togroup ++;
          if(total_items_to_group == current_togroup){
            SignalReload();
              $("#loadgdata").css("display","none");
          }
          $("#group_bal_per").val("0");
        
        }
      })
    })
    }else{
      alert("Please name this asset group first.");
    }
    }else{
      alert("Balance per card can't be zero (0) or less.");
    }
  }
   function IDGenerator() {
     return '_' + Math.random().toString(36).substr(2, 9);
   }
  function FetchSelectedPropertyNumbers(){
    var id_of_conts_tovalidate = "";
    // CHECK IF ASSET IS VALID GROUPING TOGETHER
    var ccount =0;
    var count_sel =0;
   $('.asset_item_check[type="checkbox"]:checked').each(function() {
       if(ccount == 0){
        // ENCODE BASIS
         id_of_conts_tovalidate = $(this).data("dateofaq") + $(this).data("itemname") + $(this).data("unitofmea") + $(this).data("aq_cost");
        ccount++;
       }
    });
   var haserror = false;
   $('.asset_item_check[type="checkbox"]:checked').each(function() {
        // ENCODE BASIS
         var myidentity = $(this).data("dateofaq") + $(this).data("itemname") + $(this).data("unitofmea") + $(this).data("aq_cost");
         if(myidentity != id_of_conts_tovalidate){
          haserror = true;
         }
      
    });
   // PROCEED
   if(haserror){
    alert("Items can't be grouped because specifications do not match.");
   }else{
    $("#tbl_assets").html("");
    var countselection = 0;
    autoname = "";
    $('.asset_item_check[type="checkbox"]:checked').each(function() {
      countselection ++;

      if(autoname == ""){
        autoname = $(this).data("itemname");
      }
      count_sel++;
     $("#tbl_assets").append("<tr><td>" + count_sel + "</td><td class='selected_datum' data-itemname='" + $(this).data("itemname") + "' data-val='" + $(this).data("propnum") + "'>" + $(this).data("propnum") + "</td><td>" + $(this).data("assetitem") + "</td></tr>");
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
      data: {_token:"{{ csrf_token() }}",
      rnum:room_numberreal,
      catname:<?php echo json_encode($_GET["my_category"]) ?>,
      inv_year: g_invyear,
      inv_month: g_invmonth
      },
      success: function(data){
        // alert(data);
        $("#myfiltered").append(data);
      }
    })
  }
   function LoadGroupedAssets(){
    $.ajax({
      type : "POST",
      url : "{{ route('viewassetgrouped') }}",
      data : {_token: "{{ csrf_token() }}",rnum:room_numberreal,catname:<?php echo json_encode($_GET["my_category"]) ?>,station_id:<?php echo json_encode(session("user_school")); ?>,
      inv_year: g_invyear,
      inv_month: g_invmonth},
      success : function(data){
        $("#myfiltered").html(data);
        LoadAssets();
      }
    })
  }
</script>


@endsection