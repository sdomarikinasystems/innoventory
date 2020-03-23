

<?php $__env->startSection('title'); ?>
ProcMS - Innoventory
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="/innoventory/asset/registry">Asset Registry</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navitem" aria-controls="navitem" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navitem">
    <ul class="navbar-nav mr-auto">
           <li class="nav-item">
        <a class="nav-link" href="#"><i class="fas fa-arrow-circle-right"></i> <span id="a_navname"></span></a>
      </li>
    </ul>
  </div>
</nav>

<div class=" mt-3">
  <div class="row">
     <div class="col-md-6">
      <h5 class="mb-3"><i class="far fa-compass"></i> Location</h5>
       <table class="table table-sm table-bordered">
      <tr><td>Office Type</td><td id="a_offtype"></td></tr>
      <tr><td>Office Name</td><td id="a_offname"></td></tr>
      <tr><td>Service Center</td><td id="a_sercen"></td></tr>
      <tr><td>Room Number</td><td id="a_roonum"></td></tr>
      <tr><td>Name of Accountable Officer</td><td id="a_noaccoff"></td></tr>
      <tr><td>Asset Location</td><td id="a_assloc"></td></tr>
       </table>
    </div>
    <div class="col-md-6">
      <h5 class="mb-3"><i class="fas fa-tag"></i> Specifications</h5>
       <table class="table table-sm table-bordered">
      <tr><td>Property Number</td><td id="a_prn"></td></tr>
      <tr><td>Asset Item</td><td id="a_itemname"></td></tr>
      <tr><td>Asset Classification</td><td id="a_assclass"></td></tr>
      <tr><td>Asset Sub Class</td><td id="a_subclass"></td></tr>
      <tr><td>UACS Object Code</td><td id="a_uac"></td></tr>
      <tr><td>Manufacturer</td><td id="a_manu"></td></tr>
      <tr><td>Model</td><td id="a_model"></td></tr>
      <tr><td>Serial Number</td><td id="a_serialnum"></td></tr>
      <tr><td>Specification</td><td id="a_specif"></td></tr>
      <tr><td>Current Condition</td><td id="a_current"></td></tr>
      <tr><td>Estimated Total Life Years</td><td id="a_ely"></td></tr>
      <tr><td>Status</td><td id="a_stat"></td></tr>
      <tr><td>Unit of Mesure</td><td id="a_uom"></td></tr>
       </table>
    </div>
    <div class="col-md-6">
      <h5 class="mb-3"><i class="fas fa-receipt"></i> Funding</h5>
       <table class="table table-sm table-bordered">
      <tr><td>Source of Fund</td><td id="a_sof"></td></tr>
      <tr><td>Cost of Acquisition</td><td id="a_coa"></td></tr>
      <tr><td>Date of Acquisition</td><td id="a_doa"></td></tr>
      <tr><td>Remarks</td><td id="a_rem"></td></tr>
       </table>
    </div>
       
  </div>
</div>

<script type="text/javascript">
  $.ajax({
    type: "POST",
    url: "get_asset_full",
    data: {_token: "<?php echo e(csrf_token()); ?>",asset_id:<?php echo json_encode($_GET["asset_id"]); ?>},
    success: function(data){
      // alert(data);
      $("#a_navname").html(data[0]["asset_item"]);
      $("#a_prn").html(data[0]["property_number"]);
      $("#a_itemname").html(data[0]["asset_item"]);
      $("#a_offtype").html(data[0]["office_type"]);
      $("#a_offname").html(data[0]["office_name"]);
      $("#a_assclass").html(data[0]["asset_classification"]);
      $("#a_subclass").html(data[0]["asset_sub_class"]);

      $("#a_uac").html(data[0]["uacs_object_code"]);
      $("#a_manu").html(data[0]["manufacturer"]);
      $("#a_model").html(data[0]["model"]);
      $("#a_serialnum").html(data[0]["serial_number"]);
      $("#a_specif").html(data[0]["specification"]);
      $("#a_current").html(data[0]["current_condition"]);
      $("#a_sof").html(data[0]["source_of_fund"]);
      $("#a_coa").html(data[0]["cost_of_acquisition"]);

      $("#a_doa").html(data[0]["date_of_acquisition"]);
      $("#a_ely").html(data[0]["estimated_total_life_years"]);
      $("#a_noaccoff").html(data[0]["name_of_accountable_officer"]);
      $("#a_assloc").html(data[0]["asset_location"]);
      $("#a_rem").html(data[0]["remarks"]);
      $("#a_uom").html(data[0]["unit_of_measure"]);
      $("#a_sercen").html(data[0]["service_center"]);
      $("#a_roonum").html(data[0]["room_number"]);
      var mystatus = "";

      switch(data[0]["status"]){
        case "0":
          mystatus = "Normal Condition";
        break;
         case "1":
          mystatus = "Condemnation / Desctruction";
        break;
         case "2":
          mystatus = "Transfer of Property";
        break;
        case "3":
          mystatus = "Donation of Property";
        break;
        case "4":
          mystatus = "Sale of Unserviceable Property";
        break;
      }
      $("#a_stat").html(mystatus);
    }
  })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>