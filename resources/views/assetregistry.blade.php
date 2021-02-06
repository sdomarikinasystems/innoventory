@extends('master.master')

@section('title')
Innoventory - Asset Registry
@endsection

@section('contents')
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page"><a href="/innoventory/dashboard">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Asset Registry</li>
	</ol>
</nav>
<input type="hidden" value="{{ session('user_changesource_station') }}" id="myschool_realid" name="">
<div class="mobiletext">
<div id="lod_change_ass_source" style="display:none; top: 0; right: 0; left: 0; bottom: 0; position: fixed; background-color: rgba(0,0,0,0.5); z-index: 100;">
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
          <input type="text" class="form-control mt-3" id="searchss" autocomplete="off" placeholder="Search Station here..." name="">
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
  <h4 class="mb-3"><span id="sourcename">{{ session('user_changesource_station_name') }}</span></h4>
  <!--ASSET REGISTRY-->
  <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active"  data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-box"></i> <span >Capital Outlay</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  data-toggle="pill" id="btn_gotosemiexpendable" href="#semiexpendable" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-boxes"></i> <span >Semi-Expendable</span></a>
    </li>
    <li class="nav-item" style="display: none;">
      <a class="nav-link"  data-toggle="pill" id="btn_gotosuppytable" href="#suplliestbl" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-parachute-box"></i> <span >Supplies</span></a>
    </li>
  </ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show" id="suplliestbl" role="tabpanel" aria-labelledby="pills-home-tab">
    <div class="row mb-4">
      <div class="col-lg-3">
        <div style="height: 158px;" class="card card-shadow">
        <div class="card-body d-flex flex-column">
          <div>
            <p class="m-0">Supply</p>
            <small class="m-0 text-muted">Supply feature is not ready for use but you're fress to test it.</small>
          </div>
           <a class="btn btn-success importbutton btn-sm mt-auto" href="#" data-toggle="modal" id="imp_sem" data-target="#modal_importsupp"><i class="fas fa-file-import"></i> Import Supply</a>
   <div class="importwarning" role="alert">

    </div>
        </div>
      </div>
      </div>
      <div class="col-lg-9">
         <div style="height: 158px;" class="card card-shadow">
        <div class="card-body">
          
<table class="table table-hover table-borderless">
      <thead>
        <tr>
          <th>Total Assets</th>
          <th>Discrepancies</th>
          <th>Omitted</th>
          <th><?php
          if(session("user_type") == "0" || session("user_type") == "1"){
          ?>
            <div class="dropdown">
            <a class="btn btn-link float-right btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-caret-down"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#unicleardata" onclick="ClearAssetData(this)" data-datatoclear="Supply"><i class="fas fa-trash"></i> Clear Supply Data</a>
            </div>
            </div>
          <?php
          }
          ?>As of</th>
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
      </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
          <table class="table table-hover table-borderless" id="tbl_supply">
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
               <div id="lod_uploadsupp" style="display:none; top: 0; right: 0; left: 0; bottom: 0; position: fixed; background-color: rgba(0,0,0,0.5); z-index: 100;">
              <div style="margin:auto; width: 540px; margin-top: 35vh; ">
      <div class="card card-shadow" style=" border-radius: 10px !important;
    animation-name: scale-in;
    animation-duration: 0.3s;
    overflow:hidden;
    border-color: #EEEEF2 !important;">
        <div class="card-body">
          <div class="mt-4 mb-4">
    <h5 class="mb-0" ><img src="https://uploads.toptal.io/blog/image/122385/toptal-blog-image-1489082610696-459e0ba886e0ae4841753d626ff6ae0f.gif" style="width: 25px; margin-right: 10px;">Uploading & Validating Records</h5>
    <p class="text-muted mt-0 mb-0" >Please wait while we upload your csv file and check for your records.</p>
          </div>
        </div>
      </div>
    </div>
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
                        <table class="table table-hover table-borderless table-responsive">
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

    <div class="row mb-3">
     <div class="col-lg-3">
        <div class="card card-shadow" style="height: 158px;">
        <div class="card-body d-flex flex-column">
            <div id="readystatus_se"></div>
           <a class="btn btn-success mt-auto btn-sm importbutton" href="#" data-toggle="modal" onclick="  LoadserviceCentersMine()" id="imp_sem" title="Import Semi-Expendable" data-target="#chooseserv"><i class="fas fa-file-import" ></i> Import</a>
    <div class="importwarning" role="alert">
     
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


            <div id="lod_uploadsmi" style="display:none; top: 0; right: 0; left: 0; bottom: 0; position: fixed; background-color: rgba(0,0,0,0.5); z-index: 100;">
              <div style="margin:auto; width: 540px; margin-top: 35vh; ">
      <div class="card card-shadow" style=" border-radius: 10px !important;
    animation-name: scale-in;
    animation-duration: 0.3s;
    overflow:hidden;
    border-color: #EEEEF2 !important;">
        <div class="card-body">
          <div class="mt-4 mb-4">
    <h5 class="mb-0" ><img src="https://uploads.toptal.io/blog/image/122385/toptal-blog-image-1489082610696-459e0ba886e0ae4841753d626ff6ae0f.gif" style="width: 25px; margin-right: 10px;">Uploading & Validating Records</h5>
    <p class="text-muted mt-0 mb-0" >Please wait while we upload your csv file and check for your records.</p>
          </div>
        </div>
      </div>
    </div>



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
                <div class="card card-shadow">
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
              <table class="table table-hover table-borderless table-responsive">
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
      </div>
     </div>
 <div class="col-lg-9">
        <div class="card card-shadow" style="height: 158px;">
        <div class="card-body">
          <table class="table table-hover table-borderless">
      <thead>
        <tr>
          <th>Total Assets</th>
          <th>Discrepancies</th>
          <th>Omitted</th>
          <th>                         <?php
    if(session("user_type") == "0" || session("user_type") == "1"){
  ?>
 <div class="dropdown">
            <a class="btn btn-link float-right btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-caret-down"></i>
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#unicleardata"  onclick="ClearAssetData(this)" data-datatoclear="Semi-Expendable"><i class="fas fa-trash"></i> Clear Semi-Expendable Data</a>
            </div>
          </div>
  <?php
    }
  ?> As of</th>
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
 </div>
    </div>
      <div class="row">
</div>
    <table class="table table-hover table-borderless" id="tbl_semiexpendable">
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
       <?php
      if(session("user_type") < "4" && session("user_type") != "2"){
    ?>
<div class="row mb-3">
 
  <div class="col-lg-3">
    <div class="card card-shadow" style="height: 158px;">
    <div class="card-body d-flex flex-column">
        
    <!-- FOR SUPPLY OFFICER AND PROPERTY CUSTODIAN ONLY -->
    <div id="readystatus_co"></div>
    <a class="btn btn-success importbutton m-0 btn-sm mt-auto" href="#" title="Import Capital Outlay" data-toggle="modal" data-target="#uploadcapitaloutlaymodal" onclick="LoadAllSCNamesForCapOut()"><i class="fas fa-file-import"></i> Import</a>

     <div class="importwarning" role="alert">
     
    </div>
  
    </div>
  </div>
  </div>
   
  <div class="col-lg-9">
    <div class="card card-shadow" style="height: 158px;">
    <div class="card-body">
       <table class="table table-hover table-borderless">
      <thead>
        <tr>
          <th>Total Assets</th>
          <th>Discrepancies</th>
          <th>Not Inserted</th>
          <th>Omitted</th>
          <th>
                                   <?php
    if(session("user_type") == "0" || session("user_type") == "1"){
  ?>
 <div class="dropdown">
            <a class="btn btn-link float-right btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-caret-down"></i>
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#unicleardata"  onclick="ClearAssetData(this)" data-datatoclear="Capital Outlay"><i class="fas fa-trash"></i> Clear Capital Outlay Data</a>
            </div>
          </div>
  <?php
    }
  ?>
        As of</th>
        </tr>
      </thead>
      <tbody id="assvalsum">
        <tr>
          <td>0</td>
          <td>0</td>
          <td>0</td>
          <td>0</td>
          <td>0</td>
        </tr>
      </tbody>
    </table>
    </div>
  </div>
  </div>
</div>

<?php } ?>
      <div class="row">

