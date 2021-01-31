@extends('master.master')

@section('title')
Innoventory - Dashboard
@endsection

@section('contents')

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
			<div class="card-body card-body-sm carddet" data-placement="bottom" data-content="Total uploaded assets (Capital Outlay - Semi-Expendable)" data-trigger="hover" style='text-align:center;'>
				<a href="{{ route('assetregistry') }}" class='basic_link text-dark m-0'>
					<p class="mb-0 mt-0 text-primary"><i class="fas fa-clipboard-check"></i> <small class="text-muted"></small></p>
				<h5 class="mb-0 mt-0" id="count_ass_reg"></h5>
				</a>
			</div>
		</div>
		<div class="card">
			<div class="card-body card-body-sm carddet" data-placement="bottom" data-content="Total scanned inventory data (Capital Outlay - Semi-Expendable) " data-trigger="hover" style='text-align:center;'>
				<a href="{{ route('asset_scanned') }}"  class='basic_link text-dark m-0'>
					<p class="mb-0 mt-0 text-success"><i class="fas fa-search"></i> <small class="text-muted"></small></p>
				<h5 class="mb-0 mt-0" id="count_sc_assets"></h5>
				</a>
			</div>
		</div>		
<div class="w-100 d-none d-sm-block d-lg-none"></div>
		<div class="card">
			<div class="card-body card-body-sm carddet" data-placement="bottom" data-content="Total disposed assets (Capital Outlay - Semi-Expendable)" data-trigger="hover" style='text-align:center;'>
				<a href="{{ route('asset_disposed') }}"  class='basic_link text-dark m-0'>
					<p class="mb-0 mt-0 text-danger"><i class="fas fa-trash"></i> <small class="text-muted"></small></p>
				<h5 class="mb-0 mt-0" id="count_ass_disposed">0</h5>
				</a>
			</div>
		</div>
		<div class="card">
			<div class="card-body card-body-sm carddet" data-placement="bottom" data-content="Service Centers on your location" data-trigger="hover" style='text-align:center;'>
				<a href="{{ route('stationmy') }}" class='basic_link text-dark m-0'>
					<p class="mb-0 mt-0 text-info"><i class="fas fa-warehouse"></i></p>
				<h5 class="mb-0 mt-0" id="count_ass_servicecenters">0</h5>
				</a>
			</div>
		</div>
</div>
		<div class="announcement_card_body" style="padding:0;" >	
				<div id="newann" style="margin: 20px;">
				</div>
			</div>
	</div>
	<div class="col-sm-5">
			 <ul class="nav nav-tabs nav-fill mb-3" id="pills-tab" role="tablist">
			  <li class="nav-item">
			    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-home"></i> My Station</a>
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
			  	<table class="table table-hover table-borderless" id="tbl_datastation">
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
var isallload_station=!1;function DisplayAllStationsInventoryStatus(){0==isallload_station&&$.ajax({type:"POST",url:"{{ route('seestationsinvstatus') }}",data:{_token:"{{ csrf_token() }}"},success:function(t){$("#allstaconts").html(t),$("#tbl_datastation").DataTable(),isallload_station=!0}})}function CheckIfReadyForInventory(){$.ajax({type:"POST",url:"{{ route('checinvread') }}",data:{_token:"{{ csrf_token() }}"},success:function(t){$("#inv_status").html(t),LoadNewAnnouncements()}})}function LoadNewAnnouncements(){$.ajax({type:"POST",url:"{{ route('getmynewannouncements') }}",data:{_token:"{{ csrf_token() }}",typeofget:"0"},success:function(t){$("#newann").html(t),LoadDashboardInfo()}})}function LoadDashboardInfo(){$.ajax({type:"POST",url:"{{ route('count_all_created_asset_loc') }}",data:{_token:"{{ csrf_token() }}"},success:function(t){$("#lod_bar").css("display","none"),$("#statbar").css("display","flex");var s=t.split(","),a=s[1].split(":"),n=s[2].split(":"),o=s[3].split(":");$("#count_assloc_created").html(s[0]),$("#count_ass_reg").html(a[0]+" - "+a[1]),$("#count_sc_assets").html(n[0]+" - "+n[1]),$("#count_ass_disposed").html(o[0]+" - "+o[1]),$("#count_ass_servicecenters").html(s[4]),$("#count_accounts").html(s[5])}})}CheckIfReadyForInventory(),$("#statbar").css("display","none"),$("#lod_bar").css("display","block");
</script>
@endsection