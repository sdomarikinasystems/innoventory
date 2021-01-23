<!DOCTYPE html>
<html>
	

<head>
	<title id="ttlperc">Inno... - QR Code Generation</title>
<link rel='icon' href='{{ asset("images/sdo.ico") }}' type='image/x-icon'/ >
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<!-- NEW QR TECHNOLOGY --> 
	<script src="https://cdn.jsdelivr.net/npm/davidshimjs-qrcodejs@0.0.2/qrcode.min.js" integrity="sha256-xUHvBjJ4hahBW8qN9gceFBibSFUzbe9PNttUvehITzY=" crossorigin="anonymous"></script>

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
		overflow: hidden;
	}

	.loadingui{
		left: 0;
		right: 0;
		background-color: #F7F7F9;
		z-index: 100;
		width: 100%;
		height: 100%;
		position: fixed;


	}


</style>
<body id="bod" style="overflow: hidden;">
<!-- FIXED BY VIRMIL TALATTAD -->
	<div class="loadingui">
		<div class="container">
		<div style="margin:auto; width: 540px; margin-top: 35vh; ">
			<div class="card" style="box-shadow: 0px 2px 5px rgba(0,0,0,0.1); border-radius: 10px !important;
		animation-name: scale-in;
		animation-duration: 0.3s;
		overflow:hidden;
		border-color: #EEEEF2 !important;">
				<div class="card-body">
					<div class="mt-4 mb-4">
						<h4 id="percentagecounter" class="float-right text-primary"></h4>
		<h4 ><img src="https://uploads.toptal.io/blog/image/122385/toptal-blog-image-1489082610696-459e0ba886e0ae4841753d626ff6ae0f.gif" style="width: 30px; margin-right: 10px;">Generating QR Stickers</h4>
		<progress value="" style="width: 100%;" id="xproggen" max=""></progress>
		<p class="text-muted mb-0"><span id="currs">0</span> out of <span id="totss">0</span> QR code has been successfully generated.</p>
					</div>
				</div>
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
	var gentime = 1000;
	var loaded_data_pausetime = 0;


	var asset_type = <?php echo json_encode($_GET["ass_type"]); ?>;
	var loca_id = <?php
	$transter =  $_GET["locationinfo"];
	$transter = explode("|", $transter);
	$ozon = sdmdec($transter[0]);
	echo json_encode($ozon . "|" . $transter[1]);
    function sdmdec($data){
      $keycode = openssl_digest(utf8_encode("virmil"),"sha512",true);
      $string = substr($keycode, 10,24);
      $utfData = base64_decode($data);
      $decryptData = openssl_decrypt($utfData, "DES-EDE3", $string, OPENSSL_RAW_DATA,'');
      return $decryptData;
    }
	?>;
	// alert(loca_id);
	loca_id = loca_id.split("|");
	var rname = loca_id[0];
	var rnum =loca_id[1];
	var alreadydone = "";
	var data=localStorage.getItem('pnumber_arr');
	var json_data = JSON.parse(data);
	totallod = json_data.length;

	$("#xproggen").prop("max",totallod);
		

coco();
    	async function coco(){
    			for (var i = 0; i < json_data.length;i++) {
		var pnumberarr=json_data[i];	
	
		if(loaded_data_pausetime < 100){
			await timer(256);
			GenSelect(pnumberarr);
			// loaded_data_pausetime++;
			gentime -= 234;
		}else{
			await timer(1000);
			// alert("pausetime");
			GenSelect(pnumberarr);
			loaded_data_pausetime = 0;
		}
	}
    	}
    	
function timer(ms) { return new Promise(res => setTimeout(res, ms)); }

