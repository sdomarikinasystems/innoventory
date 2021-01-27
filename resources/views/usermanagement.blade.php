@extends('master.master')

@section('title')
Innoventory - User Management
@endsection

@section('contents')
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Home</li>
		<li class="breadcrumb-item active" aria-current="page">Manage Users</li>
    <li class="breadcrumb-item active" aria-current="page">{{ session('user_changesource_station_name') }}</li>
	</ol>
</nav>


    <?php
    if(session("user_type") == "0" || session("user_type") == "1"){
  ?>
  <!-- FOR ADMIN ONLY -->
    <a class="btn btn-secondary dropdown-toggle float-right" href="#" id="navbardrop" data-toggle="dropdown">
    <i class="fas fa-filter"></i> Filter User Source</a>
    <div class="dropdown-menu" style="width:450px; min-height: 300px;">
      <div class="container">
        <div class="form-group">
          <input type="text" class="form-control mt-3" id="searchss" autocomplete="off" placeholder="Search Station here..." name="">
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
<h4 class="mb-3"><span id="sourcename">{{ session('user_changesource_station_name') }}</span></h4>
<div class="row">
	<div class="col-sm-12">



		<ul class="nav">
      <?php
      if(session("user_type") < "4" && session("user_type") != "2"){
      ?>
        <!-- FOR SUPPLY OFFICER AND PROPERTY CUSTODIAN ONLY -->
          <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#modal_newaccount" onclick="setupcreate()"><i class="fas fa-plus-square"></i> Create a new account</a>
        <?php } ?>
        <?php
        if(session("user_type") == "0" || session("user_type") == "1"){
        ?>
      <?php
      }
      ?>
		</ul>
	</div>
	<div class="col-sm">
	</div>	
</div>




<div class="row mt-3">
  <div class="col-sm-12">
    <table class="mt-3 table table-bordered" id="tblu">
  <thead>
    <tr>
      <th scope="col">Account Name</th>
      <th scope="col">Type</th>
      <th scope="col">Station</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody id="tallemp">
  </tbody>
</table>
  </div>
</div>

<form action="{{ route('add_a_new_user') }}" autocomplete="off" method="POST">
  <div class="modal" tabindex="-1" role="dialog" id="modal_newaccount">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create new account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </butt on>
      </div>
         <input type="hidden" required="" class="form-control" name="_token" value="{{ csrf_token() }}" autocomplete="off" >
      <div class="modal-body">
        <div class="form-group">
            <label>Account Name</label>
            <input type="text" required="" class="form-control" name="x_username" autocomplete="off" >
        </div>
        <div class="form-group">
            <label>DepEd Email</label>
            <input type="email" required="" class="form-control" name="x_depedemail" autocomplete="off" placeholder="xxxx.xx@deped.gov.ph">
        </div>
      <div class="form-group">
          <label>Select School</label>
          <select id="all_sc_name"  required="" name="x_selectedschool" class="form-control"></select>
      </div>
      <div class="row">
          <div class="col-md-6">
              <div class="form-group">
          <label>Employee ID</label>
          <input type="text"  maxlength="7" minlength="7" required="" class="form-control" autocomplete="off" name="x_empid">
        <p class="text-muted">This will be the default password for this account.</p>
      </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
          <label>Account Type</label>
            <?php 
            if(session("user_type")== "1"){
            ?>
   <!-- DIVISION SUPPY OFFICER -->
            <select id="addtype" class="form-control" required=""  name="x_usertype">
              <option value=''  selected="" disabled="">Choose...</option>
              <option value="2">Principal</option>
              <option value="3">Property Custodian</option>
              <option value="4">Center Manager</option>
            </select>
            <?php
            }else if(session("user_type")== "3"){
            ?>
            <select id="addtype" class="form-control" required=""  name="x_usertype">
            <option value="4">Center Manager</option>
            </select>
            <?php
            }else if(session("user_type")== "0"){
            ?>
              <!-- //ADMIN -->
            <select id="addtype" class="form-control" required=""  name="x_usertype">
              <option value=''  selected="" disabled="">Choose...</option>
              <option value="0">Admin</option>
              <option value="1">Division Supply Officer</option>
              <option value="2">Principal</option>
              <option value="3">Property Custodian</option>
              <option value="4">Center Manager</option>
            </select>
              <?php
            }
          ?>
      </div>
          </div>
<?php 
// This function will return a random 
// string of specified length 
function random_strings($length_of_string) 
{ 
  // String of all alphanumeric character 
  $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
  // Shufle the $str_result and returns substring 
  // of specified length 
  return substr(str_shuffle($str_result), 
          0, $length_of_string); 
} 
// This function will generate 
// Random string of length 10 
$cocoa =  random_strings(10); 
?> 
<script type="text/javascript">
       function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }    
