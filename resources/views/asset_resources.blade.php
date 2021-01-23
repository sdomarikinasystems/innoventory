@extends('master.master')

@section('title')
Innoventory - Resources
@endsection

@section('contents')
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Home</li>
		<li class="breadcrumb-item active" aria-current="page">Resources</li>
	</ol>
</nav>
<div class="mb-3">
	
<?php
			if(session("user_type") < "4" && session("user_type") != "2"){
		?>
		<!-- FOR SUPPLY OFFICER AND PROPERTY CUSTODIAN ONLY -->
				<button class="btn btn-primary" href="#" data-toggle="modal" data-target="#modal_uploadfile"><i class="fas fa-file-import"></i> Upload Resource</button>

			<?php } ?>
</div>


<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">My Resources</a>
  </li>
  <?php
      if(session("user_type") < "4" && session("user_type") != "2"){
    ?>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Others</a>
  </li>

    <?php } ?>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    
 <div class="mt-3">

  <table class="table table-striped table-bordered" id="dtbl">
    <thead>
      <tr>
        <th scope="col"></th>
        <th scope="col">File Name</th>
        <th scope="col">Uploaded By</th>
        <th scope="col">Date Uploaded</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody id="allmyres"></tbody>
  </table>

 </div>

  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    
    <div class="mt-3">
      <table class="table table-sm table-striped table-bordered" id="td_allres">
        <thead>
          <tr>
            <th>Station</th>
            <th scope="col"></th>
             <th>File Name</th>
              <th>Uploaded By</th>
              <th>Date Uploaded</th>
          
          </tr>
        </thead>
        <tbody id="allresourcesbystation">
          
        </tbody>
      </table>
    </div>

  </div>
</div>

<form action="{{ route('uploadresourcenow') }}" method="POST" enctype="multipart/form-data">
<div class="modal" tabindex="-1" id="modal_uploadfile" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload Resource</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ csrf_field() }}
       <div class="form-group">
       	<label>Choose file to upload from your computer</label>
       	<input type="file" required="" accept=".xls,.xlsx,.csv,.pdf,.txt,.docx" name="thefile">
       </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Upload</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
</form>

<form action="{{ route('del_a_re_now') }}" method="POST">
	<div class="modal" tabindex="-1" id="modal_delnow" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Delete Resource?</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	{{ csrf_field() }}
	      	<input type="hidden" id="resid" name="id_of_something">
	        <p>Delete this resource permanently?</p>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-danger">Yes</button>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>


<script type="text/javascript">
  LoadAllReoucesByLatestUpload();


 function LoadAllReoucesByLatestUpload(){

$.ajax({
      type:"POST",
      url: "{{ route('getallreourcesbylatest') }}",
      data: {_token: "{{ csrf_token() }}"},
      success: function(data){
        $("#allresourcesbystation").html(data);
           $("#td_allres").DataTable();
      }
    })

 }

LoadResources();
function opendeleteresource(control_obj){
	$("#resid").val($(control_obj).data("rid"));
}
  function LoadResources(){
  	$.ajax({
  		type:"POST",
  		url: "{{ route('getmyresourcesofassets') }}",
  		data: {_token: "{{ csrf_token() }}"},
  		success: function(data){
  			$("#allmyres").html(data);
  			 $("#dtbl").DataTable();
  		}
  	})
  }
</script>


@endsection