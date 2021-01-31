@extends('master.master')

@section('title')
Inno... - Semi-Expendable Missing
@endsection

@section('contents')
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Home</li>
		<li class="breadcrumb-item active" aria-current="page">Inventory</li>
    <li class="breadcrumb-item active" aria-current="page">Semi-Expendable - Items Not Found</li>
	</ol>
</nav>


<div class="row mt-3">
  <div class="col-md-12">
    <div class="card-deck">
      <div class="card card-shadow">
        <div class="card-body">
          <p class="m-0 text-primary"><small>Station</small></p>
          <h5 class="m-0" id="stationname"></h5>
        </div>
        
      </div>
      <div class="card card-shadow">
        <div class="card-body">
          <p class="m-0 text-primary"><small>Total Missing Asset(s)</small></p>
          <h5 class="m-0" id="allassetcount"></h5>
        </div>
        
      </div>
      <div class="card card-shadow">
        <div class="card-body">
          <p class="m-0 text-primary"><small>From - To</small></p>
          <span class="m-0" id="fromtodates"></span>
        </div>
        
      </div>
    </div>
  </div>
  <div class="col-md-12 mt-3 table-responsive"> 
    <table class="table table-hover table-borderless" id="td_scanned_nf">
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
  
  var station_name = <?php echo json_encode($_GET["station_name"]); ?>;
  var asset_station = <?php echo json_encode($_GET["myschool_id"]); ?>;
  var filtered_year = <?php echo json_encode($_GET["selected_year"]); ?>;
  var filtered_month = <?php echo json_encode($_GET["selected_month"]); ?>;
  var htmldata_fromto = <?php echo json_encode($_GET["fromto_html"]); ?>;

fetch_data();
  function fetch_data(){
    $("#stationname").html(station_name);
    $("#fromtodates").html(htmldata_fromto);
    $.ajax({
      type: "POST",
      url: "{{ route('stole_get_semi_expendable_not_scanned') }}",
      data: {_token:"{{ csrf_token() }}",station_info:asset_station,selyear:filtered_year,selmonth:filtered_month},
      success: function(data){
          $("#allmyassests_ni").html(data);
          var count = (data.match(/missedt/g) || []).length;
          $("#allassetcount").html(count);
          $("#td_scanned_nf").DataTable();
      }
    })
  }
</script>
@endsection