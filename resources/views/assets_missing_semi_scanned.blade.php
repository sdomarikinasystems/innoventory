@extends('master.master')

@section('title')
ProcMS - Innoventory
@endsection

@section('contents')

<h2>Semi-Expendable - Items Not Found</h2>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Home</li>
		<li class="breadcrumb-item active" aria-current="page">Inventory</li>
    <li class="breadcrumb-item active" aria-current="page">Semi-Expendable - Items Not Found</li>
	</ol>
</nav>


<div class="row mt-3">
  <div class="col-md-12 table-responsive table-striped"> 
    <table class="table table-hover table-bordered" id="td_scanned_nf">
      <thead>
        <tr>
         <th scope="col" width="150">Stock Number</th>
          <th scope="col">Article</th>
          <th scope="col">Description</th>
          <th scope="col">Service Center</th>
          <th scope="col">Room</th>
        </tr>
      </thead>
      <tbody id="allmyassests_ni">
      </tbody>
    </table>
  </div>
</div>

<script type="text/javascript">
  
  var asset_station = <?php echo json_encode($_GET["myschool_id"]); ?>;
  // alert(asset_station);
fetch_data();
  function fetch_data(){
    $.ajax({
      type: "POST",
      url: "{{ route('stole_get_semi_expendable_not_scanned') }}",
      data: {_token:"{{ csrf_token() }}",station_info:asset_station },
      success: function(data){
        $("#allmyassests_ni").html(data);
        $("#td_scanned_nf").DataTable();
      }
    })
  }
</script>
@endsection