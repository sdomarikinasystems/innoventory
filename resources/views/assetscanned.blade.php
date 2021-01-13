@extends('master.master')

@section('title')
Innoventory - Inventory
@endsection

@section('contents')

<h2>Inventory</h2>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Home</li>
		<li class="breadcrumb-item active" aria-current="page">Inventory</li>
	</ol>
</nav>

  <?php
      if(session("user_type") == "0" || session("user_type") == "1"){
    ?>
    <!-- FOR ADMIN ONLY -->
    <a class="btn btn-secondary float-right dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
    <i class="fas fa-filter"></i> Filter Inventory Source</a>
    <div class="dropdown-menu" style="width:450px; min-height: 300px;">
      <div class="container">
        <div class="form-group">
          <input type="text" class="form-control mt-3" id="searchss" placeholder="Search Station here..." name="">
        </div>
        <div class="form-group">
          <div class=' mt-2'>
            <a href='#' onclick="gotodefaultsource()" title='Switch to my own assets'>
            <span class="float-right text-muted"><i class="fas fa-home"></i></span>
            <small class='text-muted card-subtitle'>Switch to</small><br>
            <strong class='card-title' ><?php echo session("user_schoolname"); ?></strong>
            </a>
            <hr>
            <center id="search_narrative"><h5 class="text-muted mt-5"><i class="fas fa-search"></i> Search result will appear here...</h5></center>
          </div>
          <div id="school_search_cont" style=" overflow-y: auto; overflow-x: hidden; max-height: 300px;">
          <!-- result -->
          </div>
        </div>
      </div>
    </div>
    <?php
    }


    ?>

<h4 class="mb-3"><span id="sourcename">{{ session('user_schoolname')}}</span></h4>

 <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-box"></i> Capital Outlay</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fas fa-boxes"></i> <span >Semi-Expendable</span></a>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

<div class="row">
  

  <script type="text/javascript">
  $("#searchss").change(function(){
  var skey = $("#searchss").val();
  $.ajax({
  type: "POST",
  url: "../../search_station_toview",
  data: {_token: "{{ csrf_token() }}",searchkey:skey},
  success: function(data){
    if(data == ""){
    $("#search_narrative").html("No result found.");
    $("#school_search_cont").css("display","none");
      $("#search_narrative").css("display","block");
    }else{
     $("#school_search_cont").css("display","block");
      $("#search_narrative").css("display","none");

       $("#school_search_cont").html(data);
    }
    $("#searchss").val("");
  }
  })
  })
  </script>
  <div class="col-sm-12">
      <?php
      if(session("user_type") < "4" && session("user_type") != "2"){
        ?>
        <!-- FOR SUPPLY OFFICER AND PROPERTY CUSTODIAN ONLY -->

    <button class="btn btn-primary" data-toggle="modal" data-target="#modal_upload_capitaloutlay" style="display: none;"><i class="fas fa-upload"></i> Upload Scanned Data via CSV</button>


    <?php } ?>

    <div class="card-deck">
      <div class="card">
        <div class="card-body">
          <h2 id="itms_total"></h2>
        </div>
        <div class="card-footer">
          Total Scanned
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <h2 id="notextsum"></h2>
        </div>
        <div class="card-footer">
           <form action="../../viewallnoentryitems" method="get">
            <input type="hidden" name="myschool_id" id="inp_sc_id" value="">
            <button type="submit" class="btn btn-info btn-sm float-right" id="view_button_cap_out_missing">View</button>
            </form>
          Missing Asset(s)
        </div>
      </div>

       <div class="card">
        <div class="card-body">
          <span id="mytimeline"></span>
        </div>
        <div class="card-footer">
          <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#m_capoutdatefilter">Filter</button>
          From - To
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <p class="mt-0 mb-0"><i class="fas fa-check-circle"></i> Ready</p>
          <span class="text-muted">You're now ready to start the inventory</span>
        </div>
        <div class="card-footer">
          <button class="btn btn-danger btn-sm float-right">Start</button>
          Inventory
        </div>
      </div>
    </div>
   
  </div>
