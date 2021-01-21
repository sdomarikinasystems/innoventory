<!DOCTYPE html>
<html>
	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js" integrity="sha256-9MzwK2kJKBmsJFdccXoIDDtsbWFh8bjYK/C7UjB1Ay0=" crossorigin="anonymous"></script> -->

	<!-- NEW QR TECHNOLOGY --> 
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

	<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" />

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	<script type="text/javascript" src="https://cdn.jsdelivr.net/jsbarcode/3.6.0/JsBarcode.all.min.js"></script>

<head>
	<title>QR Code Generation</title>
</head>
<style type="text/css">
	

	.qrcode {
		display: inline-block;
		width: 310px;
		height: 92px;
		margin-right: 10px;
		margin-bottom: 8px;
		padding: 10px;
		border: 1px solid #999;
	}
	
	.qrtext {
		/*display: none;*/
		float: right;
		width: 72%;
		font-family: monospace;
		font-size: 13px;
		line-height: 12px;
		text-transform: uppercase;
		padding-left: 10px;
	}

	.printbox{
		border: 1px solid gray;
		display: block;
		width: 310px;
		height: 92px;
		float: left;
		padding:5px;
		margin: 10px;
		animation-name: popin;
		animation-duration: 0.3s;
	}
	@keyframes popin{
		0%{
			transform: scale(0.1);
		}

		50%{
			transform: scale(1.1);
			box-shadow: 0px 1px 20px gray;
		}
	}
	.loadingui{
		left: 0;
		right: 0;
		background-image: linear-gradient(white , rgba(255,255,255,0.6));
		z-index: 100;
		width: 100%;
		height: 100%;
		position: fixed;
	}
</style>
<body id="bod">
<!-- FIXED BY VIRMIL TALATTAD -->
	<div class="loadingui">
		<div class="container">
			<center>
				<br>
				<br>
				<br>
				<h1 class="mt-5">Generating QR Stickers</h1>
			<h3 class="text-muted">Total (<span id="currs"></span>/<span id="totss"></span>)</h3>
			</center>
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
	var gentime = 1000;

		var data=localStorage.getItem('pnumber_arr');
		var json_data = JSON.parse(data);


		totallod = json_data.length;

		for (var i =0; i < json_data.length; i++) {
			var pnumberarr=json_data[i];
				
				GenSelect(pnumberarr);
				
				

		}

function GenSelect(pnumberarr){
		setTimeout(function(){
			$.ajax({
				url: "{{ route('g_items') }}",
				type: "POST",
				data: {
					_token: "{{ csrf_token() }}",
					tag: "selectmp_bypr",
					p_number: pnumberarr
				},
				complete: function(response){
					gentime -= 234;
					var data = JSON.parse(response.responseText);
					// console.log(data);
					for (var key in data) {
						var pnumber_x = data[key].property_number;
						var asset_item = data[key].asset_item;
						var asset_classification = data[key].asset_classification;
						var current_condition = data[key].current_condition;
						var service_center = data[key].service_center;
						var room_number = data[key].room_number;
						var sch_name = "{{ session ('user_schoolname')}}";

						$('#wrapper').append('<div class="printbox"><div id="qrcode' + current + '" data-pno="' +pnumber_x + '"><div class="qrtext">' + sch_name + "<br>" +pnumber_x+ '<br>' + " " +asset_item+ '<br>' + " " +service_center+ ' (' + room_number + ')</div></div></div>');

						var qrcode = new QRCode("qrcode" + current,{
							   width: 80,
							    height: 80,
						});

					    var elText = pnumber_x;

					    qrcode.makeCode(pnumber_x);


						current += 1;
						   $("#currs").html(current);
					    $("#totss").html(totallod);
					    if(current == totallod){
					    	 $("#currs").html(totallod);
					    $("#totss").html(totallod);
					    	$(".loadingui").css("display","none");
					    }
					}
				}	
			})

		},gentime)

		gentime += 345;
		}
</script>