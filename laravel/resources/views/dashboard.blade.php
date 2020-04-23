@extends('layouts.app')

@section('title', 'Dashboard - Even Die I am The Tutor')

@section('topic', 'Dashboard')

@php($user = auth() -> user())

@section('menu')
@if($user->isTutor())
  <a class="btn ownbtn" href="/tutor-search">Search Courses</a>
@else
  <a class="btn ownbtn" href="/search-courses">Search Courses</a>
@endif
<a class="btn ownbtn" href="/new-course">New Course Request</a>
@endsection

@section('content')
@if($user->isStudent())
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Manage Requests</h4>
          <course-request></course-request>
      </div>
    </div>
  </div>
</div>
@endif
<div class="row">
  <div class="col-lg-9">
    <attendance-today-component></attendance-today-component>
    <attendance-history-component></attendance-history-component>
  </div>
  <div class="col-lg-3">
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
