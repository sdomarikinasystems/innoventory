<?php $__env->startSection('title'); ?>
PMS Inventory
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>

<h2>Utilities</h2>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Home</li>
		<li class="breadcrumb-item active" aria-current="page">Utilities</li>
	</ol>
</nav>

<div class="row">
	<div class="col-sm-12">
		<div class="form-group">
			<button class="btn btn-success" id="print"><i class="fas fa-qrcode fa-fw"></i> Print QR Code Labels</button>
		</div>
	</div>
	<div class="col-sm-12 table-responsive table-sm">
		<table class=" table table-bordered" id="tbl_ass">
		<thead>
			<tr>
				<th scope="col">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" onclick="toggle(this);" id="master_check">
						<label class="form-check-label" for="defaultCheck1">
							&nbsp;
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
		<tbody>
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
	function toggle(source) {
		var checkboxes = document.querySelectorAll('input[type="checkbox"]');
		for (var i = 0; i < checkboxes.length; i++) {
			if (checkboxes[i] != source)
		    	checkboxes[i].checked = source.checked;
		}
	}
	$('#tbl_ass').DataTable({  "bPaginate": false});
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
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'No asset selected.',
			})
		} else {
			localStorage.setItem('pnumber_arr', JSON.stringify(arr1));
			console.log(JSON.stringify(arr1));
			window.open('<?php echo e(route("pr_asset")); ?>', '_blank'); // <- This is what makes it open in a new window.
		}
	})
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>