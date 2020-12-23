@extends('master.master')

@section('title')
ProcMS - Innoventory
@endsection

@section('contents')

<h2>Asset Registry - Omitted Assets</h2>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('dboard') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('assetregistry') }}">Asset Registry</a></li>
		<li class="breadcrumb-item active" aria-current="page">Omitted Assets</li>
	</ol>
</nav>

<div class="row mt-3">
	<div class="col-md-4">
		<div class="mb-3">
			<!-- <button class="btn-warning btn" data-toggle='modal' data-target='#modal_ignoreall'><i class="fas fa-thumbs-down"></i> Ignore All</button> -->
			<!-- <button class="btn btn-danger" data-toggle="modal" data-target="#repall"><i class="fas fa-flag"></i> Report All</button> -->
		</div>
	</div>
	<div class="col-sm-4">
	</div>
	<div class="col-sm-4">
		<div class="alert alert-info mb-3" role="alert">
			  Omitted asset(s) can still be scanned from the mobile app unless you <strong><i class="fas fa-flag"></i> Report</strong> them for deletion.
			</div>
	</div>
	<div class="col-md-12 table-responsive table-striped"> 
		<table class="table table-hover table-bordered" id="tbl_omass">
			<thead>
				<tr>
					<th scope="col">Property Number</th>
					<th scope="col">Asset Item</th>
					<th scope="col">Asset Classification</th>
					<th scope="col">Current Condition</th>
					<th scope="col">Asset Location</th>
					<th scope="col">Room</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody id="tbl_omitted">

			</tbody>
		</table>
	</div>
</div>

<form action="{{ route('reportallomassets') }}" method="POST">
	<div class="modal" tabindex="-1" role="dialog" id="repall">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Report All</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	 	{{ csrf_field() }}

	        <div class="form-group">
			        	<label>Please specify here</label>
			        	<textarea required="" class="form-control" rows="8" name="remarks" id="remfield" placeholder="Please specify your reason here..."></textarea>
			        </div>


	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-danger">Submit Report</button>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>


<form action="{{ route('clear_omass') }}" method="POST">
	<div class="modal" tabindex="-1" role="dialog" id="modal_ignoreall">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Ignore All Omitted Assets</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	{{ csrf_field() }}
	        <p>Omitted assets represent asset records that are not found in your last Asset Registry upload.</p><p> Make sure that you re-encoded these assets on your asset registry to prevent these assets from being omitted again.</p>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-danger">Yes, ignore all!</button>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>

<form action="{{ route('ig_sin_om') }}" method="POST">
	<div class="modal" tabindex="-1" role="dialog" id="modal_ignoresingleton">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Ignore this Omitted Asset</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	  		{{ csrf_field() }}
	      	<input type="hidden" id="ignoreommitid" name="asset_id">
	        <p>This asset will be excluded to the omitted list.</p>
	        <div class="alert alert-warning" role="alert">
	          Omitted assets represent asset records that are not found in your last Asset Registry upload.

Make sure that you re-encoded these assets on your asset registry to prevent these assets from being omitted again.
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-danger">Ignore</button>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>

<form action="{{ route('report_omitted_singleton') }}" method="POST">
	{{ csrf_field() }}
	<div class="modal" tabindex="-1" role="dialog" id="modal_report_asset">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Report Asset</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<input type="hidden" id="reportid" name="idofassetinregistry">
	      	<div class="row">
	      		<div class="col-sm-12">
	      			 <div class="form-group">
	        	<label>Specify the reason</label>
	        <select class="form-control" id="spec_reason" required="" name="reason">
	        	<option disabled="" value="" required selected="">Choose here...</option>
	        	<option value="0">Updated Property Number</option>
	        	<option value="1">Double Insertion of Property Number</option>
	        	<option value="2">Others</option>
	        </select>
	        </div>
	      		</div>
	      		<div class="col-sm-12" id="propsupply" style="display: none;">
		      		<div class="form-group">
			        	<label>Supply Property Number</label>
			        	<input type="text" class="form-control" id="spn" placeholder="Type here..." name="propertynumber">
			        </div>

	      		</div>
	      		<div class="col-sm-12" id="prop_remarks" style="display: none;">
		      		<div class="form-group">
			        	<label>Please specify here</label>
			        	<textarea class="form-control" rows="8" name="remarks" id="remfield" placeholder="Please specify your reason here..."></textarea>
			        </div>

	      		</div>
	      	</div>


	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-danger">Submit Report</button>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>

<script type="text/javascript">



	$("#spec_reason").change(function(){
		var reason = $(this).val();
		$("#spn").attr("required",false);
		$("#remfield").attr("required",false);
		$("#propsupply").css("display","none");
		$("#prop_remarks").css("display","none");
		if(reason == "0"){
			// UPDATED PROPERTY NUMBER
			$("#propsupply").css("display","block");
			$("#spn").attr("required",true);
		}else if (reason == "2"){
			// SPECIFY
			
			$("#prop_remarks").css("display","block");
			$("#remfield").attr("required",true);
		}
	})

	$.ajax({
		type: "POST",
		url: "{{ route('get_omitteditems_astable') }}",
		data: {_token:"{{ csrf_token() }}"},
		success: function(data){
			$("#tbl_omitted").html(data);
			$("#tbl_omass").DataTable();
		}
	})
	
	function setup_omitted_report_id(cont_id){
		var cid = $(cont_id).data("rid");
		$("#reportid").val(cid);
		$("#ignoreommitid").val(cid);
	}
</script>
@endsection