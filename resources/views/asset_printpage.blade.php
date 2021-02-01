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
<style type="text/css">
.card-shadow{box-shadow:0 2px 3px rgba(0,0,0,.08),0 10px 30px rgba(0,0,0,.08)}.qrcode{display:inline-block;width:310px;height:92px;margin-right:10px;margin-bottom:8px;padding:10px;border:1px solid #999}.qrtext{float:right;width:72%;font-family:monospace;font-size:13px;line-height:12px;text-transform:uppercase;padding-left:10px}.printbox{border:1px solid gray;display:block;width:310px;height:92px;float:left;padding:5px;margin:10px;overflow:hidden}.loadingui{left:0;right:0;background-color:#f7f7f9;z-index:100;width:100%;height:100%;position:fixed}
</style>
<script type="text/javascript">
	!function(n){n.fn.DuplicateWindow=function(){var t=5e3,e=500,i="my-application-browser-tab",o={Session:1,Local:2};function s(n){var t="";switch(n){case o.Session:t=window.name;break;case o.Local:null==(t=decodeURIComponent(function(n){for(var t=n+"=",e=document.cookie.split(";"),i=0;i<e.length;i++){for(var o=e[i];" "==o.charAt(0);)o=o.substring(1,o.length);if(0==o.indexOf(t))return o.substring(t.length,o.length)}return null}(i)))&&(t="")}return t}function r(n,t){switch(n){case o.Session:window.name=t;break;case o.Local:!function(n,t,e){var i="";if(e){var o=new Date;o.setTime(o.getTime()+24*e*60*60*1e3),i="; expires="+o.toUTCString()}document.cookie=n+"="+(t||"")+i+"; path=/"}(i,t)}}function a(){var n=s(o.Session)||function(){return this.s4=function(){return Math.floor(65536*(1+Math.random())).toString(16).substring(1)},this.s4()+this.s4()+"-"+this.s4()+"-"+this.s4()+"-"+this.s4()+"-"+this.s4()+this.s4()+this.s4()}();r(o.Session,n);var i=s(o.Local),a=(""==i?null:JSON.parse(i))||null;if(console.log(i),console.log(n),console.log(a),null===a||a.timestamp<(new Date).getTime()-t||a.guid===n){function c(){var t={guid:n,timestamp:(new Date).getTime()};r(o.Local,JSON.stringify(t))}return c(),setInterval(c,e),!1}return!0}window.IsDuplicate=function(){return a()},n(window).on("beforeunload",function(){0==a()&&r(o.Local,"")})},n(window).DuplicateWindow()}(jQuery);
</script>
</head>
<body id="bod" style="overflow: hidden;">
   <!-- FIXED BY VIRMIL TALATTAD -->
   <div class="loadingui">
      <div class="container">
         <div style="margin:auto; width: 540px; margin-top: 35vh; ">
            <div class="card card-shadow" style=" border-radius: 10px !important;
               animation-name: scale-in;
               animation-duration: 0.3s;
               overflow:hidden;
               border-color: #EEEEF2 !important;">
               <div class="card-body">
                  <div class="mt-4 mb-4">
                     <h4 id="percentagecounter" class="float-right text-primary"></h4>
                     <h4 ><img src="https://uploads.toptal.io/blog/image/122385/toptal-blog-image-1489082610696-459e0ba886e0ae4841753d626ff6ae0f.gif" style="width: 30px; margin-right: 10px;">Generating QR Stickers</h4>
                     <progress value="" style="width: 100%;" id="xproggen" max=""></progress>
                     <p class="text-muted mb-0" id="txt_okstat" style="display: none;"><span id="currs">0</span> out of <span id="totss">0</span> QR code has been successfully generated.</p>
                     <p class="text-muted mb-0" id="warmuptxt">Preparing data...</p>
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
	if (window.IsDuplicate()) {
		alert("Inventory scanner page is already open in another tab.");
		window.close();
	}
	var doneload = false;
	var totallod = 0;
	var current = 0;
	var toappend;
	var gentime = 1000;
	var loaded_data_pausetime = 0;
	var asset_type = <?php echo json_encode($_GET["ass_type"]); ?>;
	var loca_id = <?php echo json_encode($_GET["locationinfo"]); ?>;
	loca_id = loca_id.split("~");
	dec_data();
	var rname ="";
	var rnum ="";
	function dec_data(){
		lcx = loca_id[0].replace(" ", "+")
		$.ajax({
		type:"GET",
		url: "{{ route('shoot_trans_sdm') }}",
		data: {_token: "{{ csrf_token() }}",todec: lcx},
		success: function(data){
		loca_id[0] = data;
		rname = loca_id[0];
		rnum =loca_id[1];
		coco();
		}
		})
	}
	var alreadydone = "";
	var data=localStorage.getItem('pnumber_arr');
	var json_data = JSON.parse(data);
	totallod = json_data.length;

	$("#xproggen").prop("max",totallod);

		async function coco(){
			for (var i = 0; i < json_data.length;i++) {
			var pnumberarr=json_data[i];	

			if(loaded_data_pausetime < 85){
			await timer(256);
			GenSelect(pnumberarr);
			loaded_data_pausetime++;
			gentime -= 234;
			}else{
			await timer(4000);
			// alert("pausetime");
			GenSelect(pnumberarr);
			loaded_data_pausetime = 0;
			}
			}
		}
    	
		function timer(ms) { return new Promise(res => setTimeout(res, ms)); }
		var inserted = false;
		async function GenSelect(pnumberarr){
			$.ajax({
				type: "GET",
				url: "{{ route('stole_items_for_scanning') }}",
				data: {
					_token: "{{ csrf_token() }}",
					p_number: pnumberarr,
					room_name: rname,
					room_number: rnum,
					ass_type: asset_type
				},
				success: function(response){
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
						$("#txt_okstat").show();
						$("#warmuptxt").hide();
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
						$("#txt_okstat").show();
						$("#warmuptxt").hide();
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
		}
		    self.window.name = "qr_gen_print";
</script>