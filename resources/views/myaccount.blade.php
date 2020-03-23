@extends('master.master')

@section('title')
ProcMS - Innoventory
@endsection

@section('contents')
<h2>My Account</h2>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('dboard') }}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Reports</li>
    <li class="breadcrumb-item active" aria-current="page">Omitted Assets</li>
  </ol>
</nav>


<div class="row mt-3">
  <div class="col-sm-12">
    <table class="table table-bordered table-striped">
      <tr>
        <td>
          <div class="mt-2 mb-2" style="display: block; background-color: #dfe4ea; width: 256px; height: 256px; border-radius: 20px;">
            
          </div>
          <h5 class="card-title"><i class="far fa-user-circle"></i> Profile Picture</h5>
          <h6 class="card-subtitle text-muted mb-3">Change your account's security password</h6>
          <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#changepro">Change Profile Picture</button>
        </td>

      </tr>
      <tr>
        <td>
          <h5 class="card-title"><i class="fas fa-key"></i> Change Password</h5>
          <h6 class="card-subtitle text-muted mb-3">Change your account's security password</h6>
          <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#m_cp">Change Password</button>
        </td>

      </tr>
      <tr>
         <td>
          <h5 class="card-title"><i class="fas fa-portrait"></i> Change Account Name</h5>
          <h6 class="card-subtitle text-muted mb-3">Change the name of your Innoventory Account</h6>
          <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#m_cn">Edit Account Name</button>
        </td>
      </tr>

    </table>
  </div>
</div>

<form>
  <div class="modal" tabindex="-1" role="dialog" id="changepro">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Change Profile Picture</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Wa're still working on this feature</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</form>

<form action="{{ route('passchange') }}" method="POST">
  <div class="modal" tabindex="-1" id="m_cp" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Change Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{ csrf_field() }}
         <div class="form-group">
           <label>Type your current password here</label>
           <input class="form-control" type="password" required="" placeholder="Type here..." name="olpas">
         </div>
         <div class="row">
           <div class="col-sm-6">
                 <div class="form-group">
           <label>New Password</label>
           <input class="form-control" type="password" minlength="8" required="" placeholder="Type here..." name="newpas">
         </div>
           </div>
           <div class="col-sm-6"> 
            <div class="form-group">
           <label>Re-type New Password</label>
           <input class="form-control" type="password" minlength="8" required="" placeholder="Type here..." name="renewpas">
         </div>
           </div>
         </div>
              
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Change Password</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</form>

<form action="../../cha_acname" method="POST">
  <div class="modal" tabindex="-1" id="m_cn" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Account Name</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <center>Feature unavailable in development stage.</center>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection