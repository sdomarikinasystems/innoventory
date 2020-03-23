<?php $__env->startSection('title'); ?>
PMS Inventory
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Transaction History</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navitem" aria-controls="navitem" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navitem">
    <ul class="navbar-nav mr-auto">
   <li class="nav-item active">
   <a class="nav-link" id="btn_myactlogs" href="#"><i class="fas fa-tags"></i> Show Action Tags</a>
  </li>
    </ul>
  </div>
</nav>
<div class="row mt-3">
  <div id="c1" class="col-sm-12">
    <table class="table table-sm " id="tbl_tra">
  <thead>
    <tr>
      <th>Account</th>
      <th>Action Taken</th>
      <th>User</th>
    </tr>
  </thead>
  <tbody id="alltranstbl">

  </tbody>
</table>


  </div>
  <div id="c2" class="col-sm-3" style="display: none;">
    <div class="card">
      <div class="card-body">
         <h5 class="mb-3"><i class="fas fa-tags"></i> Action Tags</h5>
        <table class="table table-sm">
         <thead>
           <tr>
             <th>Code</th>
             <th>Action</th>
           </tr>
         </thead>
         <tbody>
            <tr>
            <td>a01</td>
            <td>Imported asset package</td>
          </tr>
          <tr>
            <td>a02</td>
            <td>Generated Report</td>
          </tr>
          <tr>
            <td>a03</td>
            <td>Disposed an asset</td>
          </tr>
           <tr>
            <td>a04</td>
            <td>Created new account</td>
          </tr>
          <tr>
            <td>a05</td>
            <td>Deleted an Account</td>
          </tr>
          <tr>
            <td>a06</td>
            <td>Edited an Account Info</td>
          </tr>
          <tr>
            <td>a07</td>
            <td>Restored an Asset</td>
          </tr>
         </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $.ajax({
    type: "POST",
    url: "get_all_transhistory",
    data: {_token:"<?php echo e(csrf_token()); ?>"},
    success: function(data){
      // alert(data);
      $("#alltranstbl").html(data);
      $("#tbl_tra").DataTable();
    }
  })
  var showed = false;
  $("#btn_myactlogs").click(function(){
    if(!showed){
      $("#c1").removeClass("col-sm-12");
       $("#c1").addClass("col-sm-9");
       $("#c2").css("display","block");
       showed = true;
       $("#btn_myactlogs").html('<i class="fas fa-tags"></i> Hide Action Tags');
    }else{
$("#c1").removeClass("col-sm-9");
       $("#c1").addClass("col-sm-12");
       $("#c2").css("display","none");
      showed = false;
       $("#btn_myactlogs").html('<i class="fas fa-tags"></i> Show Action Tags');
    }
  })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>