@extends('master.master')

@section('title')
Innoventory - Semi Expendables Discrepancies
@endsection

@section('contents')
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page"><a href="/innoventory/dashboard">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page"><a href="/innoventory/asset/registry">Asset Registry</a></li>
		<li class="breadcrumb-item active" aria-current="page"><strong><span id="disc_sc_name">(Please wait)</span></strong> Asset Registry - Discrepancies</li>
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
				<table class="mt-3 table table-borderless table-hover" id="tbl_semiexdis">
					<thead>
						<tr>
              <th>Article</th>
              <th>Description</th>
              <th>Stock Number</th>
              <th>Unit of Measure</th>
              <th>Unit Value</th>
              <th>Balance Per Card</th>
              <th>Issue</th>
						</tr>
					</thead>
				<tbody id="allsemdis">
          
				</tbody>
				</table>
	</div>
</div>

<script type="text/javascript">
  LoadSemiDiscrepancies();
  function LoadSemiDiscrepancies(){
    var thestationid = <?php echo json_encode($_GET["stationid"]); ?>;
    $.ajax({
      type:"GET",
      url: "{{ route('stole_my_semiexpendable_descrepancies') }}",
      data: {_token:"{{ csrf_token() }}",layout:"table",station_id: thestationid},
      success: function(data){
        // alert(data);
           $("#tbl_semiexdis").DataTable().destroy();
        $("#allsemdis").html(data);
         $("#tbl_semiexdis").DataTable();
         getscname();
      }
    })
  }
  
  function getscname(){
      $.ajax({
    type: "GET",
    url: "{{ route('get_school_fullname') }}",
    data: {_token:"{{ csrf_token() }}",stationid:<?php echo json_encode($_GET["stationid"]); ?>},
    success: function(data){
       $("#disc_sc_name").html(data);
    }
  })
    }
</script>


@endsection