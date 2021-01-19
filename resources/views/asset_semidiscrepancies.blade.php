@extends('master.master')

@section('title')
Innoventory - Semi Expendables Discrepancies
@endsection

@section('contents')

<h2>Asset Registry - Discrepancies</h2>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page"><a href="/innoventory/dashboard">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page"><a href="/innoventory/asset/registry">Asset Registry</a></li>
		<li class="breadcrumb-item active" aria-current="page">Discrepancies</li>
	</ol>
</nav>
<input type="hidden" value="{{ session('user_school') }}" id="myschool_realid" name="">
<div class="row">
	<?php

if(session("stationid") != $_GET["stationid"]){
?>

<?php
}else{
?>
  <div class="col-md-12">
    <h5>Asset Discrepancies of <span id="disc_sc_name">(Please wait)</span></h5>
  </div>
  <?php
  }
  ?>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title mb-3">Assets with Discrepancy</h5>
				<table class="mt-3 table table-sm" id="tbl_semiexdis">
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
	</div>
</div>

<script type="text/javascript">
  LoadSemiDiscrepancies();
  function LoadSemiDiscrepancies(){
    var thestationid = <?php echo json_encode($_GET["stationid"]); ?>;
    $.ajax({
      type:"POST",
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
    type: "POST",
    url: "get_sc_fn",
    data: {_token:"{{ csrf_token() }}",stationid:<?php echo json_encode($_GET["stationid"]); ?>},
    success: function(data){
       $("#disc_sc_name").html(data);
    }
  })
    }
</script>


@endsection