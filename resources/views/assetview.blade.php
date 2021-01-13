@extends('master.master')

@section('title')
Innoventory (Loading....)
@endsection

@section('contents')
<h2>Asset Registry</h2>


<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item " aria-current="page"><a href="/innoventory/asset/registry">Asset Registry</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span class="a_navname"></span></li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-3">
    <center>
    <div class="card" role="alert">
        <h1 class="mt-5 mb-5 text-muted" style="font-size: 20vh;"><i class="fas fa-image"></i></h1>
    </div>
    </center>
  </div>
  <div class="col-md-9">
    <div class="row">
      <div class="col-md-8">
        <small>Property Number : <span class="a_prn">0000</span></small>
    <h3 class="a_itemname mb-0">Item Name</h3>
     <h6 class="a_assclass text-muted mb-0"></h6>
    <h4 class="mt-0"><span class="badge badge-danger mt-2 mb-3">₱ <span class="a_coa"></span></span></h4>
   
    <p class="mb-0 mt-3"><span class="text-muted">Asset Sub Class</span>: <span class="a_subclass"></span></p>
    <p class="mb-0"><span class="text-muted">Manufacturer</span>: <span class="a_manu"></span></p>
    <p class="mb-0"><span class="text-muted ">Model</span>: <span class="a_model"></span></p>
     <p class="mb-0"><span class="text-muted ">Accountable Officer</span>: <span class="a_noaccoff"></span></p>
    
      </div>
      <div class="col-md-4">
        <div class="alert alert-info alert-sm" role="alert">
          <small>Estimated Total Life Years</small> : <br><h4 class="a_ely mb-0"></h4>
        </div>
        <div class="alert alert-secondary alert-sm" role="alert">
          <small>Condition</small> : <br><strong class="a_current"></strong>
        </div>
      </div>
    </div>
    <table class="table table-bordered mt-3">
      <tbody>
        <tr>
          <td style="width: 20%;"><span class="text-muted"><i class="fas fa-money-bill-wave"></i> Source of Fund</span></td>
          <td class="a_sof"></td>
        </tr>
        <tr>
          <td style="width: 20%;"><span class="text-muted"><i class="fas fa-code-branch"></i> UACS</span></td>
          <td class="a_uac"></td>
        </tr>
        <tr>
          <td style="width: 20%;"><span class="text-muted"><i class="fas fa-map-marker-alt"></i> Location</span></td>
          <td> Room <strong class="a_roonum"></strong> in <strong class="a_offname"></strong> office, building <strong class="a_assloc"></strong></td>
        </tr>
        <tr>
          <td style="width: 20%;"><span class="text-muted"><i class="fas fa-warehouse"></i> Service Center</span></td>
          <td class="a_sercen"></td>
        </tr>
        <tr>
          <td style="width: 20%;"><span class="text-muted"><i class="far fa-building"></i> Office Type</span></td>
          <td class="a_offtype"></td>
        </tr>
      </tbody>
    </table>

    <div class="card mt-2">
      <div class="card-body">
        <h5>Remarks</h5>
        <p class="a_rem mb-0"></p>
      </div>
    </div>

  </div>
</div>
<center class="mt-4 mb-4">
  <a href="#" class="btn btn-light" id="btnshowallspecification"><i class="fas fa-sort-down"></i> Show all infomation</a>
