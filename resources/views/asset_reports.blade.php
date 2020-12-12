@extends('master.master')

@section('title')
ProcMS - Innoventory
@endsection

@section('contents')
<style>
	.sub-group > li {
		border: 0;
	}
	.list-group-dropdown {
		display: none;
	}
	.list-group-dropdown > li {
		padding: 8px 15px;
	}
</style>

<h2>Reports</h2>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Home</li>
		<li class="breadcrumb-item active" aria-current="page">Reports</li>
	</ol>
</nav>

<div class="row">
	<div class="col-sm mb-3">
		<div class="dropdown" style="display: inline-block;">
			<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select Category
			<span class="caret"></span></button>
			<ul class="list-group dropdown-menu list-group-dropdown" id="pills-tab" role="tablist">
				<li><a id="pills-contact-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-profile" aria-selected="false">Asset Classification</a></li>
				<li><a id="pills-contact-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Subclass</a></li>
				<li><a id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Current Condition</a></li>
				<li><a id="pills-contact-tab" data-toggle="pill" href="#pills-sourceoffund" role="tab" aria-controls="pills-contact" aria-selected="false">Source of Fund</a></li>
				<li><a id="pills-contact-tab" data-toggle="pill" href="#pills-dateofaquisition" role="tab" aria-controls="pills-contact" aria-selected="false">Date of Aquisition</a></li>
				<li><a id="pills-contact-tab" data-toggle="pill" href="#pills-servicecen" role="tab" aria-controls="pills-contact" aria-selected="false">Service Center</a></li>
			</ul>
		</div>
	</div>
	<script type="text/javascript">
	$("#searchss").change(function(){
	var skey = $("#searchss").val();
	$.ajax({
	type: "POST",
	url: "../../search_station_toview",
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
	</script>
</div>

<div class="row mt-3">
	<div class="col-sm-12">
		<div class="tab-content" id="pills-tabContent">
		  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
		  	<h5>Asset Classification</h5>
		  	<table class="table table-striped table-bordered mt-3" id="tbl_1">
		  	  <thead>
		  	    <tr>
		  	      <th scope="col">Name</th>
		  	      <th scope="col">Total</th>
		  	    </tr>
		  	  </thead>
		  	  <tbody id="tbl_assetclassification">
		  	   
		  	
		  	  </tbody>
		  	</table>
		  </div>
		  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
			<h5>Subclass</h5>
		  	<table class="table table-striped table-bordered mt-3" id="tbl_2">
		  	  <thead>
		  	    <tr>
		  	      <th scope="col">Name</th>
		  	      <th scope="col">Total</th>
		  	    </tr>
		  	  </thead>
		  	  <tbody id="tbl_subclass">		  	   		  
		  	  </tbody>
		  	</table>
		  </div>
		  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
			<h5>Current Condition</h5>
		  	<table class="table table-striped table-bordered mt-3" id="tbl_3">
		  	  <thead>
		  	    <tr>
		  	      <th scope="col">Name</th>
		  	      <th scope="col">Total</th>
		  	    </tr>
		  	  </thead>
		  	  <tbody id="tbl_currentcondition">
		  	   
		  	
		  	  </tbody>
		  	</table>
		  </div>
		  <div class="tab-pane fade" id="pills-sourceoffund" role="tabpanel" aria-labelledby="pills-contact-tab">
			<h5>Source of Fund</h5>
		  	<table class="table table-striped table-bordered mt-3" id="tbl_4">
		  	  <thead>
		  	    <tr>
		  	      <th scope="col">Name</th>
		  	      <th scope="col">Total</th>
		  	    </tr>
		  	  </thead>
		  	  <tbody id="tbl_sourceoffund">

		  	
		  	  </tbody>
		  	</table>
		  </div>
		   <div class="tab-pane fade" id="pills-dateofaquisition" role="tabpanel" aria-labelledby="pills-contact-tab">
			<h5>Date of Acquisition</h5>
		   	<table class="table table-striped table-bordered mt-3" id="tbl_5">
		   	  <thead>
		   	    <tr>
		   	      <th scope="col">Name</th>
		   	      <th scope="col">Total</th>
		   	     
		   	    </tr>
		   	  </thead>
		   	  <tbody id="tbl_dateofaquisition">
		   	   
		   	
		   	  </tbody>
		   	</table>
		   </div>
		     <div class="tab-pane fade" id="pills-servicecen" role="tabpanel" aria-labelledby="pills-contact-tab">
				<h5>Service Center</h5>
		     	<table class="table table-striped table-bordered mt-3" id="tbl_6">
		     	  <thead>
		     	    <tr>
		     	      <th scope="col">Name</th>
		     	      <th scope="col">Total</th>
		     	      
		     	    </tr>
		     	  </thead>
		     	  <tbody id="tbl_servicecenter">
		     	   
		     	
		     	  </tbody>
		     	</table>
		     </div>
		</div>
	</div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="modal_assetview">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Assets : <span id="incassnames"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <table class="table table-sm table-striped table-bordered" id="tblassviewext" style="font-size: 12px;">
       	<thead>
       		 <th scope="col" width="150">Property Number</th>
      <th scope="col">Asset Item</th>
      <th scope="col">Asset Classification</th>
      <th scope="col">Current Condition</th>
      <th scope="col">Service Center</th>
      <th scope="col">Room</th>
      <th scope="col">Action</th>
       	</thead>
       	<tbody id="tbl_includedassetsview">
       		
       	</tbody>
       </table>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	LoadReportAssetClass();

	function fetchallassets(control_obj){
		var colname  = $(control_obj).data("colname");
		var colvalue = $(control_obj).data("colval");
		$("#incassnames").html(colvalue);
		// alert(colname);
		$.ajax({
			type: "POST",
			url: "{{ route('get_grouped_asset_contents') }}",
			data: {_token:"{{ csrf_token() }}",column_name:colname,column_value:colvalue},
			success: function(data){
				// alert(data);
				 $("#tblassviewext").DataTable().destroy();
				$("#tbl_includedassetsview").html(data);
				 $("#tblassviewext").DataTable();
			}
		})
	}
	function LoadReportAssetClass(){
		// GET asset_classification
		$.ajax({
			type: "POST",
			url: "{{ route('getrepo') }}",
			data: {_token:"{{ csrf_token() }}",columnname:"asset_classification"},
			success: function(data){
				$("#tbl_assetclassification").html(data);
				$("#tbl_1").DataTable();

			}
		})
		// GET asset_sub_class
		$.ajax({
			type: "POST",
			url: "{{ route('getrepo') }}",
			data: {_token:"{{ csrf_token() }}",columnname:"asset_sub_class"},
			success: function(data){
				// alert(data);
				$("#tbl_subclass").html(data);
				$("#tbl_2").DataTable();

			}
		})
		// GET current_condition
		$.ajax({
			type: "POST",
			url: "{{ route('getrepo') }}",
			data: {_token:"{{ csrf_token() }}",columnname:"current_condition"},
			success: function(data){
				$("#tbl_currentcondition").html(data);
				$("#tbl_3").DataTable();

			}
		})
		// GET source_of_fund
$.ajax({
			type: "POST",
			url: "{{ route('getrepo') }}",
			data: {_token:"{{ csrf_token() }}",columnname:"source_of_fund"},
			success: function(data){
				$("#tbl_sourceoffund").html(data);
				$("#tbl_4").DataTable();

			}
		})
		// GET date_of_acquisition
$.ajax({
			type: "POST",
			url: "{{ route('getrepo') }}",
			data: {_token:"{{ csrf_token() }}",columnname:"date_of_acquisition"},
			success: function(data){
				$("#tbl_dateofaquisition").html(data);
				$("#tbl_5").DataTable();

			}
		})
		// GET service_center
		$.ajax({
			type: "POST",
			url: "{{ route('getrepo') }}",
			data: {_token:"{{ csrf_token() }}",columnname:"service_center"},
			success: function(data){
				$("#tbl_servicecenter").html(data);
				$("#tbl_6").DataTable();

			}
		})
				
				
				
				
	}
</script>

@endsection