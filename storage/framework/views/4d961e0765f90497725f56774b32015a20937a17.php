

<?php $__env->startSection('title'); ?>
ProcMS - Innoventory
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>

<h2>QR Stickers</h2>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Home</li>
		<li class="breadcrumb-item active" aria-current="page">Utilities</li>
	</ol>
</nav>

<div class="row mb-3">
	<div class="col-sm-6">
		<h5><i class="fas fa-filter"></i> Filter</h5>
		<div class="form-group">
			<label>Service Center</label>
			<select class="form-control" onchange="	LoadContentsbyservicecenter(this)" id="id_qrfilter">
				
			</select>
		</div>
	</div>
	<div class="col-sm-6">
	<div class="card" id="startinginfo">
		<div class="card-body">
			<h5><i class="fas fa-tasks"></i> Check item(s) to Generate</h5>
			<h6>You can <strong>Check All</strong> to print all QR Stickers for your asset(s) or individually select and filter them.</h6>
			<hr>
			<a href="" data-toggle="modal" data-target="#modal_miss"><i class="fas fa-question-circle"></i> I'm missing some items here</a>
		</div>
	</div>

	<div class="card" id="selectinginfo">
		<div class="card-body">
			<h5 id="selected_count"></h5>
			<button class="btn btn-primary mt-3" id="print"><i class="fas fa-qrcode"></i> Print to QR Stickers</button>
		</div>
	</div>
	
	</div>
	
</div>

<div class="modal" tabindex="-1" role="dialog" id="modal_miss">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">More Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		  <p>LGU, Disposed asset(s), Missing Room Number and Service Center(s) are not included in your QR Generation Page.</p>
      </div>
    </div>
  </div>
</div>
<div class="row">
	<div class="col-sm-12 table-responsive">
		<table class="table table-hover table-bordered" id="tbl_ass">
		<thead>
			<tr>
				<th scope="col">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" onclick="toggle(this);" id="master_check">
						<label class="form-check-label" for="defaultCheck1">
							&nbsp;
							Check All
						</label>
					</div>
				</th>
				<th scope="col" width="150">Property Number</th>
				<th scope="col">Asset Item</th>
				<th scope="col">Asset Classification</th>
				<th scope="col">Current Condition</th>
				<th scope="col">Service Center</th>
				<th scope="col">Room</th>
			</tr>
		</thead>
		<tbody id="tbl_qrcontents">
			<?php $__currentLoopData = $key; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td>
						<div class="form-check">
							<input data-propno="<?php echo e($data['property_number']); ?>" class="form-check-input checkbox_y" type="checkbox" value="" id="defaultCheck1">
						</div>
					</td>
					<td><?php echo e($data['property_number']); ?></td>
					<td><?php echo e($data['asset_item']); ?></td>
					<td><?php echo e($data['asset_classification']); ?></td>
					<td><?php echo e($data['current_condition']); ?></td>
					<td><?php echo e($data['service_center']); ?></td>
					<td><?php echo e($data['room_number']); ?></td>
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
	setInterval(function(){
		var countofselected = 0;
		$('table tr').each(function(i) {
				    // Cache checkbox selector
				    var chkbox = $(this).find('input[class="form-check-input checkbox_y"]');

				    // Only check rows that contain a checkbox
				    if(chkbox.prop('checked') == true) {
				    	countofselected ++;
				    }
				});
		if(countofselected == 0){
			$("#selectinginfo").css("display","none");
$("#startinginfo").css("display","block");

		}else{
			$("#selected_count").html("<i class='fas fa-print'></i> Print <strong>" + countofselected + "</strong> Visible Selected Asset(s)");
			$("#selectinginfo").css("display","block");
			$("#startinginfo").css("display","none");
		}
		
	},100)

	LoadServiceCenterFilter();
	function LoadServiceCenterFilter(){
		$.ajax({
			type:"POST",
			url: "<?php echo e(route('get_ser_of_sta_fo_fil')); ?>",
			data: {_token:"<?php echo e(csrf_token()); ?>"},
			success: function(data){
				$("#id_qrfilter").html(data);

			}
		})
	}

	function LoadContentsbyservicecenter(control_obj){
		var myval = $(control_obj).val().split("|");
		// alert(myval[0]);
		$.ajax({
			type:"POST",
			url: "<?php echo e(route('Loadqrbyservicecen')); ?>",
			data: {_token:"<?php echo e(csrf_token()); ?>",service_center:myval[0],room_number:myval[1]},
			success: function(data){
				// alert(data);
				  $("#tbl_ass").DataTable().destroy();
				$("#tbl_qrcontents").html(data);
				$("#tbl_ass").DataTable();
			}
		})
	}

	function toggle(source) {
	var checkboxes = document.querySelectorAll('input[type="checkbox"]');
		for (var i = 0; i < checkboxes.length; i++) {
			if (checkboxes[i] != source)
		    	checkboxes[i].checked = source.checked;
		}
	}

	$('#tbl_ass').DataTable({  "bPaginate": false,"ordering":false});
	$('#print').click(function(){
		var arr1 = [];
		$('table tr').each(function(i) {
		    // Cache checkbox selector
		    var chkbox = $(this).find('input[class="form-check-input checkbox_y"]');

		    // Only check rows that contain a checkbox
		    if(chkbox.prop('checked') == true) {
		    	console.log(chkbox.data('propno'));
				arr1.push(chkbox.data('propno'));
		    }
		});
		if(arr1.length == 0) {
			alert("Please select and asset first before you print QR Stickers!");
		} else {
			localStorage.setItem('pnumber_arr', JSON.stringify(arr1));
			console.log(JSON.stringify(arr1));
			window.open('<?php echo e(route("pr_asset")); ?>', '_blank'); // <- This is what makes it open in a new window.
		}
	})
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>