</div>
<div class="row mt-3">
  <div class="col-md-12">
    <table class="table table-hover table-bordered" id="tbl_sc">
      <thead>
        <tr>
          <th scope="col" width="150">Property Number</th>
          <th scope="col">Asset Item</th>
          <th scope="col">Current Condition</th>
          <th scope="col">Service Center</th>
          <th scope="col">Room</th>
          <th scope="col">Inventory Date</th>
        </tr>
      </thead>
      <tbody id="scannedassets">
      </tbody>
    </table>
  </div>
</div>
  </div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
    <div class="row">
      <div class="col-sm-6">

         <?php
      if(session("user_type") < "4" && session("user_type") != "2"){
        ?>
        <!-- FOR SUPPLY OFFICER AND PROPERTY CUSTODIAN ONLY -->

    <?php } ?>



        
      </div>
       <div class="col-sm-12">


         <div class="card-deck">
      <div class="card">
        <div class="card-body">
          <h2 id="semisum_totalscanned"></h2>
        </div>
        <div class="card-footer">
          Total Scanned
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <h2 id="semisum_itemsnotfound"></h2>
        </div>
        <div class="card-footer">
          <form action="{{ route('goto_missing_scanned_semi') }}" method="GET">
            <input type="hidden" name="myschool_id" id="inp_sc_id_semi" value="">
            <button type="submit" class="btn btn-sm btn-info float-right" id="view_butt_semi_missing">View</button>
          </form>
          Missing Item(s)
        </div>
      </div>
       <div class="card">
        <div class="card-body">
          <span id="semisum_fromto"></span>
        </div>
        <div class="card-footer">
          <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modal_filterdateofsemi">Filter</button>
          From - To
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <p class="mt-0 mb-0"><i class="fas fa-check-circle"></i> Ready</p>
          <span class="text-muted">You're now ready to start the inventory</span>
        </div>
        <div class="card-footer">
          <button class="btn btn-danger btn-sm float-right">Start</button>
          Inventory
        </div>
      </div>
    </div>

      </div>
       <div class="col-sm-12 mt-3">
        <table class="table table-hover table-bordered" id="tbl_scannnedsemi">
      <thead>
        <tr>
          <th scope="col" width="150">Stock Number</th>
          <th scope="col">Article</th>
          <th scope="col">Description</th>
          <th scope="col">Service Center</th>
          <th scope="col">Room</th>
          <th scope="col">Inventory Date</th>
        </tr>
      </thead>
      <tbody id="tbl_scanned_semiexpendableasset">
      </tbody>
    </table>



  
      </div>
    </div>

  </div>
</div>


  <div class="modal" tabindex="-1" role="dialog" id="modal_filterdateofsemi">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Filter Semi-Expendable</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row mt-3 mb-3">
            <div class="col-sm-6">
              <label>Year</label>
              <select class="form-control" id="semiexpe_filter_year" onchange="LoadSelection_MonthWithInventory_ByYear_semi()"></select>
            </div>
            <div class="col-sm-6">
              <label>Month</label>
              <select class="form-control" id="semiexpe_filter_month"></select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="filter_assets_semiexpendable()" data-dismiss="modal">Apply</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" tabindex="-1" role="dialog" id="m_capoutdatefilter">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Filter Capital Outlay</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row mt-3 mb-3">
            <div class="col-sm-6">
              <label>Year</label>
              <select class="form-control" id="capout_filter_year" onchange="LoadSelection_MonthWithInventory_ByYear()"></select>
            </div>
            <div class="col-sm-6">
              <label>Month</label>
              <select class="form-control" id="capout_filter_month"></select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="filter_assets_capitaloutlay()" data-dismiss="modal">Apply</button>
        </div>
      </div>
    </div>
  </div>




  <form action="{{ route('shoot_uploadsemiexpendabledata') }}" enctype="multipart/form-data" method="POST">
      {{ csrf_field() }}
      <div class="modal" tabindex="-1" role="dialog" id="modal_uploadscanneddataofsemi">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Upload Semi-Expendable CSV Scanned Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Choose CSV file of scanned semi-expendable data</label>
              <input type="file" required="" accept=".csv" name="thecsvfile">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Import</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
    </form>


 <form action="{{ route('shoot_uploadscannedcapitaloutlay') }}" enctype="multipart/form-data" method="POST">
  {{ csrf_field() }}
    <div class="modal" tabindex="-1" role="dialog" id="modal_upload_capitaloutlay">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Upload Capital Outlay Scanned Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Choose scanned capital outlay CSV</label>
            <input type="file" required="" accept=".csv" name="thecsvfile">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Import</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
 </form>

