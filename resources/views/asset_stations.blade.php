@extends('master.master')

@section('title')
Inno... - Stations
@endsection

@section('contents')
<input type="hidden" value="{{ session('user_school') }}" id="myschool_realid" name="">
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Home</li>
		<li class="breadcrumb-item active" aria-current="page">Manage Schools</li>
	</ol>
</nav>

<div class="row">
	<div class="col-sm" style="padding-left:0">
		<ul class="nav">
		<?php
			if(session("user_type") < "4" && session("user_type") != "2"){
		?>
		<!-- FOR SUPPLY OFFICER AND PROPERTY CUSTODIAN ONLY -->
			<li class="nav-item active">
				<a class="nav-link" href="#" data-toggle="modal" data-target="#addnewstatmodal"><i class="fas fa-plus-square"></i> Add School</a>
			</li>
			<?php } ?>

			<?php
				if(session("user_type") == "0" || session("user_type") == "1"){
			?>

			<?php
			}

			?>
		</ul>
	</div>
	<div class="col-sm">
	</div>	
</div>

<div class="row mt-3">
  <div class="col-md-12">
    <table class="table " id="allstadt">
  <thead>
    <tr>
      <th>I.D</th>
      <th>School Name</th>
      <th>Principal</th>
      <th>Property Custodian</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody id="all_stats">
  </tbody>
</table>
  </div>
</div>

<script type="text/javascript">
  $.ajax({
    type : "POST",
    url: "view_all_ass",
    data : {_token: "{{ csrf_token() }}"},
    success: function(data){
      $("#all_stats").html(data);
      $("#allstadt").DataTable();
    }
  })
</script>

<form action="edit_sc_details" method="POST">
  <div class="modal" id="modal_edit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Station</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {{ csrf_field() }}
          <input type="hidden" id="toedit_id" name="st_id">
          <div class="form-group">
            <label>Station I.D</label>
          <input type="text" class="form-control" required="" name="school_id" id="edit_sid">
          </div>
          <div class="form-group">
            <label>Station Name</label>
          <input type="text" class="form-control" required="" name="st_name" id="edit_sn">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</form>

<script type="text/javascript">
  function OpenEditStation(control_obj){
    // school_id
// school_name
   $("#toedit_id").val($(control_obj).data("sid"));
    $("#edit_sid").val($(control_obj).data("school_id"));
     $("#edit_sn").val($(control_obj).data("school_name"));
  }
</script>


<form action="delstation" method="POST">
  <div class="modal" id="modal_delete" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete Station</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this station?</p>
          {{ csrf_field() }}
          <input type="hidden" id="todel_stationid" name="st_id">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Yes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>
      </div>
    </div>
  </div>
</form>

<script type="text/javascript">
  function open_delstation(control_obj){
    $("#todel_stationid").val($(control_obj).data("sid"));
  }
</script>

<form action="addstation_new" method="POST">
  <div class="modal" id="addnewstatmodal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New Station</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ csrf_field() }}
        <div class="form-group">
          <label>Station I.D</label>
          <input type="text" required="" placeholder="Type here..." class="form-control" name="st_id">
        </div>
        <div class="form-group">
          <label>Station Name</label>
          <input type="text" required="" placeholder="Type here..." class="form-control" name="st_name">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add Station</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
</form>


@endsection