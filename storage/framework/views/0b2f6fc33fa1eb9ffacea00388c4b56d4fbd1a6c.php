<?php $__env->startSection('title'); ?>
CDTRS Online Portal
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>


<div class="container">
	<img src="<?php echo e(asset('images/check.png')); ?>" class="mt-5" style="width:60px;">
	<h5 class="card-title">First thing's first!</h5>
<h6 class="card-subtitle text-muted mb-5">Rules in using CDTRS Online Portal</h6>


	<div class="card" id="introcard_0">
		<div class="card-body">
			<h5 class="card-title">Don't share.</h5>
			<h6 class="card-subtitle text-muted mb-5">Never tell anyone your DepEd email, CDTRS Online Portal password/login credentials.</h6>
			<div class="row">
				<div class="col-sm-6">
					
				</div>
				<div class="col-sm-3">
				 	
				</div>
				<div class="col-sm-3">
				 	<button class="mb-2 btn btn-primary btn-block btnnext" >Next</button>
				</div>
			</div>
		</div>
	</div>


	<div class="card" id="introcard_1">
		<div class="card-body">
			<h5 class="card-title">Only you will apply for your Leave.</h5>
			<h6 class="card-subtitle text-muted mb-5">Clerk and ICT Coordinator is not responsible for applying your Leave and Dispute in CDTRS Online Portal.</h6>
			<div class="row">
				<div class="col-sm-6">
					
				</div>
				<div class="col-sm-3">
				 	<button class="mb-2 btn btn-light btn-block btnstart">Start Again</button>
				</div>
				<div class="col-sm-3">
				 	<button class="mb-2 btn btn-primary btn-block btnnext" >Next</button>
				</div>
			</div>
		</div>
	</div>


		<div class="card" id="introcard_2">
		<div class="card-body">
			<center>
				<h5 class="card-title">You're good to go!</h5>
			<h6 class="card-subtitle text-muted mb-5">Please remember and follow our simple rules wholeheartedly.</h6>
			</center>
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-3">
					<button class="mb-2 btn btn-light btn-block btnstart">Start Again</button>
				</div>
				<div class="col-sm-3">
				 	<a class="mb-2 btn btn-primary btn-block btnnext" href="dashboard">Continue to Portal <i class="fas fa-arrow-right"></i></a>
				</div>
				<div class="col-sm-3"></div>
			</div>
		</div>
	</div>



</div>

<script type="text/javascript">
	var allconts = ["#introcard_0","#introcard_1","#introcard_2"];
	var currentpage = 0;
	disable_introcards();
	$(allconts[0]).css("display","block");

	function disable_introcards(){
		for(i = 0;i < allconts.length;i++){
			$(allconts[i]).css("display","none");
		}
		
	}
	$(".btnnext").click(function(){
		if(currentpage != allconts.length){
			disable_introcards();
			currentpage++;
		}
		$(allconts[currentpage]).css("display","block");
	});

	$(".btnstart").click(function(){
		disable_introcards();
		currentpage = 0;
		$(allconts[currentpage]).css("display","block");
	})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>