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
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-folder"></i> My Resources</a>
  </li>
  <?php
        if(session("user_type") == "0" || session("user_type") == "1"){
    ?>
  <li class="nav-item">
    <a class="nav-link" onclick=" LoadAllReoucesByLatestUpload()" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="fas fa-folder"></i> Others</a>
  </li>
    <?php } ?>
     <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#pg_tmeplates" role="tab" aria-controls="profile" aria-selected="false"><i class="fas fa-folder"></i> Templates</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">

   <div class="tab-pane fade" id="pg_tmeplates" role="tabpanel" aria-labelledby="profile-tab">
      <div class="container mt-3">
        <table class="table table-hover table-borderless" id="fldtx">
          <thead>
            <tr>
              <th>File</th>
              <th>Description</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                 <div class='iconize' style='background-color: #1B8EF5; margin-bottom: 10px;'>
                <center> <span style='font-size: 20px;'><i class="fas fa-box"></i></span> </center>
              </div>
              </td>
              <td>
                 <p class="mb-0">Capital Outlay Blank Template</p>
              <p class="text-muted mt-0">A blank .csv file can be opened in Excel for recording Capital Outlay information.</p>
              <a class="btn btn-secondary btn-sm mb-4" target="_blank" href="https://www.mediafire.com/file/zs5s2ndagsuzqz1/Asset+Registry+Blank+Template.csv/file">Download</a>
              </td>
            </tr>
            <tr>
              <td>
                <div class='iconize' style='background-color: #4EDD57; margin-bottom: 10px;'>
                <center> <span style='font-size: 20px;'><i class="fas fa-boxes"></i></span> </center>
              </div>
              </td>
              <td>
                 <p class="mb-0">Semi-Expendable Blank Template</p>
              <p class="text-muted mt-0">A blank .csv file can be opened in Excel for recording Semi-Expendable information of one Service Center.</p>
              <a class="btn btn-secondary btn-sm mb-4" target="_blank" href="https://www.mediafire.com/file/833qa4uq1e2x1kt/Semi-Expendable+Blank+Template.csv/file">Download</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  </div>


  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <div class="mt-3">
<?php
      if(session("user_type") < "4" && session("user_type") != "2"){
    ?>
    <!-- FOR SUPPLY OFFICER AND PROPERTY CUSTODIAN ONLY -->
        <button class="btn btn-primary" href="#" data-toggle="modal" data-target="#modal_uploadfile"><i class="fas fa-file-import"></i> Upload Resource</button>
      <?php } ?>
      
</div>
 <div class="mt-3">

  <table class="table table-hover table-borderless" id="dtbl">
    <thead>
      <tr>
        <th style="width: 30px;"></th>
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
      <table class="table table-hover table-borderless" id="td_allres">
        <thead>
          <tr>
            <th>Station</th>
            <th style="width: 30px;"></th>
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
 $("#fldtx").DataTable();
var hasloaded =false;

 function LoadAllReoucesByLatestUpload(){

   $("#td_allres").DataTable().destroy();
        $("#allresourcesbystation").html(localStorage.getItem("res_file_my_alldata"));
         $("#td_allres").DataTable();
         
   $.ajax({
      type:"GET",
      url: "{{ route('getallreourcesbylatest') }}",
      data: {_token: "{{ csrf_token() }}"},
      success: function(data){
        localStorage.setItem("res_file_my_alldata",data);
         $("#td_allres").DataTable().destroy();
        $("#allresourcesbystation").html(data);
           $("#td_allres").DataTable();
      }
    })
   
  if(hasloaded == false){
    hasloaded = true;
  }
   
 }

LoadResources();
function opendeleteresource(control_obj){
	$("#resid").val($(control_obj).data("rid"));
}
  function LoadResources(){

      $("#dtbl").DataTable().destroy();
        $("#allmyres").html(localStorage.getItem("res_file_my"));
         $("#dtbl").DataTable();


  	$.ajax({
  		type:"GET",
  		url: "{{ route('getmyresourcesofassets') }}",
  		data: {_token: "{{ csrf_token() }}"},
  		success: function(data){
        localStorage.setItem("res_file_my",data);
          $("#dtbl").DataTable().destroy();
  			$("#allmyres").html(data);
  			 $("#dtbl").DataTable();
  		}
  	})
  }
</script>


@endsection