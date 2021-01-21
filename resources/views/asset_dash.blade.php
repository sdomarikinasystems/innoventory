@extends('master.master')

@section('title')
Innoventory - Dashboard
@endsection

@section('contents')

<h2>Dashboard</h2>

<!--REMINDERS-->
<div class="row">
	<div class="col-sm-7">
<div id="lod_bar">
	<center><img src="{{ asset('images/loading.gif') }}" style="width: 80px;">
		<h5>Loading Summary...</h5>
	</center>
</div>
<div class="card-deck mb-3 mobiletext" id="statbar" style="display: none;">
		<div class="card">
			<div class="card-body">
				<p class="mb-0 mt-0">Asset <small class="text-muted">(CO-SE)</small></p>
				<h3 class="mb-0 mt-0" id="count_ass_reg"></h3>
			</div>
			<div class="card-footer">
				<div class="float-left"><a href="/innoventory/asset/registry"><span class="hideinmobile">Manage</span></a></div>
				<div class="float-right"><a href="/innoventory/asset/registry"><i class="fas fa-arrow-circle-right"></i></a></div>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<p class="mb-0 mt-0">Inventory <small class="text-muted">(CO-SE)</small></p>
				<h3 class="mb-0 mt-0" id="count_sc_assets"></h3>
			</div>
			<div class="card-footer">
				<div class="float-left"><a href="/innoventory/asset/inventory"><span class="hideinmobile">Show All</span></a></div>
				<div class="float-right"><a href="/innoventory/asset/inventory"><i class="fas fa-arrow-circle-right"></i></a></div>
			</div>
		</div>		
<div class="w-100 d-none d-sm-block d-lg-none"></div>
		<div class="card">
			<div class="card-body">
				<p class="mb-0 mt-0">Disposed <small class="text-muted">(CO-SE)</small></p>
				<h3 class="mb-0 mt-0" id="count_ass_disposed">0</h3>
			</div>
			<div class="card-footer">
				<a href="/innoventory/asset/disposal" class="float-right"><i class="fas fa-hand-point-right"></i> <span class="hideinmobile">View</span></a>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<p class="mb-0 mt-0">Service Centers</p>
				<h3 class="mb-0 mt-0" id="count_ass_servicecenters">0</h3>
			</div>
			<div class="card-footer">
				<a href="/innoventory/manage/service_centers" class="float-right"><i class="fas fa-hand-point-right"></i> <span class="hideinmobile">View</span></a>
			</div>
		</div>
	
</div>
		<div class="card mobiletext">
			<div class="card-header">
				<h5><i class="fas fa-bullhorn"></i> Announcements</h>
			</div>
			<div class="card-body announcement_card_body" style="padding:0; background-color: #F1F1F1 !important;" >	
				<div id="newann" style="background-color: #F1F1F1 !important; margin: 20px;">
					
				</div>
			</div>
			<div class="card-footer">
				<a href="{{ route('manage_reminders') }}" class="float-right"><i class="fas fa-hand-point-right"></i> View All</a>
			</div>
		</div>
	</div>

	<div class="col-sm-5">
			 <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
			  <li class="nav-item">
			    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-home"></i> <?php echo session("user_schoolname"); ?></a>
			  </li>

			  <?php
			if(session("user_type") == "0" || session("user_type") == "1"){
			?>

			<li class="nav-item">
			    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false" onclick="DisplayAllStationsInventoryStatus()"><i class="fas fa-clipboard-list"></i> All</a>
			  </li>
			<?php
			}
			?>

			</ul>
			<div class="tab-content" id="pills-tabContent">
			  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
			  	
			  	<div id="inv_status">
					
				</div>

				
			  </div>
			  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
			  	<table class="table table-hover table-bordered" id="tbl_datastation">
						<thead>
							<tr>
								<th style="width: 90%;">Station</th>
								<th><center>CO</center></th>
								<th><center>SE</center></th>
							</tr>
						</thead>
						<tbody id="allstaconts">
							
						</tbody>
					</table>
			  </div>
			</div>
	</div>	
</div>


<script type="text/javascript">

var isallload_station = false;
function DisplayAllStationsInventoryStatus(){
	if(isallload_station == false){
	$.ajax({
  		type: "POST",
  		url: "{{ route('seestationsinvstatus') }}",
  		data: {_token: "{{ csrf_token() }}"},
  		success:function(data){
  			$("#allstaconts").html(data);
  			$("#tbl_datastation").DataTable();
  			isallload_station = true;
  		}
  	})
	}
}

CheckIfReadyForInventory();

function CheckIfReadyForInventory(){
	$.ajax({
  		type: "POST",
  		url: "{{ route('checinvread') }}",
  		data: {_token: "{{ csrf_token() }}"},
  		success:function(data){
  			$("#inv_status").html(data);
  			LoadNewAnnouncements();
  		}
  	})
}

$("#statbar").css("display","none");
  	$("#lod_bar").css("display","block");

  function LoadNewAnnouncements(){
  	$.ajax({
  		type: "POST",
  		url: "{{ route('getmynewannouncements') }}",
  		data: {_token: "{{ csrf_token() }}",typeofget:"0"},
  		success:function(data){
  			// alert(data);
  			$("#newann").html(urlify(data));
  			LoadDashboardInfo();
  		}
  	})
  }

  function LoadDashboardInfo(){
  	  $.ajax({
    type : "POST",
    url: "{{ route('count_all_created_asset_loc') }}",
    data: {_token:"{{ csrf_token() }}"},
    success: function(data){
		$("#lod_bar").css("display","none");
		$("#statbar").css("display","flex");
		var d_data  = data.split(",");
		var asset_registry = d_data[1].split(":");
		var asset_scanned = d_data[2].split(":");
		var asset_disposed = d_data[3].split(":");
		$("#count_assloc_created").html(d_data[0]);
		$("#count_ass_reg").html(asset_registry[0] + " - " + asset_registry[1]);
		$("#count_sc_assets").html(asset_scanned[0] + " - " + asset_scanned[1]);
		$("#count_ass_disposed").html(asset_disposed[0] + " - " + asset_disposed[1]);
		$("#count_ass_servicecenters").html(d_data[4]);
		$("#count_accounts").html(d_data[5]);
    }
  })
  }

</script>
@endsection