@extends('master.master')

@section('title')
ProcMS - Innoventory
@endsection

@section('contents')

<h2>Reminders</h2>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page"><a href="/innoventory/dashboard">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Reminders</li>
	</ol>
</nav>

<div class="row">
	<div class="col-sm mb-3">
		<a class="btn btn-success" href="#" data-toggle="modal" data-target="#addnewremondermodal"><i class="fas fa-bell"></i> Add Reminder</a>
	</div>
	<div class="col-sm">
	</div>
</div>

<div class="row">
	<div class="col-sm">
		<table class="table table-sm table-bordered" id="tblmytbl">
		  <thead>
			<tr>
			  <th scope="col" width="200">Title</th>
			  <th scope="col" width="250">Description</th>
			  <th scope="col" width="100">Deadline</th>
			  <th scope="col" width="100">Date/Time Added</th>
			</tr>
		  </thead>
		  <tbody id="reminderstbl">
			
		  </tbody>
		</table>
	</div>
</div>

<form action="{{ route('addnewreminder') }}" method="POST">
	{{csrf_field()}}
	<div class="modal" tabindex="-1" id="addnewremondermodal" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title"><i class="fas fa-bell"></i> New Reminder</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	       <div class="row">
	       	<div class="col-sm-6">
	       	<div class="form-group">
	       	<label>Title</label>
	       	<input type="text" class="form-control form-control-sm" placeholder="Add title here..." required="" name="remindertitle">
	       </div>
	       	</div>
	       	<div class="col-sm-6">
	       	<div class="form-group">
	       	<label>Deadline <span class="text-muted">Ignore if n/a</span></label>
	       	<input type="date" class="form-control form-control-sm" name="reminderdeadline">
	       </div>
	       	</div>
	       	<div class="col-sm-12">
	       		<div class="form-group">
	       	<label>Description</label>
	       	<textarea class="form-control" maxlength="200" placeholder="Add text here..." required="" rows="5" name="reminderdescription"></textarea>
	       </div>
	       	</div>
	       	<div class="col-sm-6">
	       		<div class="form-group">
	       			<select class="form-control form-control-sm" name="remindwhocansee" required="">
	       				<option selected="" disabled="" value="">Who can see this?</option>
	       				<option value="all">All</option>
	       				<option value="0">Admin</option>
	       				<option value="1">Property Supply Officer</option>
	       				<option value="2">Principals</option>
	       				<option value="3">Property Custodians</option>
       					<option value="4">Center Managers</option>
	       			</select>
	       		</div>
	       	</div>
	       </div>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-primary"><i class="fas fa-bell"></i> Post Reminder</button>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>

<form action="{{ route('deletethisreminder')}}" method="POST">
	<div class="modal" tabindex="-1" role="dialog" id="modal_delete">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title"><i class="far fa-trash-alt"></i> Delete Reminder</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	{{csrf_field() }}
	      	<input type="hidden" id="remid" name="reminderidx">
	        <p>Are you sure that you want to delete this reminder?</p>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i> Yes</button>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>

<script type="text/javascript">
	LoadRemindersPage();
 	function LoadRemindersPage(){
 		$.ajax({
 			type: "POST",
 			url: "{{ route('getremindersbyorigin') }}",
 			data: {_token: "{{ csrf_token() }}"},
 			success : function(data){
 				// alert(data);
 				$("#reminderstbl").html(data);
 				$("#tblmytbl").DataTable();

 			}
 		})
 	}
 	function opendeletereminder(cobj){
 		$("#remid").val($(cobj).data("oid"));
 	}

</script>

@endsection