</script>
 <input type="hidden" value="<?php echo $cocoa; ?>" minlength="6"  required="" class="form-control" autocomplete="off" name="x_pass">
<input type="hidden" value="<?php echo $cocoa; ?>" minlength="6"  required="" class="form-control" autocomplete="off" name="x_repass">
      </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Create Account</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

</form>

<form action="{{ route('delete_the_user') }}" method="POST">
  <div class="modal" tabindex="-1" id="m_delete" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete Account</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Delete this account?</p>
          <input type="hidden" id="emp_id_del" name="empid">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Delete</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</form>

<form action="{{ route('edit_the_user_info') }}" method="POST">
  <div class="modal" tabindex="-1" id="m_edit" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Information</h5>
          <input type="hidden" id="emp_id_edit" name="empid">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
         <input type="hidden" required=""class="form-control" name="_token" value="{{ csrf_token() }}" autocomplete="off" >
      <div class="modal-body">
        <div class="form-group">
            <label>Account Name</label>
            <input type="text" required=""  id="edit_username"  class="form-control" name="x_username" autocomplete="off" >
        </div>
        <div class="form-group">
            <label>DepEd Email</label>
            <input type="email" required="" class="form-control" id="edit_depedemail" name="x_depedemail" autocomplete="off" placeholder="xxxx.xx@deped.gov.ph">
        </div>
      <div class="form-group">
          <label>Select School</label>
          <select id="all_sc_name_edit"  required="" name="x_selectedschool" class="form-control">
              
          </select>
      </div>
      <div class="row">
          <div class="col-md-6">
              <div class="form-group">
          <label>Employee ID</label>
          <input type="text" id="edit_useremployeeid"  onkeypress="javascript:return isNumber(event)" maxlength="7" minlength="7" required="" class="form-control" autocomplete="off" name="x_empid">
      </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
          <label>Account Type</label>
            <?php 
            if(session("user_type")== "1"){
           
              ?>
   <select class="form-control" id="edit_acctype" required=""  name="x_usertype">
            <option value="2">Principal</option>
              <option value="3">Property Custodian</option>
               <option value="4">Center Manager</option>
          </select>
                <?php 
           }else if(session("user_type")== "3"){
?>
   <select class="form-control"  name="x_usertype">
              <option value="4">Center Manager</option>
          </select>


<?php

            }else if(session("user_type")== "0"){
            ?>
   <select class="form-control" id="edit_acctype" required=""  name="x_usertype">
              <option value="0">Admin</option>
              <option value="1">Division Supply Officer</option>
              <option value="2">Principal</option>
              <option vlaue="3">Property Custodian</option>
              <option value="4">Center Manager</option>
          </select>
            <?php
           }
              ?>
      </div>
          </div>
      </div>
      </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</form>