<script type="text/javascript">





var is_filter_loaded = false;
var is_filter_loaded_semi = false;

 var ref_station = "";
function UniversalLoaderSourceChange(stationID){
  ref_station = stationID;
  LoadSelection_YearWithInventory(stationID);
  LoadSelection_YearWithInventory_semi(stationID);
  if(is_filter_loaded == true){
    LoadAssets(stationID);
  }
  if(is_filter_loaded_semi == true){
    GetSemiScannedAsset(stationID);
  }
}



  $("#tbl_sc").DataTable();
  var ss = <?php echo json_encode(session("user_school")); ?>;
  UniversalLoaderSourceChange(ss);



  function gotodefaultsource(){
      UniversalLoaderSourceChange(ss);
  }
  function changesource(control_obj){

     if($(control_obj).data("sourceid") != <?php echo session("user_school"); ?>){
            $("#sourcename").html($(control_obj).data("sourcename"));
          }else{
              $("#sourcename").html($(control_obj).data("sourcename"));
          }
     UniversalLoaderSourceChange($(control_obj).data("sourceid"));
  }


      function GetSemiScannedAsset(schoolid){

        var yy = $("#semiexpe_filter_year").val();
        var mm = $("#semiexpe_filter_month").val();

        $.ajax({
          type:"POST",
          url: "{{ route('shoot_show_uploaded_semi_expendable_scanneddata') }}",
          data: {_token: "{{ csrf_token() }}",sd_id: schoolid,selyear:yy,selmonth:mm},
          success: function(data){
            $("#tbl_scanned_semiexpendableasset").html(data);
            GetSemi_TotalScanned(schoolid,yy,mm);
          }
        })
      }

       function GetSemi_TotalScanned(schoolid,yy,mm){
        $.ajax({
          type: "POST",
          url: "{{ route('stole_getsemisum_totalscanned') }}",
          data: {_token: "{{ csrf_token() }}",sd_id: schoolid,selyear:yy,selmonth:mm},
          success: function(data){
           $("#semisum_totalscanned").html(data);
           GetSemi_FromTo(schoolid,yy,mm);
          }
        })
      }
      function GetSemi_FromTo(schoolid,yy,mm){
        $.ajax({
          type: "POST",
          url: "{{ route('stole_getsemisum_fromto') }}",
          data: {_token: "{{ csrf_token() }}",sd_id: schoolid,selyear:yy,selmonth:mm},
          success: function(data){
            $("#semisum_fromto").html(data);
            GetSemi_ItemsNotFound(schoolid,yy,mm);
          }
        })
      }
      function GetSemi_ItemsNotFound(schoolid,yy,mm){
        $.ajax({
          type: "POST",
          url: "{{ route('stole_getsemisum_itemsnotfound') }}",
          data: {_token: "{{ csrf_token() }}",sd_id: schoolid,selyear:yy,selmonth:mm},
          success: function(data){
            if(data == "0"){
                $("#semisum_itemsnotfound").html("No items missing");
                 $("#view_butt_semi_missing").css("display","none");
            }else{
                $("#semisum_itemsnotfound").html(data);
                $("#view_butt_semi_missing").css("display","block");
            }
           
          }
        })
      }


