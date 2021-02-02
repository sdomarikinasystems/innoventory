@extends('master.master')

@section('title')
Inno... - Capital Outlay Discrepancies
@endsection

@section('contents')
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page"><a href="/innoventory/dashboard">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page"><a href="/innoventory/asset/registry">Asset Registry</a></li>
		<li class="breadcrumb-item active" aria-current="page"><strong><span id="disc_sc_name">(Please wait)</span></strong> Asset Registry - Capital Outlay Discrepancies</li>
	</ol>
</nav>

<input type="hidden" value="{{ session('user_school') }}" id="myschool_realid" name="">
<div class="row">
  <div class="col-md-6">
    <div class="card card-shadow">
      <div class="card-body">
        Fix your asset registry to be marked as <strong>Ready</strong> for inventory.
      </div>
    </div>
  </div>
	<div class="col-md-12 mt-3">
				<table class=" table table-borderless table-hover" id="tbl_disc">
					<thead>
						<tr>
							<th scope="col">Property Number</th>
							<th scope="col">Asset Item</th>
							<th scope="col">Asset Classification</th>
							<th scope="col">Current Condition</th>
							<th scope="col">Service Center</th>
							<th scope="col">Room</th>
							<th scope="col">Discrepancy</th>
						</tr>
					</thead>
				<tbody id="allassdisctbl">
				</tbody>
				</table>
	</div>
</div>

<div class="modal" tabindex="-1" id="modal_th" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title">Import Transaction Histroy</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-sm">
          <thead>
            <tr>
              <th>CSV Upload Count</th>
              <th>Inserted</th>
              <th>Updated</th>
              <th>Incomplete</th>
              <th>Not Inserted</th>
              <th>Transaction Time</th>
            </tr>
          </thead>
          <tbody id="tbl_trhis">
            
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
  GetExportHistory();
 function GetExportHistory(){
   $.ajax({
    type: "POST",
    url: "get_export_his",
    data: {_token:"{{ csrf_token() }}"},
    success: function(data){
       
       $("#tbl_trhis").html(data);
      p2();
    }
  })

 }

function p2(){
  $.ajax({
    type: "GET",
    url: "{{ route('get_school_fullname') }}",
    data: {_token:"{{ csrf_token() }}",stationid:<?php echo json_encode($_GET["stationid"]); ?>},
    success: function(data){
       $("#disc_sc_name").html(data);
       loadsum2();
    }
  })
}


  function loadsum2(){
      $.ajax({
    type: "GET",
    url: "{{ route('lod_dis_indetail') }}",
    data: {_token:"{{ csrf_token() }}",stationid:<?php echo json_encode($_GET["stationid"]); ?>},
    success: function(data){
       $("#tbl_disc").DataTable().destroy();
      $("#allassdisctbl").html(data);
       $("#tbl_disc").DataTable();

    }
  })
  }


</script>

@endsection