<form action="{{ route('shoot_reset_account_password') }}" method="POST">
    {{ csrf_field() }}
    <div class="modal" tabindex="-1" role="dialog" id="m_resetpass">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Reset Account Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="theempid" name="employeeid">
          <input type="hidden" id="theempnumber" name="employeenumber">
        <div class="mt-5 mb-5">
            <h5>Change password to default?</h5>
            <p class="mb-3 mt-0 text-muted">Once you click "Reset Password", this account must use this password below in his/her next login. Make sure the owner of the account is informed in this change.</p>
          <div class="card card-shadow">
            <div class="card-body">
             <button onclick="CopyToClipboard('empnums')" class="btn float-right btn-secondary btn-sm " type="button"><i class="fas fa-copy"></i> Copy Password</button>
              <h4 class="mt-0 mb-0" id="empnums"></h4>
              
            </div>
          </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Reset Password</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</form>


<script type="text/javascript">
  var curr_station_id = <?php echo json_encode(session("user_changesource_station")); ?>;
  var curr_station_name = <?php echo json_encode(session("user_changesource_station_name")); ?>;


function CopyToClipboard(id)
{
var r = document.createRange();
r.selectNode(document.getElementById(id));
window.getSelection().removeAllRanges();
window.getSelection().addRange(r);
document.execCommand('copy');
window.getSelection().removeAllRanges();
alert("Password copied!");
}


  function lod_resetpass(control_obj){
    $("#theempid").val($(control_obj).data("empid"));
    $("#theempnumber").val($(control_obj).data("empnumber"));
    $("#empnums").html($(control_obj).data("empnumber"));
  }
function lod_editacc(control_obj){
  var theid_myval = $(control_obj).data("empid");
  // alert(theid_myval);
$("#emp_id_edit").val(theid_myval);
//load account all information
$.ajax({
  type: "POST",
  url: "../../get_inf_user",
  data : {_token: "{{ csrf_token() }}",emp_id: theid_myval},
  success : function(data){
    data = JSON.parse(data);
    $("#edit_username").val(data[0]["username"]);
    $("#edit_acctype").val(data[0]["type"]);
    $("#edit_depedemail").val(data[0]["depedemail"]);
    $("#all_sc_name_edit").val(data[0]["station_id"]);
    $("#edit_useremployeeid").val(data[0]["employee_id"]);
  }
})
}
function lod_deleteacc(control_obj){
$("#emp_id_del").val($(control_obj).data("empid"));

}

LoadAllAccounts()
function LoadAllAccounts(){
   $.ajax({
    type: "POST",
    url: "{{ route('display_all_employees') }}",
    data : {_token: "{{ csrf_token() }}",user_school: curr_station_id},
    success: function(data){
      $("#tallemp").html(data);
       $("#tblu").DataTable();
       LoadAllSchoolsInSelection();
    }
  })
}
 
  function LoadAllSchoolsInSelection(){
      $.ajax({
    type: "POST",
    url: "{{ route('load_all_school_names') }}",
    data : {_token: "{{ csrf_token() }}"},
    success: function(data){
      $("#all_sc_name").html(data);
      $("#all_sc_name_edit").html(data);
    }
  })
  }
    function setupcreate(){
     // $("#addtype").val("4");
     $("#all_sc_name").val("{{ session('user_school') }}");
    }


    function gotomyownassets(){
        var sourceid =  <?php echo json_encode(session("user_school")); ?>;
        var sourcename =  <?php echo json_encode(session("user_schoolname")); ?>;
        $.ajax({
        type: "POST",
        url: "{{ route('shoot_univ_change_source') }}",
        data: {_token : "{{ csrf_token() }}", new_source_id: sourceid, new_source_name: sourcename },
        success: function(){
          location.reload();
        }
        })
    }


 function changesource(control_obj){
    var sourceid = $(control_obj).data("sourceid");
    var sourcename = $(control_obj).data("sourcename");
    $.ajax({
    type: "POST",
    url: "{{ route('shoot_univ_change_source') }}",
    data: {_token : "{{ csrf_token() }}", new_source_id: sourceid, new_source_name: sourcename },
    success: function(){
      location.reload();
    }
    })
    }

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
</script>

@endsection