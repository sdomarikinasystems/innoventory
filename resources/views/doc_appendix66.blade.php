<!DOCTYPE html>
<html>
<head>
	<link rel='icon' href='{{ asset("images/sdo.ico") }}' type='image/x-icon'/ >
	<title>Appendix 66 - Semi-Expendable Printing</title>
	<script type="text/javascript" src="{{ asset('api/html2canvas/html2canvas.js') }}"></script>
	<script type="text/javascript" src="{{ asset('api/html2canvas/html2canvas.min.js') }}"></script>
	<script src="{{ asset('api/js/jspdf.js') }}"></script>
	<script src="{{ asset('api/js/jquery-2.1.3.js') }}"></script>
	<script src="{{ asset('api/js/pdfFromHTML.js') }}"></script>
	<style type="text/css">
	table {
  border-collapse: collapse;
  width: 100%;
}

table, th, td {
  border: 1px solid black;
  font-size: 13px;
}
table .borderless th{
	border: 1px solid transparent !important;
	border-bottom: 1px solid black !important;
	border: none;
}
table{
	border: none;
}
.bottom_field td{
	padding: 10px;
	padding-left: 1px;
	padding-right: 1px;
	 vertical-align: baseline;
	border-right: 1px solid transparent !important;
	border-bottom: 1px solid black !important;
	border: none;
}

.bottom_field .laster{
	border-right: 1px solid black !important;
	border: none;
}
.bottom_field .fronter{
	border-left: 1px solid black !important;
	border: none;
}
</style>
</head>
<body>

<div id="nodeToRenderAsPDF" style="padding-top: 20px; padding-bottom: 20px; padding-left: 40px; padding-right: 40px; width: 1040px;">

<script type="text/javascript" src="{{asset('apicore/jquery-3.3.1.min.js') }}"></script>
<div id="mytbl">
</div>

</div>

<script type="text/javascript">
	
var invyear = <?php echo json_encode($_GET["inv_year"]); ?>;
var invmonth = <?php echo json_encode($_GET["inv_month"]); ?>;

var mypagecountx = 0;

var original_ID_room = <?php echo json_encode($_GET["my_room"]); ?>;

var tru_roomId= "";
var tru_roomname= "";

GetRoomInfo();
function GetRoomInfo(){
	$.ajax({
		type:"GET",
		url: "{{ route('stole_single_service_center_data_byid') }}",
		data: {_token: "{{ csrf_token() }}",
		service_center_id: original_ID_room},
		success: function(data){
			// alert(data);
			data = JSON.parse(data);
			tru_roomId = data[0]["station_id"];
			tru_roomname = data[0]["office"];
			StartGennerationofAppendix66();
		}
	})
}

function StartGennerationofAppendix66(){
	$.ajax({
		type: "POST",
		url: "{{ route('stole_semi_pagecount') }}",
		data: {_token: "{{ csrf_token() }}",
		lc_id:original_ID_room,
		inv_year: invyear,
		inv_month: invmonth
		},
		success: function(data){
			data = parseInt(data);
			mypagecountx = parseInt(data + 1);
			LoadAssetDataReport();
		}
	})
}

	function LoadAssetDataReport(){
		$.ajax({
		type: "POST",
		url: "{{ route('stole_generate_se_app66_data') }}",
		data: {_token: "{{ csrf_token() }}",
				locationid: original_ID_room,
				roomname: tru_roomname,
				inv_year: invyear,
				inv_month: invmonth},
		success: function(data){
			// alert(data);
			$("#mytbl").append(data);
			// print_now();
		}
	})
	}
	function print_now(quality = 1) {
		const filename  = 'xxx.pdf';
var i=0;
gen_code();
let pdf = new jsPDF('l', 'mm', 'a4');
function gen_code(){
	setTimeout(function(){
	if(i  != mypagecountx){
		gen_code();
	}else{
		pdf.save(filename);
	}
	
	console.log("page - " + i);

html2canvas(document.querySelector("#page_" + i), 
						{scale: quality}
				 ).then(canvas => {
	
	pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 11, 13);
	 if(i != (mypagecountx -1)){
	 	pdf.addPage();
	 }
i++;
});
	
	},300)
}
	}

</script>
	



</body>
</html>