@extends('master.master')

@section('title')
Inno... - Supply Upload Result
@endsection

@section('contents')

<h2><i class="fas fa-parachute-box"></i> <span >Supply - Upload Summary</h2>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page"><a href="/innoventory/dashboard">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="/innoventory/asset/registry">Asset Registry</a></li>
    <li class="breadcrumb-item active" aria-current="page">Upload Summary</li>
  </ol>
</nav>


<div class="card-deck mb-3">
  <div class="card">
    <div class="card-body">
      <h6 class="text-muted">Total CSV Assets</h6>
    <h2>{{ $_GET['overallassets'] }}</h2>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
        <h6 class="text-muted">Inserted</h6>
    <h2>{{ $_GET['insertedassets'] }}</h2>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
       <h6 class="text-muted">Not Inserted</h6>
    <h2>{{ $_GET['notinserted'] }}</h2>
    </div>
  </div>
<div class="card">
    <div class="card-body">
       <h6 class="text-muted">Updated</h6>
    <h2>{{ $_GET['ass_updated'] }}</h2>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
       <h6 class="text-muted">Not Changed</h6>
    <h2>{{ $_GET['exactsame'] }}</h2>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <h6 class="text-muted">Incomplete</h6>
    <h2>{{ $_GET['missingcolumns'] }}</h2>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <h6 class="text-muted">Omitted</h6>
    <h2>{{ $_GET['ass_omitted'] }}</h2>
    </div>
  </div>
</div>
<div class="row">
   <div class="col-sm-12 mb-4">

     <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-exclamation-triangle"></i> Discrepancies</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fas fa-search-minus"></i> Omitted</a>
      </li>

    </ul>
    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
<table class="table table-sm table-bordered table-striped " id="tbl_allregups">
          <thead>
            <tr>
              <th>Row #</th>
              <th>Article</th>
              <th>Description</th>
              <th>Stock Number</th>
              <th>Unit of Measure</th>
              <th>Unit Value</th>
              <th>Balance Per Card</th>
              <th>Issue</th>
            </tr>
          </thead>
          <tbody>
            <?php
             echo $_GET["ass_withdesc"]; 
             ?>
          </tbody>
        </table>
      </div>
      <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
<table class="table table-sm table-bordered table-striped " id="tbl_allomitt">
          <thead>
            <tr>
              <th>No #</th>
              <th>Article</th>
              <th>Description</th>
              <th>Stock Number</th>
              <th>Unit of Measure</th>
              <th>Unit Value</th>
              <th>Balance Per Card</th>
              <th>On Hand Per Count</th>
              <th>Remarks</th>
            </tr>
          </thead>
          <tbody>
            <?php
             echo $_GET["ass_nofount"]; 
             ?>
          </tbody>
        </table>
      </div>

    </div>

  </div>       
</div>

<form action="{{ route('importallfoundservicecenters') }}" method="POST">
    {{ csrf_field() }}
    <div class="modal" tabindex="-1" id="modal_newservice_centers" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">New Service Center(s) Found</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <table class="table table-sm table-striped" id="todtnow">
          <thead>
            <tr>
              <th>Service Centers</th>
              <th>Room #</th>
              <th>Items</th>
            </tr>
          </thead>
          <tbody id="tbl_neesercen">
            
          </tbody>
         </table>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success"><i class="fas fa-warehouse"></i> Import All New Service Centers</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Do nothing</button>
        </div>
      </div>
    </div>
  </div>
</form>



@endsection