</div>
      <table class="table table-hover table-borderless" id="tbl_ass">
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
          <h5 class="modal-title">Item Disposal (Capital Outlay)</h5>
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
  <div class="modal" tabindex="-1" id="uploadcapitaloutlaymodal" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div id="lod_uploadass" style=" position: fixed; display: block; z-index: 100; top: 0; bottom: 0; left: 0; right: 0; height: 100%; width:  100%; background-color: rgba(0,0,0,0.5); border-radius:15px; display:none;">
              <div style="margin:auto; width: 540px; margin-top: 35vh; ">
      <div class="card card-shadow" style=" border-radius: 10px !important;
    animation-name: scale-in;
    animation-duration: 0.3s;
    overflow:hidden;
    border-color: #EEEEF2 !important;">
        <div class="card-body">
          <div class="mt-4 mb-4">
    <h5 class="mb-0" ><img src="https://uploads.toptal.io/blog/image/122385/toptal-blog-image-1489082610696-459e0ba886e0ae4841753d626ff6ae0f.gif" style="width: 25px; margin-right: 10px;">Uploading & Validating Records</h5>
    <p class="text-muted mt-0 mb-0" >Please wait while we upload your csv file and check for your records.</p>
          </div>
        </div>
      </div>
    </div>



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
          <div class="card card-shadow" style="min-height: 145px;">
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
              <table class="table table-hover table-borderless table-responsive">
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


<div class="modal" tabindex="-1" role="dialog" id="unicleardata">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Clear <span class="assdataname"></span> Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="mt-5 mb-5">All of <span class="assdataname"></span> on this selected station will be permanently deleted with its omitted data. Inventory and Resource files will not be inluded in this deletion.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="ProceedToAssetDeletion()"><i class="fas fa-trash"></i> Clear <span class="assdataname"></span></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal" tabindex="-1" role="dialog" id="notinserted_co">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Not Inserted Capital Outlay</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <div class="card-body">
        <table class="table table-hover table-borderless" id="tbl_notinscap">
          <thead>
            <tr>
              <th>Property #</th>
              <th>Asset Item</th>
              <th>Specification</th>
              <th>Condition</th>
              <th>Service Center</th>
              <th>Room</th>
              <th style="width: 30%;">Reason</th>
            </tr>
          </thead>
          <tbody id="thenotinsdataofco">
          </tbody>
        </table>
     </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
var hasloadednotinserted = false;
function load_not_inserted_co() {
  if (hasloadednotinserted == false) {
    var curr_sc = $("#myschool_realid").val();
      $("#tbl_notinscap").DataTable().destroy();
      $("#thenotinsdataofco").html(localStorage.getItem("lonoinsco"));
   $("#tbl_notinscap").DataTable();
    $.ajax({
      type: "POST",
      url: "{{ route('stole_not_inserted_recent_co_data') }}",
      data: {
        _token: "{{ csrf_token() }}",
        current_station: curr_sc
      },
      success: function (data) {
        localStorage.setItem("lonoinsco",data);
        $("#tbl_notinscap").DataTable().destroy();
        $("#thenotinsdataofco").html(data);
        $("#tbl_notinscap").DataTable();
      }
    })
    hasloadednotinserted = true;
  }
}
$("#searchss").change(function () {
  var skey = $("#searchss").val();
  $.ajax({
    type: "POST",
    url: "{{ route('search_asstov') }}",
    data: {
      _token: "{{ csrf_token() }}",
      searchkey: skey
    },
    success: function (data) {
      if (data == "") {
        $("#search_narrative").html("No result found.");
        $("#school_search_cont").css("display", "none");
        $("#search_narrative").css("display", "block");
      } else {
        $("#school_search_cont").css("display", "block");
        $("#search_narrative").css("display", "none");
        $("#school_search_cont").html(data);
      }
      $("#searchss").val("");
    }
  })
})

function changesource(control_obj) {
  hasloadednotinserted = false;
  var sourceid = $(control_obj).data("sourceid");
  var sourcename = $(control_obj).data("sourcename");
  $("#myschool_realid").val(sourceid);
  $(".source_id_dynamic").val(sourceid);
  $("#sourcename").html(sourcename);
  $("#lod_change_ass_source").css("display", "block");

  $.ajax({
    type: "POST",
    url: "{{ route('shoot_univ_change_source') }}",
    data: {
      _token: "{{ csrf_token() }}",
      new_source_id: sourceid,
      new_source_name: sourcename
    },
    success: function () {
      location.reload();

    }
  })

}

function gotomyownassets() {
  hasloadednotinserted = false;

  var sourceid = <?php echo json_encode(session("user_school")); ?>;
  var sourcename = <?php echo json_encode(session("user_schoolname")); ?>;
  $.ajax({
    type: "POST",
    url: "{{ route('shoot_univ_change_source') }}",
    data: {
      _token: "{{ csrf_token() }}",
      new_source_id: sourceid,
      new_source_name: sourcename
    },
    success: function () {
      location.reload();
    }
  })
}

var dttoclear;

function ClearAssetData(control_obj) {
  dttoclear = $(control_obj).data("datatoclear");
  $(".assdataname").html(dttoclear);
}

function ProceedToAssetDeletion() {

  var stid = $("#myschool_realid").val();
  // alert(stid);
  $.ajax({
    type: "POST",
    url: "{{ route('shoot_delete_specific_assetdata_all') }}",
    data: {
      _token: "{{ csrf_token() }}",
      station_id: stid,
      asset_type: dttoclear
    },
    success: function (data) {
      alert(dttoclear + " asset clearing process completed!");
      CheckRediness();
    }
  })

}


$("#tbl_ass").DataTable();
$("#tbl_semiexpendable").DataTable();
$("#tbl_supply").DataTable();
var isokcsv = false;
var hasclickedsemi = false;
var hasclickedsupply = false;

$("#btn_gotosemiexpendable").click(function () {
  if (hasclickedsemi == false) {
    hasclickedsemi = true;
    LoadSemiExpendable();
  }
})
$("#btn_gotosuppytable").click(function () {
  if (hasclickedsupply == false) {
    hasclickedsupply = true;
    getallofmysuppydata();
  }
})
var isokcsv_semiexpendable = false
setInterval(function () {
  if ($("#file").val() == "" || isokcsv == false) {
    $("#sub_butt").css("display", "none");
  } else {
    $("#sub_butt").css("display", "block");
    $("#panel_capital_previewscv").css("display", "block");
  }


  if ($("#semifile").val() == "" || isokcsv_semiexpendable == false) {
    $("#submitsemiexpendable").css("display", "none");
  } else {
    $("#submitsemiexpendable").css("display", "block");
    $("#panel_semi_previewscv").css("display", "block");
    $("#issemivalid").html("<span class='badge badge-success'>Congrats, Uploaded file is valid!</span>");
  }


  if ($("#supplyfile").val() == "" || isokcsv_semiexpendable == false) {
    $("#submitsupplycsvbtn").css("display", "none");
  } else {
    $("#submitsupplycsvbtn").css("display", "block");
    $("#panel_semi_previewscv_supply").css("display", "block");
    $("#issupplyvalid").html("<span class='badge badge-success'>Congrats, Uploaded file is valid!</span>");
  }


  var myschool_realid = $("#myschool_realid").val();
  var detaulscid = <?php echo json_encode(session("user_school")) ?>;

  if (myschool_realid == detaulscid) {
    $(".importbutton").css("display", "inline-block");
    $(".importbutton").prop("title", "Click to start importing.");
    $(".importwarning").css("display", "none");
  } else {
    $(".importbutton").css("display", "none");
    $(".importbutton").prop("title", "Importing is disabled because you are viewing assets in another source.");
    $(".importwarning").css("display", "inline-block");
  }
}, 300)
$("#submitsemiexpendable").click(function () {
  $("#lod_uploadsmi").css("display", "block");
})


