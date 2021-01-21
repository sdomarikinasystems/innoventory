@extends('master.master')

@section('title')
Innoventory - Asset Registry
@endsection

@section('contents')

<h2>Asset Registry</h2>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page"><a href="/innoventory/dashboard">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Asset Registry</li>
	</ol>
     
</nav>

<input type="hidden" value="{{ session('user_school') }}" id="myschool_realid" name="">

<div class="mobiletext">

<div id="lod_change_ass_source" style="display:none; top: 0; right: 0; left: 0; bottom: 0; position: fixed; background-color: rgba(0,0,0,0.9); z-index: 100; color:white;">
 <center><br><br><br><h4 class="mt-5">Changing Asset Source</h4></center>
</div>
 <?php
      if(session("user_type") == "0" || session("user_type") == "1"){
    ?>
  <!-- FOR ADMIN ONLY -->
    <a class="btn btn-secondary dropdown-toggle float-right" href="#" id="navbardrop" data-toggle="dropdown">
    <i class="fas fa-filter"></i> Filter Asset Source</a>
  
    <div class="dropdown-menu" style="width:450px; min-height: 300px;">
      <div class="container">
        <div class="form-group">
          <input type="text" class="form-control mt-3" id="searchss" placeholder="Search Station here..." name="">
        </div>
        <div class="form-group">
          <div class=' mt-2'>
            <a onclick='gotomyownassets()' href='#' title='Switch to my own assets'>
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
  <!--ASSET REGISTRY-->
  <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active"  data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-box"></i> <span >Capital Outlay</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  data-toggle="pill" id="btn_gotosemiexpendable" href="#semiexpendable" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-boxes"></i> <span >Semi-Expendable</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  data-toggle="pill" id="btn_gotosuppytable" href="#suplliestbl" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-parachute-box"></i> <span >Supplies</span></a>
    </li>
  </ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show" id="suplliestbl" role="tabpanel" aria-labelledby="pills-home-tab">

    <div class="row">
      <div class="col-sm-6">
          <a class="btn btn-success importbutton" href="#" data-toggle="modal" id="imp_sem" data-target="#modal_importsupp"><i class="fas fa-file-import"></i> Import Supply</a>
      </div>
      <div class="col-sm-6">
        <table class="table table-sm table-bordered">
      <thead>
        <tr>
          <th>Total Assets</th>
          <th>Discrepancies</th>
          <th>Omitted</th>
          <th>Last Updated</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td id="supp_asscount">0</td>
          <td id="supp_desccount">0</td>
          <td id="supp_asssataomitted">0</td>
          <td id="supp_lastuploadof">0</td>
        </tr>
      </tbody>
    </table>
      </div>
      <div class="col-sm-12">

          <table class="table table-hover table-bordered" id="tbl_supply">
              <thead>
              <tr>
              <th scope="col" width="150">Article</th>
              <th scope="col">Description</th>
              <th scope="col">Stock Number</th>
              <th scope="col">Unit of Measure</th>
              <th scope="col">Unit Value</th>
              <th scope="col">Balance Per Card</th>
              <th scope="col">On Hand Per Count</th>
              <th scope="col">Remarks</th>
              <th scope="col">Action</th>
              </tr>
              </thead>
              <tbody id="tbl_importedsupplies">
                
              </tbody>
          </table>

      </div>
    </div>

    <form action="{{ route('shoot_add_supply') }}" enctype="multipart/form-data" method="POST" >
      {{ csrf_field() }}
    <div class="modal" tabindex="-1" role="dialog" id="modal_importsupp">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Upload Supply Via CSV</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

               <div id="lod_uploadsupp" style=" position: fixed; display: block; z-index: 100; top: 0; bottom: 0; left: 0; right: 0; height: 100%; width:  100%; background-color: white; display:none;">
    <center>
<img class="mt-5" src="https://icon-library.net/images/ajax-loading-icon/ajax-loading-icon-2.jpg" style="width: 40px; padding-top: 100px;">
     <div class="container">
        <h5 class="mt-3 card-title">Validating Records</h5>
      <h6 class="card-subtitle text-muted">Please standby for a moment, this may take some time depending on your asset count.</h6></center>
     </div>
              <div class="row">
                 <div class="col-md-6">
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
                      <label>Upload Supply CSV File</label>
                      <input type="file" id="supplyfile" required="" accept=".csv"  name="thecsvfile" onchange="return fileValidation_supplyfile()">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                 <h6 class="card-title"><i class="fas fa-tasks"></i> Requirements</h6>
            <ol>
              <li>File format needs to be <span class="badge badge-success">.CSV</span></li>
              <li>File size must be below <span class="badge badge-success">5 MB</span></li>
              <li>CSV has <span class="badge badge-success">9 columns</span></li>
            </ol>
              </div>
                <div class="col-sm-12">
                  
                  <input type="hidden" class="servicecenterselected" name="service_center_id">
                  <div class="mt-2">
                    <div class="card " id="panel_semi_previewscv_supply" style="display: none;">
                      <div class="card-body card-limited">
                        <small class="text-muted float-right">Limited by 3 rows</small>
                        <h5>Preview <span id="issupplyvalid"></span></h5>
                        <table class="table table-bordered table-responsive">
                        <tbody id="thetable_semiexpendible_supply">
                        <tr>
                        <td>Please upload a valid Asset Registry CSV file for the preview.</td>
                        </tr>
                        </tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" id="submitsupplycsvbtn"><i class="fas fa-upload"></i> Import</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
  </form>

<form>
      <div class="modal" tabindex="-1" role="dialog" id="supplydispose">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Dispose Supply</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to dispose this supply asset?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger">Dispose</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
</form>


  </div>
   <div class="tab-pane fade show" id="semiexpendable" role="tabpanel" aria-labelledby="pills-home-tab">
      <div class="row">
  <div class="col-sm mb-3">
    <a class="btn btn-success importbutton" href="#" data-toggle="modal" onclick="  LoadserviceCentersMine()" id="imp_sem" data-target="#chooseserv"><i class="fas fa-file-import" ></i> Import Semi-Expendable</a>
    <div class="alert alert-info importwarning" role="alert">
      Change your asset source to import Semi-Expendable Asset(s)
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="chooseserv">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Semi-Expendable Service Center</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group mt-3">
                  <label>Service Center</label>
                  <select class="form-control" required="" name="service_center_id" id="inp_servicecentersinput"></select>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal" id="servcentbtnchoose" data-toggle="modal" data-target="#uploadsemiexpenda">Continue</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      $("#imp_sem").click(function(){
        $("#inp_servicecentersinput").val("");
      })
      setInterval(function(){
        var selected_servcent = $("#inp_servicecentersinput").val();
        if(selected_servcent != "" && selected_servcent != null){
          $("#servcentbtnchoose").css("display","block");
        }else{
          $("#servcentbtnchoose").css("display","none");
        }
      })

      $("#servcentbtnchoose").click(function(){
        $(".servicecenterselected").val($("#inp_servicecentersinput").val());
      })

    </script>

    <form action="{{ route('shoot_add_semi_expendible') }}" enctype="multipart/form-data" method="POST" >
      {{ csrf_field() }}
      <div class="modal" tabindex="-1" role="dialog" id="uploadsemiexpenda">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">


            <div id="lod_uploadsmi" style=" position: fixed; display: block; z-index: 100; top: 0; bottom: 0; left: 0; right: 0; height: 100%; width:  100%; background-color: white; display:none;">
    <center>
