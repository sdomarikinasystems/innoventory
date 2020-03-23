<?php $__env->startSection('title'); ?>
PMS Inventory
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Disposed Assets</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navitem" aria-controls="navitem" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navitem">
    <ul class="navbar-nav mr-auto">
    </ul>
  </div>
</nav>

<div class="row mt-3">
  <div class="col-sm-3">
    <div class="card">
      <div class="card-body">
        <h5>Legends</h5>
        <ul>
          <li><i style="color: #c0392b;" class="fas fa-circle"></i> Condemnation / Desctruction</li>
           <li><i style="color: #27ae60;" class="fas fa-circle"></i> Transfer of Property</li>
            <li><i style="color: #2980b9;" class="fas fa-circle"></i> Donation of Property</li>
             <li><i style="color: #8e44ad;" class="fas fa-circle"></i> Sale of Unserviceable Property</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="mt-3">
  <table class="table table-sm table-striped table-bordered" id="tbl_dis">
  <thead>
    <tr>
      <th scope="col">Property Number</th>
      <th scope="col">Asset Item</th>
      <th scope="col">Asset Classification</th>
      <th scope="col">Current Condition</th>
      <th scope="col">Asset Location</th>
      <th scope="col">Room</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody id="allmyassests">
  </tbody>
</table>
</div>


<form action="" method="">
  <div class="modal" tabindex="-1" id="m_view" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">ITEM INFORMATION</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Modal body text goes here.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</form>

<form action="restore_asset" method="POST">
  <?php echo e(csrf_field()); ?>

  <div class="modal" tabindex="-1" id="m_remove" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">ITEM RESTORATION</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="the_asset_to_dispose_id" name="asset_id">
          <p>Restore this item from the Assets Registry?</p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Restore</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</form>

  <script type="text/javascript">

  function OpenAssetToDispose(control_obj){
    $("#the_asset_to_dispose_id").val($(control_obj).data("asset_id"));
  }

    LoadAssets();
    function LoadAssets(){
      $.ajax({
        type : "POST",
        url : "displaydisposedassets",
        data : {_token:"<?php echo e(csrf_token()); ?>"},
         success : function(data){
            $("#allmyassests").html(data);
            $("#tbl_dis").DataTable();
         }
      })
    }
  </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>