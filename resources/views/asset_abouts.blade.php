@extends('master.master')

@section('title')
ProcMS - Innoventory
@endsection

@section('contents')
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">About the System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navitem" aria-controls="navitem" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navitem">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="https://depedmarikina.ph" target="_blank"><i class="fas fa-globe"></i> DepEd Marikina Website</a>
      </li>

    </ul>
  </div>
</nav>

    <div class="card mt-3">
      <div class="card-body">
        <img src="{{ asset('images/icon.png')}}" style="width: 100px;">
        <h5 class="card-title mt-3">ProcMS - Innoventory <small>v.2.1</small><br>2020 - {{ date("Y") }}</h5>
        <h6 class="card-subtitle text-muted">Developed by SDO - Marikina Information and Communication Technology Unit (ICTU)</h6>
      </div>
    </div>
@endsection