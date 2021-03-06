@extends('master.master')

@section('title')
Innoventory - Abouts
@endsection

@section('contents')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item " aria-current="page"><a href="{{ route('dboard') }}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">About the System</li>
  </ol>
</nav>

<div class="container">
<center>
<div class="card card-shadow" style="max-width: 380px; margin: auto; margin-top: 20vh;">
<div class="card-body">

<img src="{{ asset('images/icon.png')}}" class="card-shadow" style="width: 100px; border-radius: 30px;">
<h5 class="card-title mt-3">Innoventory <small>v.2.31</small><br>2020 - {{ date("Y") }}</h5>
<h6 class="card-subtitle text-muted mt-3">Developed by SDO - Marikina Information and Communication Technology Unit (ICTU)</h6>
</div>
</div>
</center>
</div>

@endsection