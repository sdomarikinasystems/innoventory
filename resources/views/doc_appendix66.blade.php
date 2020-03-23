	<script type="text/javascript" src="{{ asset('api/html2canvas/html2canvas.js') }}"></script>
	<script type="text/javascript" src="{{ asset('api/html2canvas/html2canvas.min.js') }}"></script>

	



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
<div id="nodeToRenderAsPDF" style="padding-top: 20px; padding-bottom: 20px; padding-left: 40px; padding-right: 40px; width: 1040px;">

<script type="text/javascript" src="{{asset('apicore/jquery-3.3.1.min.js') }}"></script>

<div id="mytbl">
	
</div>



</div>

<script type="text/javascript">
	var mypagecountx = 0;
	// get_ass_pdf_pagecount
		$.ajax({
		type: "POST",
		url: "get_ass_pdf_pagecount",
		data: {_token: "{{ csrf_token() }}", rn:<?php echo json_encode($_GET["roomnum"]); ?>,cat:<?php echo json_encode($_GET["assetactegory"]); ?>},
		success: function(data){
			data = parseInt(data);
			mypagecountx = parseInt(data + 1);
			// alert(mypagecountx);
			LoadAssetDataReport();

		}
	})


	

	function LoadAssetDataReport(){
		$.ajax({
		type: "POST",
		url: "gen_ass_rep_printout",
		data: {_token: "{{ csrf_token() }}", rn:<?php echo json_encode($_GET["roomnum"]); ?>,cat:<?php echo json_encode($_GET["assetactegory"]); ?>},
		success: function(data){

			$("#mytbl").append(data);
	
			print_now();

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

		// html2canvas(document.querySelector('#nodeToRenderAsPDF'), 
		// 						{scale: quality}
		// 				 ).then(canvas => {
		// 	let pdf = new jsPDF('l', 'mm', 'a4');
		// 	pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 0, 0);
		// 	pdf.save(filename);
		// });
	}

</script>
	<script src="{{ asset('api/js/jspdf.js') }}"></script>
	<script src="{{ asset('api/js/jquery-2.1.3.js') }}"></script>
	<script src="{{ asset('api/js/pdfFromHTML.js') }}"></script>