<a href="#" class="btn btn-light" id="btnminimizeinfo" style="display: none;"><i class="fas fa-sort-up"></i> Minimize information</a>
</center>
<div id="allinfo" style="display: none;">
  <div class="card-deck mt-3"  >
  <div class="card">
    <div class="card-body">
      <h5 class="mb-3"><i class="fas fa-tag"></i> Specifications</h5>
       <table class="table table-striped table-bordered">
      <tr><td>Property Number</td><td class="a_prn"></td></tr>
      <tr><td>Asset Item</td><td class="a_itemname"></td></tr>
      <tr><td>Asset Classification</td><td class="a_assclass"></td></tr>
      <tr><td>Asset Sub Class</td><td class="a_subclass"></td></tr>
      <tr><td>UACS Object Code</td><td class="a_uac"></td></tr>
      <tr><td>Manufacturer</td><td class="a_manu"></td></tr>
      <tr><td>Model</td><td class="a_model"></td></tr>
      <tr><td>Serial Number</td><td class="a_serialnum"></td></tr>
      <tr><td>Specification</td><td class="a_specif"></td></tr>
      <tr><td>Current Condition</td><td class="a_current"></td></tr>
      <tr><td>Estimated Total Life Years</td><td class="a_ely"></td></tr>
      <tr><td>Status</td><td class="a_stat"></td></tr>
      <tr><td>Unit of Mesure</td><td class="a_uom"></td></tr>
       </table>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <h5 class="mb-3"><i class="fas fa-receipt"></i> Funding</h5>
       <table class="table table-striped table-bordered">
      <tr><td>Source of Fund</td><td class="a_sof"></td></tr>
      <tr><td>Cost of Acquisition</td><td class="a_coa"></td></tr>
      <tr><td>Date of Acquisition</td><td class="a_doa"></td></tr>
      <tr><td>Remarks</td><td class="a_rem"></td></tr>
       </table>
    </div>
  </div>
    <div class="card">
    <div class="card-body">
      <h5 class="mb-3"><i class="far fa-compass"></i> Location</h5>
       <table class="table table-striped table-bordered">
      <tr><td>Office Type</td><td class="a_offtype"></td></tr>
      <tr><td>Office Name</td><td class="a_offname"></td></tr>
      <tr><td>Service Center</td><td class="a_sercen"></td></tr>
      <tr><td>Room Number</td><td class="a_roonum"></td></tr>
      <tr><td>Name of Accountable Officer</td><td class="a_noaccoff"></td></tr>
      <tr><td>Asset Location</td><td class="a_assloc"></td></tr>
       </table>
    </div>
  </div>
</div>



</div>




<script type="text/javascript">

  $("#btnshowallspecification").click(function(){
    $("#allinfo").css("display","block");
    $("#btnshowallspecification").css("display","none");
     $("#btnminimizeinfo").css("display","inline-block");
  })
  $("#btnminimizeinfo").click(function(){
    $("#allinfo").css("display","none");
     $("#btnshowallspecification").css("display","inline-block");
    $("#btnminimizeinfo").css("display","none");
  })

  
  $.ajax({
    type: "POST",
    url: "get_asset_full",
    data: {_token: "{{ csrf_token() }}",asset_id:<?php echo json_encode($_GET["asset_id"]); ?>},
    success: function(data){
      // alert(data);

      $("title").html("CO : "+ data[0]["asset_item"]);

      $(".a_navname").html(data[0]["asset_item"]);
      $(".a_prn").html(data[0]["property_number"]);
      $(".a_itemname").html(data[0]["asset_item"]);

      $(".a_offtype").html(data[0]["office_type"]);
      $(".a_offname").html(data[0]["office_name"]);
      $(".a_assclass").html(data[0]["asset_classification"]);
      $(".a_subclass").html(data[0]["asset_sub_class"]);

      $(".a_uac").html(data[0]["uacs_object_code"]);
      $(".a_manu").html(data[0]["manufacturer"]);
      $(".a_model").html(data[0]["model"]);
      $(".a_serialnum").html(data[0]["serial_number"]);
      $(".a_specif").html(data[0]["specification"]);
      $(".a_current").html(data[0]["current_condition"]);
      $(".a_sof").html(data[0]["source_of_fund"]);
      $(".a_coa").html(data[0]["cost_of_acquisition"]);

      $(".a_doa").html(data[0]["date_of_acquisition"]);
      $(".a_ely").html(data[0]["estimated_total_life_years"]);
      $(".a_noaccoff").html(data[0]["name_of_accountable_officer"]);
      $(".a_assloc").html(data[0]["asset_location"]);
      $(".a_rem").html(data[0]["remarks"]);
      $(".a_uom").html(data[0]["unit_of_measure"]);
      $(".a_sercen").html(data[0]["service_center"]);
      $(".a_roonum").html(data[0]["room_number"]);
      var mystatus = "";

      switch(data[0]["status"]){
        case "0":
          mystatus = "Normal Condition";
        break;
         case "1":
          mystatus = "Condemnation / Desctruction";
        break;
         case "2":
          mystatus = "Transfer of Property";
        break;
        case "3":
          mystatus = "Donation of Property";
        break;
        case "4":
          mystatus = "Sale of Unserviceable Property";
        break;
      }
      $(".a_stat").html(mystatus);
    }
  })
</script>
@endsection