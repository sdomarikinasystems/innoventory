@extends('master.master')

@section('title')
Innoventory - Disposed Assets
@endsection

@section('contents')
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Home</li>
		<li class="breadcrumb-item active" aria-current="page">Disposed Assets</li>
	</ol>
</nav>

 <?php
      if(session("user_type") == "0" || session("user_type") == "1"){
    ?>
  <!-- FOR ADMIN ONLY -->
    <a class="btn btn-secondary float-right dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
    <i class="fas fa-filter"></i> Filter Asset Source</a>
  
    <div class="dropdown-menu" style="width:450px; min-height: 300px;">
      <div class="container">
        <div class="form-group">
          <input type="text" class="form-control mt-3" id="searchss" placeholder="Search Station here..." name="">
        </div>
        <div class="form-group">
          <div class='mt-2'>
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

  <h4 class="mb-3 mt-3"><span id="sourcename">{{ session('user_changesource_station_name')}}</span></h4>
    <div class="card-deck mb-3">
      <div class="card card-shadow">
        <div class="card-body">
          <i style="color: #c0392b;" class="fas fa-circle"></i> Condemnation / Destruction
        </div>
      </div>
       <div class="card card-shadow">
        <div class="card-body">
          <i style="color: #27ae60;" class="fas fa-circle"></i> Transfer of Property
        </div>
      </div>
       <div class="card card-shadow">
        <div class="card-body">
          <i style="color:  #d35400;" class="fas fa-circle"></i> Incorrect Property Number
        </div>
      </div>
       <div class="card card-shadow">
        <div class="card-body">
          <i style="color: #2980b9;" class="fas fa-circle"></i> Donation of Property
        </div>
      </div>
       <div class="card card-shadow">
        <div class="card-body">
          <i style="color: #8e44ad;" class="fas fa-circle"></i> Sale of Unserviceable Property
        </div>
      </div>
  </div>
 <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="capout" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-box"></i> Capital Outlay</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fas fa-boxes"></i> <span >Semi-Expendable</span></a>
  </li>

</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="capout">
  
<div>

 <table class="table table-hover table-borderless" id="tbl_dis">
  <thead>
    <tr>
      <th scope="col">Property Number</th>
      <th scope="col">Asset Item</th>
      <th scope="col">Asset Classification</th>
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

<form action="" method="">
  <div class="modal" tabindex="-1" id="m_view" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Item Information</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Modal body text goes here.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</form>

<form action="../../restore_asset" method="POST">
  {{ csrf_field() }}
  <div class="modal" tabindex="-1" id="m_remove" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Item Restoration</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="the_asset_to_dispose_id" name="asset_id">
          <p>Restore this item from the Assets Registry?</p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Restore</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</form>

  </div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
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

</div>


  <script type="text/javascript">
 $("#sourcename").html("{{ session('user_changesource_station_name') }}");
  function OpenAssetToDispose(control_obj){
    $("#the_asset_to_dispose_id").val($(control_obj).data("asset_id"));
  }

  LoadAssets("{{ session('user_changesource_station') }}");
  function LoadAssets(station_id){
    $.ajax({
      type : "GET",
      url : "{{ route('asset_disp_disposed') }}",
      data : {_token:"{{ csrf_token()}}",id_of_something:station_id},
       success : function(data){
          $("#allmyassests").html(data);
          $("#tbl_dis").DataTable();
          LoadAssets_Semi(station_id);
       }
    })
  }
  function LoadAssets_Semi(station_id){
     $.ajax({
      type : "GET",
      url : "{{ route('stole_get_disposed_semiexpendable') }}",
      data : {_token:"{{ csrf_token()}}",sta_id:station_id},
       success : function(data){
          $("#tbl_allsemiexpends").html(data);
          $("#tbl_semiexpendable").DataTable();
       }
    })
  }

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

      var sourceid = $(control_obj).data("sourceid");
      var sourcename = $(control_obj).data("sourcename");
         $.ajax({
      type: "POST",
      url: "{{ route('shoot_univ_change_source') }}",
      data: {_token : "{{ csrf_token() }}", new_source_id: sourceid, new_source_name: sourcename },
      success: function(){
        location.reload();
      }
    })
   
        
     }
     function gotomyownassets(){
      var sourceid =  <?php echo json_encode(session("user_school")); ?>;
      var sourcename =  <?php echo json_encode(session("user_schoolname")); ?>;
       $.ajax({
      type: "POST",
      url: "{{ route('shoot_univ_change_source') }}",
      data: {_token : "{{ csrf_token() }}", new_source_id: sourceid, new_source_name: sourcename },
      success: function(){
        location.reload();
      
      }
    })
   
     
     }
  </script>

@endsection