<img class="mt-5" src="https://icon-library.net/images/ajax-loading-icon/ajax-loading-icon-2.jpg" style="width: 40px; padding-top: 100px;">
     <div class="container">
        <h5 class="mt-3 card-title">Validating Records</h5>
      <h6 class="card-subtitle text-muted">Please standby for a moment, this may take some time depending on your asset count.</h6></center>
     </div>



          <div class="modal-header">
            <h5 class="modal-title">Upload Semi-Expendable Via CSV</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <input type="hidden" class="source_id_dynamic" name="sourceid" value="{{ session('user_school') }}">

            <div class="row">
              <div class="col-md-6">
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
                      <label>Upload Semi-Expendable CSV File</label>
                      <input type="file" id="semifile" required="" accept=".csv"  name="thecsvfile" onchange="return fileValidation_semiexpendable()">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                 <h6 class="card-title"><i class="fas fa-tasks"></i> Requirements</h6>
            <ol>
              <li>File format needs to be <span class="badge badge-success">.CSV</span></li>
              <li>File size must be below <span class="badge badge-success">5 MB</span></li>
              <li>CSV has <span class="badge badge-success">9 columns</span></li>
            </ol>
              </div>
             
              <div class="col-md-12">
                <input type="hidden" name="service_center_id" class="servicecenterselected">
                 <div class=" mt-2">
           <div class="card " id="panel_semi_previewscv" style="display: none;">
             <div class="card-body card-limited">
              <small class="text-muted float-right">Limited by 3 rows</small>
            <h5>Preview <span id="issemivalid"></span></h5>
              <table class="table table-bordered table-responsive">
                <tbody id="thetable_semiexpendible">
                  <tr>
                    <td>Please upload a valid Asset Registry CSV file for the preview.</td>
                  </tr>
                </tbody>
              </table>
             </div>
           </div>
          </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="submitsemiexpendable"><i class="fas fa-upload"></i> Import</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    </form>

  </div>
  <div class="col-sm">
     <table class="table table-sm table-bordered">
      <thead>
        <tr>
          <th>Total Assets</th>
          <th>Discrepancies</th>
          <th>Omitted</th>
          <th>Last Updated</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td id="semi_asscount">0</td>
          <td id="semidesccount">0</td>
          <td id="semi_asssataomitted">0</td>
          <td id="semi_lastuploadof">0</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
    <table class="table table-hover table-bordered" id="tbl_semiexpendable">
    <thead>
      <tr>
        <th scope="col" width="150">Article</th>
        <th scope="col">Description</th>
        <th scope="col">Stock Number</th>
        <th scope="col">Unit of Measure</th>
        <th scope="col">Unit Value</th>
        <th scope="col">Balance Per Card</th>
        <th scope="col">On Hand Per Count</th>
         <th scope="col">Service Center</th>
        <th scope="col">Remarks</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody id="tbl_allsemiexpends">
    </tbody>
  </table>

   </div>
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
      

      <div class="row">
  <div class="col-sm mb-3">
    <?php
      if(session("user_type") < "4" && session("user_type") != "2"){
    ?>
    <!-- FOR SUPPLY OFFICER AND PROPERTY CUSTODIAN ONLY -->
    <a class="btn btn-success importbutton" href="#" data-toggle="modal" data-target="#uploadnewcsv" onclick="LoadAllSCNamesForCapOut()"><i class="fas fa-file-import"></i> Import Capital Outlay</a>

     <div class="alert alert-info importwarning" role="alert">
      Change your asset source to import Capital Outlay Asset(s)
    </div>
    <?php } ?>
  </div>
  <div class="col-sm">
    <table class="table table-sm table-bordered">
      <thead>
        <tr>
          <th>Total Assets</th>
          <th>Discrepancies</th>
          <th>Omitted</th>
          <th>Last Updated</th>
        
        </tr>
      </thead>
      <tbody id="assvalsum">
        <tr>
          <td>0</td>
          <td>0</td>
          <td>0</td>
          <td>0</td>
        </tr>
      </tbody>
    </table>
  </div>  
