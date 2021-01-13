@extends('master.master')

@section('title')
Inno... - Manage Stations
@endsection

@section('contents')

<h2>Manage Schools</h2>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('dboard') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">User Management</li>
	</ol>
</nav>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Manage Stations</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navitem" aria-controls="navitem" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navitem">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#modal_newst"><i class="fas fa-arrow-right"></i> New Station</a>
      </li>
    </ul>
  </div>
</nav>

<div class="row mt-3">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5>Stations</h5>
        <table class="table-sm table mt-3">
          <thead>
            <tr>
              <th>Station Name</th>
               <th>Station ID</th>
                <th>Actions</th>
            </tr>
          </thead>
          <tbody id="tbl_assloc">
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<form action="add_new_station" method="POST">
  <div class="modal" tabindex="-1" id="modal_newst" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">New Station</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <div class="row">
              {{ csrf_field() }}
          <div class="col-sm-8">
            <label>Station Name</label>
            <input type="text" required="" placeholder="Type name..." class="form-control" name="st_name">
          </div>
          <div class="col-sm-4">
            <label>Station ID</label>
            <input type="text" required="" placeholder="Type name..." class="form-control" name="st_id">
          </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Add Station</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</form>

<form action="del_a_station" method="POST">
  <div class="modal" tabindex="-1" id="modal_delsc" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Remove School</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{ csrf_field() }}
         <input type="hidden" id="inp_sc_id" name="sc_id_todel">
         <p>Are you sure you want to delete this school?</p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Remove</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  </form>


<script type="text/javascript">
  LoadAssetLocations();

  function openremoveschool(control_obj){
    $("#inp_sc_id").val($(control_obj).data("sc_id"));
  }
function LoadAssetLocations(){
    $.ajax({
      type: "POST",
      url: "loadallstation",
      data: {_token:"{{ csrf_token() }}"},
      success: function(data){
        // console.log(data);
        $("#tbl_assloc").html(data);
      }
    })
}
</script>
@endsection