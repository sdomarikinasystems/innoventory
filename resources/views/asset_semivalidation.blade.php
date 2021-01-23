@extends('master.master')

@section('title')
Inno... - Semi-Expendable Upload Result
@endsection

@section('contents')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page"><a href="/innoventory/dashboard">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="/innoventory/asset/registry">Asset Registry</a></li>
    <li class="breadcrumb-item active" aria-current="page">Semi-Expendable - Upload Summary</li>
  </ol>
</nav>


<div class="card-deck mb-3">
  <div class="card">
    <div class="card-body">
      <h6 class="text-muted mt-0 mb-0">Total CSV Assets</h6>
    <h2 class="mt-0 mb-0">{{ $_GET['overallassets'] }}</h2>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
        <h6 class="text-muted mt-0 mb-0">Inserted</h6>
    <h2 class="mt-0 mb-0"> {{ $_GET['insertedassets'] }}</h2>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
       <h6 class="text-muted mt-0 mb-0">Not Inserted</h6>
    <h2 class="mt-0 mb-0">{{ $_GET['notinserted'] }}</h2>
    </div>
  </div>
<div class="card">
    <div class="card-body">
       <h6 class="text-muted mt-0 mb-0">Updated</h6>
    <h2 class="mt-0 mb-0">{{ $_GET['ass_updated'] }}</h2>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
       <h6 class="text-muted mt-0 mb-0">Not Changed</h6>
    <h2 class="mt-0 mb-0">{{ $_GET['exactsame'] }}</h2>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <h6 class="text-muted mt-0 mb-0">Incomplete</h6>
    <h2 class="mt-0 mb-0">{{ $_GET['missingcolumns'] }}</h2>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <h6 class="text-muted mt-0 mb-0">Omitted</h6>
    <h2 class="mt-0 mb-0">{{ $_GET['ass_omitted'] }}</h2>
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
@endsection