function LoadAllSCNamesForCapOut() {
  $.ajax({
    type: "POST",
    url: "{{ route('load_all_school_names') }}",
    data: {
      _token: "{{ csrf_token() }}"
    },
    success: function (data) {
      $("#st_all").append(data);
      $("#st_all").val(<?php echo json_encode(session("user_school")); ?>);
    }
  })
}
function OpenAssetToDispose(control_obj) {
  $("#the_asset_to_dispose_id").val($(control_obj).data("asset_id"));
}
var currentlyready = "";
CheckRediness();
  async function CheckRediness(){
      var myschool_realid = $("#myschool_realid").val();
      currentlyready = localStorage.getItem("currentlyready_ar");
RenderReady();
$("#tbl_ass").DataTable().destroy();
$("#allmyassests").html(localStorage.getItem("dt_cap_out_preload"));
$("#assvalsum").html(localStorage.getItem("assval_co_summary"));
$("#tbl_ass").DataTable();
  $.ajax({
      type: "GET",
      url: "{{ route('stole_checkready_specific') }}",
      data: {_token: "{{ csrf_token() }}",user_school: myschool_realid},
      success:async function(data){
         localStorage.setItem("currentlyready_ar",data);
        currentlyready = data;
        RenderReady();
        LoadAssets();
      }
    })
}
function RenderReady(){
  if(currentlyready != null){
    if(currentlyready.includes("co")){
          $("#readystatus_co").html("<p class='mb-0 text-success'><i class='fas fa-check'></i> Ready</p><small class='text-muted m-0'>" +
            "Congratulations!, Capital Outlay has zero discrepancies."
           +"</small>");
        }else{
          $("#readystatus_co").html("<p class='mb-0 text-danger'><i class='fas fa-times'></i> Not Ready</p><small class='text-muted m-0'>" +
            "Your Capital Outlay has discrepancies left."
           +"</small>");
        }
        if(currentlyready.includes("se")){
          $("#readystatus_se").html("<p class='mb-0 text-success'><i class='fas fa-check'></i> Ready</p><small class='text-muted m-0'>" +
            "Congratulations!, Semi-Expendable has zero discrepancies."
           +"</small>");
        }else{
           $("#readystatus_se").html("<p class='mb-0 text-danger'><i class='fas fa-times'></i> Not Ready</p><small class='text-muted m-0'>" +
            "Your Semi-Expendable has discrepancies left."
            +"</small>");
        }
  }
  
}
function LoadAssets() {
  var school_real_id = $("#myschool_realid").val();
    
  $.ajax({
    type: "GET",
    url: "{{ route('display_all_encoded_assets') }}",
    data: {
      _token: "{{ csrf_token()}}",
      selected_realid: school_real_id
    },
    success: function (data) {
      localStorage.setItem("dt_cap_out_preload",data);
      $("#tbl_ass").DataTable().destroy();
      $("#allmyassests").html(data);
      $("#tbl_ass").DataTable();
      LoadAssetRegistrySummary(school_real_id);
    }
  })
}

function LoadAssetRegistrySummary(sc_id) {
  var school_real_id = $("#myschool_realid").val();
   
  $.ajax({
    type: "POST",
    url: "{{ route('loadassetvalsum') }}",
    data: {
      _token: "{{ csrf_token() }}",
      selected_realid: school_real_id
    },
    success: function (data) {
      localStorage.setItem("assval_co_summary",data);
      $("#assvalsum").html(data);
      LoadSemiExpendable();
    }
  })
}

function fileValidation() {
  var fileInput = document.getElementById('file');
  var filePath = fileInput.value;
  var allowedExtensions = /(\.csv)$/i;
  var fd = new FormData();
  var files = $('#file')[0].files[0];
  fd.append('thecsvfile', files);
  fd.append('_token', "{{ csrf_token() }}");

  if (!allowedExtensions.exec(filePath)) {
    alert("Only .csv file is allowed.");
    fileInput.value = '';
    $("#thetable").html("<tr><td><center>Please upload a valid Asset Registry CSV file for the preview.</center></td></tr>");
    return false;
  } else {
    // alert(filevalue);
    // Display CSV Preview
    $.ajax({
      type: "POST",
      url: "{{ route('preview_csv') }}",
      contentType: false,
      processData: false,
      enctype: 'multipart/form-data',
      data: fd,
      success: function (data) {
        if (data == "") {
          isokcsv = false;
          $("#thetable").html("<tr><td><center>The CSV file does not met the specifications to be recognized as Asset Registry CSV file.</center></td></tr>");
        } else {
          isokcsv = true;
          $("#thetable").html(data);
        }

      }
    })
  }
}

var hasloadedservicecenterssel = false;

function LoadserviceCentersMine() {
  if(hasloadedservicecenterssel == false){
    hasloadedservicecenterssel = true;
    var stationidassigned = $("#myschool_realid").val();
  $.ajax({
    type: "GET",
    url: "{{ route('shoot_all_ofmy_service_center') }}",
    data: {
      _token: "{{ csrf_token() }}",
      station_id: stationidassigned
    },
    success: function (data) {
      $("#inp_servicecentersinput").html(data);
    }
  })
  }
  
}

function LoadSemiExpendable() {
  var stationidassigned = $("#myschool_realid").val();
  step_1();

  function step_1() {
    $.ajax({
      type: "GET",
      url: "{{ route('stole_semi_expendable_bystation') }}",
      data: {
        _token: "{{ csrf_token() }}",
        station_id: stationidassigned
      },
      success: function (data) {
        $("#tbl_semiexpendable").DataTable().destroy();
        $("#tbl_allsemiexpends").html(data);
        var semiasscount = (data.match(/<tr>/g) || []).length;
        $("#semi_asscount").html(semiasscount);
        $("#tbl_semiexpendable").DataTable();
        step_2();
      }
    })
  }

  function step_2() {
    $.ajax({
      type: "GET",
      url: "{{ route('stole_my_semiexpendable_descrepancies') }}",
      data: {
        _token: "{{ csrf_token() }}",
        station_id: stationidassigned,
        layout: "count"
      },
      success: function (data) {
        $("#semidesccount").html(data);
        step_3();
      }
    })
  }

  function step_3() {
    $.ajax({
      type: "GET",
      url: "{{ route('stole_semi_expendable_omitted') }}",
      data: {
        _token: "{{ csrf_token() }}",
        station_id: stationidassigned,
        layout: "count"
      },
      success: function (data) {
        // alert(data);
        $("#semi_asssataomitted").html(data);
        step_4();
      }
    })
  }

  function step_4() {
    $.ajax({
      type: "GET",
      url: "{{ route('stole_last_date_ofcode') }}",
      data: {
        _token: "{{ csrf_token() }}",
        station_id: stationidassigned,
        givencode: "a01.1"
      },
      success: function (data) {
        $("#semi_lastuploadof").html(data);
        getallofmysuppydata();
      }
    })
  }
}

function getallofmysuppydata() {
  var stationidassigned = $("#myschool_realid").val();

  $.ajax({
    type: "POST",
    url: "{{ route('stole_all_of_my_supply_data') }}",
    data: {
      _token: "{{ csrf_token() }}",
      station_id: stationidassigned
    },
    success: function (data) {
      $("#tbl_supply").DataTable().destroy();
      $("#tbl_importedsupplies").html(data);
      $("#tbl_supply").DataTable();
    }
  })
}

function fileValidation_supplyfile() {
  var fileInput = document.getElementById('supplyfile');
  var filePath = fileInput.value;
  var allowedExtensions = /(\.csv)$/i;
  var fd = new FormData();
  var files = $('#supplyfile')[0].files[0];
  fd.append('thecsvfile', files);
  fd.append('_token', "{{ csrf_token() }}");

  if (!allowedExtensions.exec(filePath)) {
    alert("Only .csv file is allowed.");
    fileInput.value = '';
    $("#thetable_semiexpendible_supply").html("<tr><td><center>Please upload a valid Asset Registry CSV file for the preview.</center></td></tr>");
    return false;
  } else {
    $.ajax({
      type: "POST",
      url: "{{ route('stole_preview_of_uploaded_supplyfile') }}",
      contentType: false,
      processData: false,
      enctype: 'multipart/form-data',
      data: fd,
      success: function (data) {
        if (data.includes("Supply CSV file is not valid") == true) {
          isokcsv_semiexpendable = false;
          $("#thetable_semiexpendible_supply").html(data);
          $("#panel_semi_previewscv_supply").css("display", "block");
          $("#issupplyvalid").html("<span class='badge badge-danger'>Sorry, Uploaded file is not valid!</span>");
        } else {
          isokcsv_semiexpendable = true;
          $("#panel_semi_previewscv_supply").css("display", "block");
          $("#thetable_semiexpendible_supply").html(data);
        }
      }
    })
  }
}

function fileValidation_semiexpendable() {
  var fileInput = document.getElementById('semifile');
  var filePath = fileInput.value;
  var allowedExtensions = /(\.csv)$/i;
  var fd = new FormData();
  var files = $('#semifile')[0].files[0];
  fd.append('thecsvfile', files);
  fd.append('_token', "{{ csrf_token() }}");

  if (!allowedExtensions.exec(filePath)) {
    alert("Only .csv file is allowed.");
    fileInput.value = '';
    $("#thetable_semiexpendible").html("<tr><td><center>Please upload a valid Asset Registry CSV file for the preview.</center></td></tr>");
    return false;
  } else {
    $.ajax({
      type: "POST",
      url: "{{ route('shoot_preview_csv_semiexpendable') }}",
      contentType: false,
      processData: false,
      enctype: 'multipart/form-data',
      data: fd,
      success: function (data) {
        if (data.includes("Semi Expendable CSV file is not valid") == true) {
          isokcsv_semiexpendable = false;
          $("#thetable_semiexpendible").html(data);
          $("#panel_semi_previewscv").css("display", "block");
          $("#issemivalid").html("<span class='badge badge-danger'>Sorry, Uploaded file is not valid!</span>");
        } else {
          isokcsv_semiexpendable = true;
          $("#panel_semi_previewscv").css("display", "block");
          $("#thetable_semiexpendible").html(data);
        }
      }
    })
  }
}

function preparesemidisposal(control_obj){
  var semi_expendable_id = $(control_obj).data("itemid");
  $("#item_semi_todispose").val(semi_expendable_id);
}
  </script>


<form action="{{ route('shoot_dispose_semi_expendable') }}" method="POST">
    <div class="modal" tabindex="-1" id="semidispose" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Item Disposal (Semi-Expendable)</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{ csrf_field() }}
          <input type="hidden" id="item_semi_todispose" name="asset_id">
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
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Dispose</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>
      </div>
    </div>
  </div>
</div>
</form>
@endsection