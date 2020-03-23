<?php $__env->startSection('title'); ?>
PMS Inventory
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">User Management</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navitem" aria-controls="navitem" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navitem">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#modal_newaccount"><i class="fas fa-arrow-right"></i> Create a new account</a>
      </li>

    </ul>
  </div>
</nav>

<div class="row mt-3">
  <div class="col-sm-12">
    <table class="mt-3 table table-sm" id="tblu">
  <thead>
    <tr>

      <th scope="col">Account Name</th>
      <th scope="col">Usertype</th>
      <th scope="col">Station</th>
      <th scope="col">Last Transaction</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody id="tallemp">
  </tbody>
</table>
  </div>
</div>


<form action="add_user" method="POST">
  <div class="modal" tabindex="-1" role="dialog" id="modal_newaccount">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create new account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </butt on>
      </div>
         <input type="hidden" required="" class="form-control" name="_token" value="<?php echo e(csrf_token()); ?>" autocomplete="off" >
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
      </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
          <label>Account Type</label>

          <?php 
            if(session("user_type")== "1"){
           
              ?>
   <!-- DIVISION SUPPY OFFICER -->
    <select class="form-control"  name="x_usertype">
               <option value="2">Principal</option>
              <option value="3">Property Custodian</option>
               <option value="4">Teacher</option>
          </select>
              <?php
            }else if(session("user_type")== "3"){
?>
   <select class="form-control"  name="x_usertype">
              <option value="4">Teacher</option>
          </select>


<?php

            }else if(session("user_type")== "0"){
              ?>
              <!-- //ADMIN -->

               <select class="form-control"  name="x_usertype">
              <option value="0">Admin</option>
              <option value="1">Division Supply Officer</option>
              <option value="2">Principal</option>
              <option value="3">Property Custodian</option>
              <option value="4">Teacher</option>
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
 <input type="hidden" value="<?php echo $cocoa; ?>" minlength="6"  required="" class="form-control" autocomplete="off" name="x_pass">
<input type="hidden" value="<?php echo $cocoa; ?>" minlength="6"  required="" class="form-control" autocomplete="off" name="x_repass">
         <!--  <div class="col-sm-12">
            <label>Password</label>
           
          </div>
          <div class="col-sm-12">
            <label>Retype-Password</label>
            
          </div> -->
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

<form action="del_user" method="POST">
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
          <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Delete</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</form>

<form action="edit_acc" method="POST">
  <div class="modal" tabindex="-1" id="m_edit" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Information</h5>
          <input type="hidden" id="emp_id_edit" name="empid">
          <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
         <input type="hidden" required=""class="form-control" name="_token" value="<?php echo e(csrf_token()); ?>" autocomplete="off" >
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
          <input type="text" id="edit_useremployeeid" maxlength="7" minlength="7" required="" class="form-control" autocomplete="off" name="x_empid">
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
               <option value="4">Teacher</option>
          </select>
                <?php 
           }else if(session("user_type")== "3"){
?>
   <select class="form-control"  name="x_usertype">
              <option value="4">Teacher</option>
          </select>


<?php

            }else if(session("user_type")== "0"){
            ?>
   <select class="form-control" id="edit_acctype" required=""  name="x_usertype">
              <option value="0">Admin</option>
              <option value="1">Division Supply Officer</option>
              <option value="2">Principal</option>
              <option vlaue="3">Property Custodian</option>
              <option value="4">Teacher</option>
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
<script type="text/javascript">
function lod_editacc(control_obj){
  var theid_myval = $(control_obj).data("empid");
  // alert(theid_myval);
$("#emp_id_edit").val(theid_myval);
//load account all information
$.ajax({
  type: "POST",
  url: "get_inf_user",
  data : {_token: "<?php echo e(csrf_token()); ?>",emp_id: theid_myval},
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
  $.ajax({
    type: "POST",
    url: "getallemployees",
    data : {_token: "<?php echo e(csrf_token()); ?>"},
    success: function(data){
      console.log(data);
      $("#tallemp").html(data);
       $("#tblu").DataTable();
    }
  })
    $.ajax({
    type: "POST",
    url: "getallscnames",
    data : {_token: "<?php echo e(csrf_token()); ?>"},
    success: function(data){
      $("#all_sc_name").html(data);
      $("#all_sc_name_edit").html(data);
    }
  })
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>