var inserted = false;
async function GenSelect(pnumberarr){
	
		// setTimeout(function(){
			// alert(pnumberarr + "---" + rname + "----" + rnum + "----" + asset_type + "----");
			$.ajax({
				url: "{{ route('g_items') }}",
				type: "POST",
				data: {
					_token: "{{ csrf_token() }}",
					tag: "selectmp_bypr",
					p_number: pnumberarr,
					room_name: rname,
					room_number: rnum,
					ass_type: asset_type
				},
				success: function(response){

					// alert(response);
					if(asset_type == "co"){
					// CAPITAL OUTLAY
					
					var data = JSON.parse(response);
					// console.log(data);
					for (var key in data) {
						var pnumber_x = data[key].property_number;
						var asset_item = data[key].asset_item;
						var asset_classification = data[key].asset_classification;
						var current_condition = data[key].current_condition;
						var service_center = data[key].service_center;
						var room_number = data[key].room_number;
						var sch_name = "{{ session ('user_schoolname')}}";

						var propername = "";

						if(asset_item.length > 50){
							propername = asset_item.substr(1, 50) + "...";
						}else{
							propername = asset_item;
						}
current += 1;

$("#xproggen").val(current);
var percentage_value_trans = ((current / totallod) * 100).toFixed(0) + "%";
document.title = "Inno... - (" + percentage_value_trans +  ") QR Code Generation";
$("#percentagecounter").html(percentage_value_trans);
						$('#wrapper').append('<div class="printbox"><div id="qrcode_' + current + '" data-pno="' +pnumber_x + '"><div class="qrtext">' + sch_name + "<br>" + pnumber_x + '<br>' + " " +  propername + '<br>' + " " +service_center+ ' (' + room_number + ')</div></div></div>');

						var qrcode = new QRCode(document.getElementById("qrcode_" + current),{
							text: pnumber_x,
							width: 80,
							height: 80,
							colorDark : "#000000",
							colorLight : "#ffffff",
							correctLevel : QRCode.CorrectLevel.H
						});

					   


						
						   $("#currs").html(current);
					    $("#totss").html(totallod);
					    if(current == totallod){
					    	 $("#currs").html(totallod);
					    $("#totss").html(totallod);
					    	$(".loadingui").css("display","none");
					    	$("body").css("overflow","auto");
					    }
					}
					}else{
						//SEMI EXPENDABLE

					

					var data = JSON.parse(response);
					// console.log(JSON.parse(response).length);
					// console.log(data);
					// if(data.length ==0){
					// 	alert("huli ka balbon!");
					// }
					for (var key in data) {

						var did = data[key].dataid;
						var pnumber_x = data[key].stock_number;
						var asset_item = data[key].description;
						var asset_classification = data[key].asset_classification;
						var service_center = data[key].office;
						var room_number = data[key].room_number;
						var sch_name = "{{ session ('user_schoolname')}}";
						var balance_per_card = data[key].balance_per_card;

						if(!alreadydone.includes("(" + did + ")")){
						inserted = true;
						alreadydone += "(" + did + ")";

						var propername = "";

						if(asset_item.length > 50){
							propername = asset_item.substr(1, 50) + "...";
						}else{
							propername = asset_item;
						}
current += 1;

$("#xproggen").val(current);
var percentage_value_trans = ((current / totallod) * 100).toFixed(0) + "%";
document.title = "Inno... - (" + percentage_value_trans +  ") QR Code Generation";
$("#percentagecounter").html(percentage_value_trans);
						$('#wrapper').append('<div class="printbox"><div id="qrcode_' + current + '" data-pno="' +pnumber_x + '"><div class="qrtext">' + sch_name + "<br>" +pnumber_x+ '<br>' + " " + propername + " X" + balance_per_card + '<br>' + " " +service_center+ ' (' + room_number + ')</div></div></div>');

						
						var qrcode = new QRCode(document.getElementById("qrcode_" + current),{
							text: pnumber_x,
							width: 80,
							height: 80,
							colorDark : "#000000",
							colorLight : "#ffffff",
							correctLevel : QRCode.CorrectLevel.H
						});


						
						   $("#currs").html(current);
					    $("#totss").html(totallod);
					    if(current == totallod){
					    	 $("#currs").html(totallod);
					    $("#totss").html(totallod);
					    	$(".loadingui").css("display","none");
					    	$("body").css("overflow","auto");
					    }
					}
	

						}

						
					}
				}	
			})

		// },gentime)

		
		}
</script>