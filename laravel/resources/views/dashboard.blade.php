@extends('layouts.app')

@section('title', 'Dashboard - Even Die I am The Tutor')

@section('topic', 'Dashboard')

@section('menu')
<a class="btn ownbtn" href="/search-courses">Search Courses</a>
<a class="btn ownbtn" href="/new-course">New Course Request</a>
@endsection

@section('content')
<div class="row">
  <div class="col-lg-9">
    <div class="card">
      <div class="card-body pr-0">
        <h4 class="card-title">Classes Today</h4>
        <div class="d-flex flex-wrap">
          <div class="card p-3 dash mr-3">
              <h5>P'Taan</h5>
              <span class="d-block">Saturday, 23 Nov 2019</span>
              <span class="d-block">13:00-15:00 (2hrs)</span>
              <a class="btn ownbtn" href="#">Start Attendance Checking</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="card">
      <div class="card-header">New Messages</div>
      <div class="card-body px-0 py-0">
        <div class="border-bottom px-3 pt-3 position-relative">
          <h6>P'Taan</h6>
          <div class="ellipsis"><small>Hi my son. Hi my son. Hi my son. Hi my son. Hi my son. Hi my son.</small></div>
          <a href="#" class="stretched-link"></a>
        </div>
        <div class="border-bottom px-3 pt-3 position-relative">
          <h6>P'Taan</h6>
          <div class="ellipsis"><small>Hi my son. Hi my son. Hi my son. Hi my son. Hi my son. Hi my son.</small></div>
          <a href="#" class="stretched-link"></a>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header">Tutor Requests</div>
      <div class="card-body px-0 py-0">
        <div class="p-3"><small>There are currently no tutor requests, pleases check back later.</small></div>
      </div>
    </div>
  </div>
</div>
@endsection

@if (isset($alert))
    <div class="alert alert-success alert-dismissible fade show">
    {{ $alert }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif

@if (isset($error))
    <div class="alert alert-warning alert-dismissible fade show">
    {{ $error }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif
