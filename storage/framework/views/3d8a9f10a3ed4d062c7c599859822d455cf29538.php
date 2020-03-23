<!DOCTYPE html>
<html>
	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js" integrity="sha256-9MzwK2kJKBmsJFdccXoIDDtsbWFh8bjYK/C7UjB1Ay0=" crossorigin="anonymous"></script>

	<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" />


	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	<script type="text/javascript" src="https://cdn.jsdelivr.net/jsbarcode/3.6.0/JsBarcode.all.min.js"></script>

<head>
	<title>Print Page</title>
</head>
<style type="text/css">
	.loader {
		border: 4px solid #f3f3f3;
		border-radius: 50%;
		border-top: 4px solid #3498db;
		width: 50px;
		height: 50px;
		-webkit-animation: spin 1s linear infinite; /* Safari */
		animation: spin 1s linear infinite;
	}
	@keyframes  spin {
		0% { transform: rotate(0deg); }
		100% { transform: rotate(360deg); }
	}
	

	.qrcode {
		display: inline-block;
		width: 310px;
		height: 92px;
		margin-right: 10px;
		margin-bottom: 8px;
		padding: 10px;
		/*border: 1px solid #999;*/
	}

	canvas {
		float: left;
		width: 24%;
	}
	
	.qrtext {
		display: none;
		float: right;
		width: 72%;
		font-family: monospace;
		font-size: 13px;
		line-height: 12px;
		text-transform: uppercase;
	}
	
</style>
<body id="bod">

<!-- FIXED BY VIRMIL TALATTAD -->


	<!-- <h1>Total to load <span id="totaltoload"></span></h1> -->
	<!-- <h2>Loaded <span id="totalcurrentloaded"></span></h2> -->
	<!-- Modal -->
	<div id="myModal" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog" style="background: white;">
		<div class="modal-dialog" >
			<!-- Modal content-->
			<div class="modal-content" style="border: 0; box-shadow: 0px 0px 0px 0px; ">
				<div class="modal-body" style="padding-top: 40%;">
					<center>
						<div class="form-group">
							<h4>Please wait a moment.</h4>
						</div>
						<div class="loader"></div>
					</center>
				</div>
			</div>
		</div>
	</div>
	<div id="wrapper">
	</div>
</body>
</html>
<script type="text/javascript">
	var doneload = false;
	var totallod = 0;
	var current = 0;
	var toappend;
	$(document).ready(function(){
        $('#myModal').modal('toggle');
        // setTimeout(function(){
           
        // }, 2000)
	})

	$(document).ready(function(){
		var data=localStorage.getItem('pnumber_arr');
		var json_data = JSON.parse(data);

		totallod = json_data.length;
		for (var i =0; i < json_data.length; i++) {
			var pnumberarr=json_data[i];
			$.ajax({
				url: "<?php echo e(route('g_items')); ?>",
				type: "POST",
				data: {
					_token: "<?php echo e(csrf_token()); ?>",
					tag: "selectmp_bypr",
					p_number: pnumberarr
				},
				complete: function(response){
					var data = JSON.parse(response.responseText);
					// console.log(data);
					for (var key in data) {
						var pnumber_x = data[key].property_number;
						var asset_item = data[key].asset_item;
						var asset_classification = data[key].asset_classification;
						var current_condition = data[key].current_condition;
						var service_center = data[key].service_center;
						var room_number = data[key].room_number;
						var sch_name = "<?php echo e(session ('user_schoolname')); ?>";

						if(pnumber_x != ""){
							toappend += '<svg class="barcode" jsbarcode-value="3345545677"></svg>';
						}
						
						// $("#wrapper").append();

						// $('#wrapper').append('<div class="qrcode" data-pno="' +pnumber_x + '"><div class="qrtext">' + sch_name + "<br>" +pnumber_x+ '<br>' + " " +asset_item+ '<br>' + " " +service_center+ ' (' + room_number + ')</div></div>');
						current += 1;
					}
				}	
			})
		}
		// LoadComplete();
	})
	
	setInterval(function(){
		// $("#totaltoload").html(totallod);
		// $("#totalcurrentloaded").html(current);
		if(totallod == current && doneload == false){
			$("#wrapper").html(toappend);
			doneload = true;
			JsBarcode(".barcode", "Smallest width",{
				width:1,
				height:40
			}).init();
			 $('#myModal').modal('toggle');
		}

	}, 100)
	

	// function LoadComplete(){
	// 	$('#wrapper').children().each(function(){
	// 		$(this).qrcode({
	// 			width: 70,
	// 			height: 70,
	// 			text: $(this).data('pno')
	// 		});
	// 	})
	// }
</script>