@extends('master.master')

@section('title')
Inno... - Capital Outlay Omitted
@endsection

@section('contents')

<h2>Reports - Registry Omissions</h2>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('dboard') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Reports</li>
		<li class="breadcrumb-item active" aria-current="page">Omitted Assets</li>
	</ol>
</nav>

<input type="hidden" value="{{ session('user_school') }}" id="myschool_realid" name="">
<?php
			if(session("user_type") == "0" || session("user_type") == "1"){
		?>
  <!-- FOR ADMIN ONLY -->
		<a class="btn btn-secondary dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
		<i class="fas fa-filter"></i> Filter Asset Source</a>
  
		<div class="dropdown-menu" style="width:450px; min-height: 300px;">
			<div class="container">
				<div class="form-group">
					<input type="text" class="form-control mt-3" id="searchss" placeholder="Search Station here..." name="">
				</div>
				<div class="form-group">
					<div class=' mt-2'>
						<a onclick='gotomyownassets()' href='#' title='Switch to my own assets'>
						<span class="float-right text-muted"><i class="fas fa-home"></i></span>
						<small class='text-muted card-subtitle'>Switch to</small><br>
						<strong class='card-title' ><?php echo session("user_schoolname"); ?></strong>
						</a>
						<hr>
						<center id="search_narrative"><h5 class="text-muted mt-5"><i class="fas fa-search"></i> Search result will appear here...</h5></center>
					</div>
					<div id="school_search_cont" style=" overflow-y: auto; overflow-x: hidden; max-height: 300px;">
					<!-- result -->
					</div>
				</div>
			</div>
		</div>
	<?php
	}
	?>
	 <ul class="nav nav-tabs mb-3 mt-3" id="pills-tab" role="tablist">
	  <li class="nav-item">
	    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-database"></i> <span id="sourcename">{{ session('user_schoolname')}}</span></a>
	  </li>
	</ul>
	<div class="tab-content" id="pills-tabContent">
	  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
	  	    <table class="table table-hover table-bordered" id="tbl_ass">
    <thead>
      <tr>
        <th scope="col" width="150">Property Number</th>
        <th scope="col">Asset Item</th>
        <th scope="col">Current Condition</th>
        <th scope="col">Service Center</th>
        <th scope="col">Room</th>
        <th scope="col">Reason</th>
      </tr>
    </thead>
    <tbody id="allmyassests">
    </tbody>
  </table>
	  </div>
	</div>

	<script type="text/javascript">


		      $("#searchss").change(function(){
    var skey = $("#searchss").val();
   $.ajax({
    type: "POST",
    url: "{{ route('search_asstov') }}",
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

		       function changesource(control_obj){
   
    $("#myschool_realid").val($(control_obj).data("sourceid"));

     if($(control_obj).data("sourceid") != <?php echo session("user_school"); ?>){
            $("#sourcename").html($(control_obj).data("sourcename"));
          }else{
              $("#sourcename").html($(control_obj).data("sourcename"));
          }


		$("#lod_change_ass_source").css("display","block");
		LoadAssets();
		setTimeout(function(){
		$("#lod_change_ass_source").css("display","none");
		},1000)
	  }
	   LoadAssets();
    function LoadAssets(){
      var school_real_id = $("#myschool_realid").val();
      $.ajax({
        type : "POST",
        url : "{{ route('disp_omm_reps') }}",
        data : {_token:"{{ csrf_token()}}",selected_realid: school_real_id},
         success : function(data){
          // alert(data);
            $("#tbl_ass").DataTable().destroy();
            $("#allmyassests").html(data);
          
            $("#tbl_ass").DataTable();
   
         }
      })
    }


     function gotomyownassets(){

		var myassets = <?php echo json_encode(session("user_school")); ?>;
		$("#myschool_realid").val(myassets);
		 $("#lod_change_ass_source").css("display","block");
		LoadAssets();

		setTimeout(function(){
		$("#lod_change_ass_source").css("display","none");
		 $("#sourcename").html(<?php echo json_encode(session("user_schoolname")); ?>);
		},1000)

	  }

	  
setInterval(function(){
 $('[data-toggle="popover"]').popover(); 
},1000)
	</script>
@endsection