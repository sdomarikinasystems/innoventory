@extends('master.master')

@section('title')
Inno... - Transaction History
@endsection

@section('contents')
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('dboard') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Transactions History</li>
	</ol>
</nav>

<div class="row mt-3">
	<div class="col-sm-7">
		<table class="table table-borderless table-hover" id="tbl_tra">
			<thead>
				<tr>
					<th>Date/Time</th>
					<th>Action Taken</th>
					<th>User</th>
				</tr>
			</thead>
			<tbody id="alltranstbl">

			</tbody>
		</table>
	</div>
  <div class="col-sm-5">
    <div class="card card-shadow">
      <div class="card-body">
        <table class="table table-borderless table-hover">
         <thead>
           <tr>
             <th><i class="fas fa-tags"></i> Action Tags</th>
             <th>Action</th>
           </tr>
         </thead>
         <tbody>
            <tr>
            <td>a01</td>
            <td>Imported Asset(CO)</td>
          </tr>
          <tr>
            <td>a01.1</td>
            <td>Imported Asset(SE)</td>
          </tr>
          <tr>
            <td>a01.2</td>
            <td>Imported Asset(SU)</td>
          </tr>

          <tr>
            <td>a02</td>
            <td>Generated Report Appendix 73</td>
          </tr>
          <tr>
            <td>a02.1</td>
            <td>Generated Report Appendix 66</td>
          </tr>
          <tr>
            <td>a03</td>
            <td>Disposed an asset CO</td>
          </tr>
           <tr>
            <td>a04</td>
            <td>Created new account</td>
          </tr>
          <tr>
            <td>a05</td>
            <td>Deleted an Account</td>
          </tr>
          <tr>
            <td>a06</td>
            <td>Edited an Account Info</td>
          </tr>
          <tr>
            <td>a07</td>
            <td>Restored an Asset CO</td>
          </tr>
         </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $.ajax({
    type: "GET",
    url: "{{ route('get_trhisto') }}",
    data: {_token:"{{ csrf_token() }}"},
    success: function(data){
      $("#alltranstbl").html(data);
      $("#tbl_tra").DataTable();
    }
  })
  var showed = false;
  $("#btn_myactlogs").click(function(){
    if(!showed){
      $("#c1").removeClass("col-sm-12");
       $("#c1").addClass("col-sm-9");
       $("#c2").css("display","block");
       showed = true;
       $("#btn_myactlogs").html('<i class="fas fa-tags"></i> Hide Action Tags');
    }else{
$("#c1").removeClass("col-sm-9");
       $("#c1").addClass("col-sm-12");
       $("#c2").css("display","none");
      showed = false;
       $("#btn_myactlogs").html('<i class="fas fa-tags"></i> Show Action Tags');
    }
  })
</script>
@endsection