// DATE FILTER FOR CAPITAL OUTLAY
  function LoadSelection_YearWithInventory(staID){
    $.ajax({
      type:"POST",
      url: "{{ route('stole_all_years_with_inventory_capitaloutlay') }}",
      data: {_token: "{{ csrf_token() }}",station_id:staID},
      success: function(data){
        $("#capout_filter_year").html(data);
        ref_station = staID;
        LoadSelection_MonthWithInventory_ByYear();
      }
    })
  }

  function LoadSelection_MonthWithInventory_ByYear(){
      var ref_year = $("#capout_filter_year").val();
    $.ajax({
      type:"POST",
      url: "{{ route('stole_inventory_month_capital_outlay') }}",
      data: {_token: "{{ csrf_token() }}",station_id:ref_station,date_year:ref_year},
      success: function(data){
        $("#capout_filter_month").html(data);
        if(is_filter_loaded == false){
          is_filter_loaded = true;
          LoadAssets(ref_station);
        }
      }
    })
  }

  function filter_assets_capitaloutlay(){
    LoadAssets(ref_station);
  }



  // DATE FILTER FOR SEMI EXPENDABLE
  
    function LoadSelection_YearWithInventory_semi(staID){
    $.ajax({
      type:"POST",
      url: "{{ route('stole_all_years_with_inventory_semiexpendable') }}",
      data: {_token: "{{ csrf_token() }}",station_id:staID},
      success: function(data){
        $("#semiexpe_filter_year").html(data);
        ref_station = staID;
        LoadSelection_MonthWithInventory_ByYear_semi();
      }
    })
  }

  function LoadSelection_MonthWithInventory_ByYear_semi(){
      var ref_year = $("#semiexpe_filter_year").val();
    $.ajax({
      type:"POST",
      url: "{{ route('stole_inventory_month_semiexpendable') }}",
      data: {_token: "{{ csrf_token() }}",station_id:ref_station,date_year:ref_year},
      success: function(data){
        $("#semiexpe_filter_month").html(data);
        if(is_filter_loaded_semi == false){
          is_filter_loaded_semi = true;
          GetSemiScannedAsset(ref_station);
        }
      }
    })
  }
  
  function filter_assets_semiexpendable(){
    GetSemiScannedAsset(ref_station);
  }




  function LoadAssets(sc_id){
    $("#lodass").css("display","block");
    $("#inp_sc_id").val(sc_id);
    $("#inp_sc_id_semi").val(sc_id);

    var choosen_year = $("#capout_filter_year").val();
    var choosen_month = $("#capout_filter_month").val();

    $.ajax({
    type: "POST",
    url: "{{ route('get_ass_scanned') }}",
    data: {_token:"{{ csrf_token() }}","station_number":sc_id,selyear:choosen_year,selmonth:choosen_month},
    success: function(data){
       $("#tbl_sc").DataTable().destroy();
      $("#scannedassets").html(data);
      $("#lodass").css("display","none");
      $("#tbl_sc").DataTable();
    }
  })

 $.ajax({
    type: "POST",
    url: "{{ route('g_sca_ttitms') }}",
    data: {_token:"{{ csrf_token() }}","station_number":sc_id,selyear:choosen_year,selmonth:choosen_month},
    success: function(data){
      $("#itms_total").html(data);
    }
  })

$.ajax({
    type: "POST",
    url: "{{ route('get_noscitems') }}",
    data: {_token:"{{ csrf_token() }}","station_number":sc_id,selyear:choosen_year,selmonth:choosen_month},
    success: function(data){
      if(data == "0"){
 $("#notextsum").html("No items missing");
 $("#view_button_cap_out_missing").css("display","none");
      }else{
         $("#notextsum").html(data);
         $("#view_button_cap_out_missing").css("display","block");
      }
     
    }
  })
        $.ajax({
    type: "POST",
    url: "{{ route('get_sc_occudates') }}",
    data: {_token:"{{ csrf_token() }}","station_number":sc_id,selyear:choosen_year,selmonth:choosen_month},
    success: function(data){
      $("#mytimeline").html(data);
    }
  })

  }
  var utype = <?php echo json_encode(session("user_type")); ?>;
  $.ajax({
    type: "POST",
    url: "../../getallscnames",
    data : {_token: "{{ csrf_token() }}"},
    success: function(data){
      if(utype == "0" || utype == "1"){
 $("#scnamesselection").html("<option value='all'>Show All</option>");
      }
      
      
      $("#scnamesselection").append(data);
   $("#scnamesselection").val(<?php echo json_encode(session("user_school")); ?>);
    }
  })
</script>
@endsection