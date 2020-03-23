@extends('master.master')

@section('title')
ProcMS - Innoventory
@endsection

@section('contents')
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Asset Registry</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navitem" aria-controls="navitem" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navitem">
    <ul class="navbar-nav mr-auto">
<!--       <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#modal_newaccount"><i class="fas fa-arrow-right"></i> Encode New Asset</a>

      </li> -->
      <li class="nav-item active">
 <a class="nav-link" href="#" data-toggle="modal" data-target="#uploadnewcsv"><i class="fas fa-arrow-right"></i> Import Asset Package</a>
  </li>

   <li class="nav-item active">
 <a class="nav-link" href="#" data-toggle="modal" data-target="#m_generatereport"><i class="fas fa-arrow-right"></i> Generate Report</a>
  </li>
    </ul>
  </div>
</nav>
<div class="row mt-4">
  <div class="col-md-6">
<div class="card">
  <div class="card-body">
          <small class="float-right text-muted" style="text-align: right;">Last Import : <span id="dtup">Weeks Ago</span><br><span id="uploderx">By Virmil Talattad</span></small>
        <h5 class="card-title mb-3">Last Import</h5>
          <div class="row mt-2">
            <div class="col-md-12">
              <table class="table mt-3 table-sm table-bordered">
                <tbody>
                  <tr>
                    <td>
                      <small class="text-muted">Total CSV Assets</small>
    <h5 id="tca">0</h5>

                    </td>
                    <td>
                       <small class="text-muted">Inserted</small>
    <h5 id="ins">0</h5>

                    </td>
                    <td>
                       <small class="text-muted">Updated</small>
    <h5 id="upd">0</h5>

                    </td>
                    <td>
                       <small class="text-muted">Incomplete</small>
    <h5 id="inc">0</h5>

                    </td>
                    <td>
                      <small class="text-muted">Not Inserted</small>
    <h5 id="notins">0</h5>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
  <div class="col-md-12">
  <span class="badge badge-danger float-left">Not Ready for Inventory</span>
   <small><a href="#" class="float-right"><i class="fas fa-history"></i> Import History</a></small>
  </div>
</div>
  </div>
</div>
  </div>
  <div class="col-md-6">
    <div class="card">
      <div class="card-body">
        <h5>Further Validation</h5>
        <small>
          <div class="row mt-3">
          <div class="col-md-3">
            <span><i class="fas fa-circle" style="color: #e74c3c;"></i> Incomplete</span>
          </div>
          <div class="col-md-3">
             <span><i class="fas fa-circle" style="color: #f1c40f;"></i> Invalid Date</span>
          </div>
          <div class="col-md-3">
             <span><i class="fas fa-circle" style="color: #9b59b6;"></i> Location Mismatch</span>
          </div>
        </div>
        </small>
      </div>
    </div>
  </div>
</div>

<table class="mt-3 table table-sm">
  <thead>
    <tr>
      <th scope="col">Property Number</th>
      <th scope="col">Asset Item</th>
      <th scope="col">Asset Classification</th>
      <th scope="col">Current Condition</th>
      <th scope="col">Asset Location</th>
      <th scope="col">Room</th>
      <th scope="col">Issue</th>
    </tr>
  </thead>
  <tbody id="allmyassests">
  </tbody>
</table>


<script type="text/javascript">
  

  function LoadFurtherValidation(){
    $.ajax({
      type: "POST",
      url : "lod_furth_val",
      data: {_token:"{{ csrf_token() }}"},
      success: function(data){
        console.log(data);
      }
    })
  }
</script>



@endsection