</div>

<script type="text/javascript">
  $("#searchss").change(function(){
    var skey = $("#searchss").val();
   $.ajax({
    type: "POST",
    url: "{{ route('search_asstov') }}",
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
  function changesource(control_obj){
   
    $("#myschool_realid").val($(control_obj).data("sourceid"));
    $(".source_id_dynamic").val($(control_obj).data("sourceid"));

     if($(control_obj).data("sourceid") != <?php echo session("user_school"); ?>){
            $("#sourcename").html($(control_obj).data("sourcename"));
          }else{
              $("#sourcename").html($(control_obj).data("sourcename"));
          }


    $("#lod_change_ass_source").css("display","block");
    LoadAssets();
    setTimeout(function(){
    $("#lod_change_ass_source").css("display","none");
    },1000)
    }

    function gotomyownassets(){

    var myassets = <?php echo json_encode(session("user_school")); ?>;
    $("#myschool_realid").val(myassets);
     $("#lod_change_ass_source").css("display","block");
    LoadAssets();
    setTimeout(function(){
    $("#lod_change_ass_source").css("display","none");
     $("#sourcename").html(<?php echo json_encode(session("user_schoolname")); ?>);
    },1000)

    }
</script>


      <table class="table table-hover table-bordered" id="tbl_ass">
    <thead>
      <tr>
        <th scope="col" width="150">Property Number</th>
        <th scope="col">Asset Item</th>
        <th scope="col">Specification</th>
        <th scope="col">Current Condition</th>
        <th scope="col">Service Center</th>
        <th scope="col">Room</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody id="allmyassests">
    </tbody>
  </table>
  </div>
</div>


<!--END-->

<form action="{{ route('archive_an_asset') }}" method="POST">
  {{ csrf_field() }}
  <div class="modal" tabindex="-1" id="m_remove" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Item Disposal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="the_asset_to_dispose_id" name="asset_id">
          <div class="form-group">
            <label>Disposal Type</label>
            <select class="form-control" name ="asset_archive_type">
              <option value="1">Condemnation / Destruction</option>
              <option value="2">Transfer of Property</option>
              <option value="3">Donation of Property</option>
              <option value="4">Sale of Unserviceable Property</option>
               <option value="5">Incorrect Property Number</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Dispose</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</form>

<form action="{{ route('uploadassetregistrycsv') }}" method="POST"  enctype="multipart/form-data">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="modal" tabindex="-1" id="uploadnewcsv" role="dialog">
    <div>
      
    </div>
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div id="lod_uploadass" style=" position: fixed; display: block; z-index: 100; top: 0; bottom: 0; left: 0; right: 0; height: 100%; width:  100%; background-color: white; display:none;">
    <center>
<img class="mt-5" src="https://icon-library.net/images/ajax-loading-icon/ajax-loading-icon-2.jpg" style="width: 40px; padding-top: 100px;">
     <div class="container">
        <h5 class="mt-3 card-title">Validating Records</h5>
      <h6 class="card-subtitle text-muted">Please standby for a moment, this may take some time depending on your asset count.</h6></center>
     </div>

        <div class="modal-header">
          <h5 class="modal-title">Upload Capital Outlay Via CSV</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <div class="row">
           <div class="col-md-6">
          <div class="card" style="min-height: 145px;">
            <div class="card-body" >
               <div class="form-group" style="display: none;">
            <label>Station</label><br>
            <p id="theval"></p>
            <select class="form-control" required="" id="st_all" name="sc_id">
             
           </select>
          </div>
          <div class="form-group">
            <label>Upload Capital Outlay CSV File</label><br>
             <input type="file" id="file" required="" accept=".csv"  name="thecsvfile" onchange="return fileValidation()">
          </div>
            </div>
          </div>
           </div>
           <div class="col-md-6">

            <h6 class="card-title"><i class="fas fa-tasks"></i> Requirements</h6>
            <ol>
              <li>File format needs to be <span class="badge badge-success">.CSV</span></li>
              <li>File size must be below <span class="badge badge-success">5 MB</span></li>
              <li>CSV has <span class="badge badge-success">22 columns</span></li>
            </ol>
      
           </div>
         </div>
       
          <div class=" mt-2">
           <div class="card " id="panel_capital_previewscv" style="display: none;">
             <div class="card-body card-limited">
              <small class="text-muted float-right">Limited by 3 rows</small>
            <h5>Preview</h5>
              <table class="table table-bordered table-responsive">
                <tbody id="thetable">
                  <tr>
                    <td>Please upload a valid Asset Registry CSV file for the preview.</td>
                  </tr>
                </tbody>
              </table>
             </div>
           </div>
          </div>
  
        </div>
        <div class="modal-footer">
          <button type="submit" id="sub_butt" onclick="$('#lod_uploadass').css('display','block');" class="btn btn-primary"><i class="fas fa-upload"></i> Import</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</form>

  <script type="text/javascript">
    $("#tbl_ass").DataTable();
    $("#tbl_semiexpendable").DataTable();
    $("#tbl_supply").DataTable();
    var isokcsv = false;
    var hasclickedsemi = false;
    var hasclickedsupply = false;

    $("#btn_gotosemiexpendable").click(function(){
      if(hasclickedsemi == false){
        hasclickedsemi = true;
          LoadSemiExpendable();
      }
    })
    $("#btn_gotosuppytable").click(function(){
      if(hasclickedsupply == false){
        hasclickedsupply = true;
          getallofmysuppydata();
      }
    })
    var isokcsv_semiexpendable = false
    setInterval(function(){
      if($("#file").val() == "" || isokcsv == false){
        $("#sub_butt").css("display","none");
      }else{
        $("#sub_butt").css("display","block");
        $("#panel_capital_previewscv").css("display","block");
      }


       if($("#semifile").val() == "" || isokcsv_semiexpendable == false){
        $("#submitsemiexpendable").css("display","none");
      }else{
        $("#submitsemiexpendable").css("display","block");
         $("#panel_semi_previewscv").css("display","block");
        $("#issemivalid").html("<span class='badge badge-success'>Congrats, Uploaded file is valid!</span>");
      }




       if($("#supplyfile").val() == "" || isokcsv_semiexpendable == false){
        $("#submitsupplycsvbtn").css("display","none");
      }else{
        $("#submitsupplycsvbtn").css("display","block");
         $("#panel_semi_previewscv_supply").css("display","block");
        $("#issupplyvalid").html("<span class='badge badge-success'>Congrats, Uploaded file is valid!</span>");
      }



      var myschool_realid = $("#myschool_realid").val();
      var detaulscid = <?php echo json_encode(session("user_school")) ?>;

      if(myschool_realid == detaulscid){
        $(".importbutton").css("display","inline-block");
         $(".importbutton").prop("title","Click to start importing.");
         $(".importwarning").css("display","none");
      }else{
       $(".importbutton").css("display", "none");
       $(".importbutton").prop("title","Importing is disabled because you are viewing assets in another source.");
       $(".importwarning").css("display","inline-block");
      }
    },300)
    $("#submitsemiexpendable").click(function(){
        $("#lod_uploadsmi").css("display","block");
    })


 function LoadAllSCNamesForCapOut(){
   $.ajax({
    type: "POST",
    url: "{{ route('load_all_school_names') }}",
    data : {_token: "{{ csrf_token() }}"},
    success: function(data){
      $("#st_all").append(data);
      $("#st_all").val(<?php echo json_encode(session("user_school")); ?>);
    }
  })
 }

  function OpenAssetToDispose(control_obj){
    $("#the_asset_to_dispose_id").val($(control_obj).data("asset_id"));
  }
    LoadAssets();
  function LoadAssets(){
      var school_real_id = $("#myschool_realid").val();
      $.ajax({
        type : "POST",
        url : "{{ route('display_all_encoded_assets') }}",
        data : {_token:"{{ csrf_token()}}",selected_realid: school_real_id},
         success : function(data){
            $("#tbl_ass").DataTable().destroy();
            $("#allmyassests").html(data);
            $("#tbl_ass").DataTable();
             LoadAssetRegistrySummary(school_real_id);
         }
      })
    }
    function LoadAssetRegistrySummary(sc_id){
      $.ajax({
        type: "POST",
        url: "{{ route('loadassetvalsum') }}",
        data: {_token:"{{ csrf_token() }}",selected_realid:sc_id},
        success: function(data){
        $("#assvalsum").html(data);

            LoadSemiExpendable();
  
        }
      })
    }
    function fileValidation(){
      var fileInput = document.getElementById('file');
      var filePath = fileInput.value;
      var allowedExtensions = /(\.csv)$/i;
      var fd = new FormData();
      var files = $('#file')[0].files[0];
      fd.append('thecsvfile',files);
      fd.append('_token',"{{ csrf_token() }}");

      if(!allowedExtensions.exec(filePath)){
      alert("Only .csv file is allowed.");
      fileInput.value = '';
      $("#thetable").html("<tr><td><center>Please upload a valid Asset Registry CSV file for the preview.</center></td></tr>");
      return false;
      }else{
      // alert(filevalue);
      // Display CSV Preview
      $.ajax({
      type : "POST",
      url : "{{ route('preview_csv') }}",
      contentType: false,
      processData: false,
      enctype: 'multipart/form-data',
      data:fd,
      success: function(data){
        if(data == ""){
          isokcsv = false;
           $("#thetable").html("<tr><td><center>The CSV file does not met the specifications to be recognized as Asset Registry CSV file.</center></td></tr>");
        }else{
          isokcsv = true;
           $("#thetable").html(data);
        }
     
      }
      })
      }
  }

var hasloadedservicecenterssel = false;
  function LoadserviceCentersMine(){
    var stationidassigned =  $("#myschool_realid").val();
    $.ajax({
      type: "POST",
      url: "{{ route('shoot_all_ofmy_service_center') }}",
      data: {_token: "{{ csrf_token() }}",station_id: stationidassigned},
      success: function(data){
        $("#inp_servicecentersinput").html(data);
      }
    })
  }
  function LoadSemiExpendable(){
     var stationidassigned =  $("#myschool_realid").val();
     step_1();
     function step_1(){
      $.ajax({
      type: "POST",
      url: "{{ route('stole_semi_expendable_bystation') }}",
      data: {_token: "{{ csrf_token() }}",station_id: stationidassigned},
      success: function(data){
         $("#tbl_semiexpendable").DataTable().destroy();
        $("#tbl_allsemiexpends").html(data);
        var semiasscount = (data.match(/<tr>/g) || []).length;
        $("#semi_asscount").html(semiasscount);
         $("#tbl_semiexpendable").DataTable();
step_2();
      }
    })
     }

      function step_2(){
         $.ajax({
      type: "POST",
      url: "{{ route('stole_my_semiexpendable_descrepancies') }}",
      data: {_token: "{{ csrf_token() }}",station_id: stationidassigned,layout:"count"},
      success: function(data){
       $("#semidesccount").html(data);
step_3();
      }
    })
      }

       function step_3(){
        $.ajax({
        type:"POST",
        url: "{{ route('stole_semi_expendable_omitted') }}",
        data: {_token: "{{ csrf_token() }}",station_id: stationidassigned,layout:"count"},
        success: function(data){
          // alert(data);
          $("#semi_asssataomitted").html(data);
          step_4();
        }
       })
       }

       function step_4(){
        $.ajax({
        type:"POST",
        url:"{{ route('stole_last_date_ofcode') }}",
        data: {_token: "{{ csrf_token() }}",station_id: stationidassigned,givencode: "a01.1"},
        success: function(data){
           $("#semi_lastuploadof").html(data);
            getallofmysuppydata();
        }
       })
       }
    }
      function getallofmysuppydata(){
        var stationidassigned = $("#myschool_realid").val();

        $.ajax({
          type: "POST",
          url: "{{ route('stole_all_of_my_supply_data') }}",
          data: {_token: "{{ csrf_token() }}",station_id: stationidassigned},
          success: function(data){
              $("#tbl_supply").DataTable().destroy();
             $("#tbl_importedsupplies").html(data);
             $("#tbl_supply").DataTable();
          }
        })
      }

      function fileValidation_supplyfile(){
         var fileInput = document.getElementById('supplyfile');
      var filePath = fileInput.value;
      var allowedExtensions = /(\.csv)$/i;
      var fd = new FormData();
      var files = $('#supplyfile')[0].files[0];
      fd.append('thecsvfile',files);
      fd.append('_token',"{{ csrf_token() }}");

      if(!allowedExtensions.exec(filePath)){
      alert("Only .csv file is allowed.");
      fileInput.value = '';
      $("#thetable_semiexpendible_supply").html("<tr><td><center>Please upload a valid Asset Registry CSV file for the preview.</center></td></tr>");
      return false;
      }else{
      $.ajax({
      type : "POST",
      url : "{{ route('stole_preview_of_uploaded_supplyfile') }}",
      contentType: false,
      processData: false,
      enctype: 'multipart/form-data',
      data:fd,
      success: function(data){
        if(data.includes("Supply CSV file is not valid") == true){
          isokcsv_semiexpendable = false;
            $("#thetable_semiexpendible_supply").html(data);
            $("#panel_semi_previewscv_supply").css("display","block");
            $("#issupplyvalid").html("<span class='badge badge-danger'>Sorry, Uploaded file is not valid!</span>");
        }else{
            isokcsv_semiexpendable = true;
            $("#panel_semi_previewscv_supply").css("display","block");
            $("#thetable_semiexpendible_supply").html(data);
        }
      }
      })
      }
      }

  function fileValidation_semiexpendable(){
      var fileInput = document.getElementById('semifile');
      var filePath = fileInput.value;
      var allowedExtensions = /(\.csv)$/i;
      var fd = new FormData();
      var files = $('#semifile')[0].files[0];
      fd.append('thecsvfile',files);
      fd.append('_token',"{{ csrf_token() }}");

      if(!allowedExtensions.exec(filePath)){
      alert("Only .csv file is allowed.");
      fileInput.value = '';
      $("#thetable_semiexpendible").html("<tr><td><center>Please upload a valid Asset Registry CSV file for the preview.</center></td></tr>");
      return false;
      }else{
      // alert(filevalue);
      // Display CSV Preview
      $.ajax({
      type : "POST",
      url : "{{ route('shoot_preview_csv_semiexpendable') }}",
      contentType: false,
      processData: false,
      enctype: 'multipart/form-data',
      data:fd,
      success: function(data){
        if(data.includes("Semi Expendable CSV file is not valid") == true){
            isokcsv_semiexpendable = false;
            $("#thetable_semiexpendible").html(data);
            $("#panel_semi_previewscv").css("display","block");
            $("#issemivalid").html("<span class='badge badge-danger'>Sorry, Uploaded file is not valid!</span>");
        }else{
            isokcsv_semiexpendable = true;
            $("#panel_semi_previewscv").css("display","block");
            $("#thetable_semiexpendible").html(data);
        }
      }
      })
      }
  }
  </script>


  <div class="modal" tabindex="-1" id="semidispose" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Item Disposal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure that you want to dispose this Semi-Expendable asset?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger">Dispose</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection