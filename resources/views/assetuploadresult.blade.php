@extends('master.master')

@section('title')
Inno... - Capital Outlay Upload Result
@endsection

@section('contents')
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page"><a href="/innoventory/dashboard">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page"><a href="/innoventory/asset/registry">Asset Registry</a></li>
		<li class="breadcrumb-item active" aria-current="page">Capital Outlay - Upload Summary</li>
	</ol>
</nav>

<div class="row">
	<div class="col-sm-12">
		<div class="card-deck mb-3">
			<div class="card card-shadow">
				<div class="card-body">
					<h6 class="text-muted mt-0 mb-0">Total CSV Assets</h6>
					<h2 class="mb-0 mt-0">{{ $_GET['total_assets'] }}</h2>
				</div>
			</div>
			<div class="card card-shadow">
				<div class="card-body">
					<h6 class="text-muted mt-0 mb-0">Inserted</h6>
					<h2 class="mb-0 mt-0">{{ $_GET['i_newly'] }}</h2>
				</div>
			</div>
			<div class="card card-shadow">
				<div class="card-body">
					<h6 class="text-muted mt-0 mb-0">Not Inserted</h6>
					<h2 class="mb-0 mt-0">{{ $_GET['i_not'] }}</h2>
				</div>
			</div>
			<div class="card card-shadow">
				<div class="card-body">
					<h6 class="text-muted mt-0 mb-0">Updated</h6>
					<h2 class="mb-0 mt-0">{{ $_GET['i_existing'] }}</h2>
				</div>
			</div>
			<div class="card card-shadow">
				<div class="card-body">
					<h6 class="text-muted mt-0 mb-0">Incomplete</h6>
					<h2 class="mb-0 mt-0">{{ $_GET['i_incomplete'] }}</h2>
				</div>
			</div>
			<div class="card card-shadow">
				<div class="card-body">
					<h6 class="text-muted mt-0 mb-0">Omitted</h6>
					<h2 class="mb-0 mt-0">{{ $_GET['omcount'] }}</h2>
				</div>
			</div>
			<div class="card card-shadow">
				<div class="card-body">
					<h6 class="text-muted mt-0 mb-0">New Service Center(s)</h6>
					<h2 class="mb-0 mt-0"><a href="#" data-toggle="modal" data-target="#modal_newservice_centers" id="idnewfoundservicecentercount">0</a></h2>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-12 mb-4">

		 <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
		  <li class="nav-item">
		    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-exclamation-triangle"></i> Discrepancies</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fas fa-search-minus"></i> Omitted</a>
		  </li>

		</ul>
		<div class="tab-content" id="pills-tabContent">
		  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
				<table class="table table-bordered table-striped " id="tbl_allregups">
					<thead>
						<tr>
							<th>Property Number</th>
							<th>Asset Item</th>
							<th>Issue</th>
						</tr>
					</thead>
					<tbody>
						<?php echo gzuncompress($_GET["i_logs"]); ?>
					</tbody>
				</table>
		  </div>
		  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
<table class="table table-bordered table-striped " id="tbl_allomitt">
					<thead>
						<tr>
						  <th scope="col">Property Number</th>
						  <th scope="col">Asset Item</th>
						</tr>
					</thead>
					<tbody>
						<?php echo gzuncompress($_GET["om_logs"]); ?>
					</tbody>
				</table>
		  </div>

		</div>

	</div>
</div>


<form action="{{ route('importallfoundservicecenters') }}" method="POST">
		{{ csrf_field() }}
		<div class="modal" tabindex="-1" id="modal_newservice_centers" role="dialog">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">New Service Center(s) Found</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	       <table class="table table-striped" id="todtnow">
	       	<thead>
	       		<tr>
	       			<th>Service Centers</th>
	       			<th>Room #</th>
	       			<th>Items</th>
	       		</tr>
	       	</thead>
	       	<tbody id="tbl_neesercen">
	       		
	       	</tbody>
	       </table>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-success"><i class="fas fa-warehouse"></i> Import All New Service Centers</button>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>


<script type="text/javascript">

	
  $("#tbl_allregups").DataTable();

  var omcount = <?php echo json_encode($_GET["omcount"]); ?>;
  if(omcount != ""){
 $("#tbl_allomitt").DataTable();
 $("#om_panel").css("display","block");
  }else{
    $("#om_panel").css("display","none");
  }
  
  CheckForNewServiceCenters();
  function CheckForNewServiceCenters(){
  	// GET COUNT
  	$.ajax({
  		type: "POST",
  		url: "{{ route('findnewservicecentercount') }}",
  		data: {_token:"{{ csrf_token() }}"},
  		success:function(data){
  			$("#idnewfoundservicecentercount").html(data);
  		}
  	})
  	// GET SERVICE CENTERS
  	$.ajax({
  		type: "POST",
  		url: "{{ route('findnewsercen') }}",
  		data: {_token:"{{ csrf_token() }}"},
  		success:function(data){
  			// alert(data);
  			if(data != ""){
  				// $("#modal_newservice_centers").modal("show");
  				// console.log(data);
  			$("#tbl_neesercen").html(data);
  			$("#todtnow").DataTable();
  			}
  			
  		}
  	})
  }
</script>
@endsection