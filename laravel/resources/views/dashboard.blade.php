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
<a class="btn ownbtn" href="/new-course">
    @if($user->isTutor())
        Create New Course
    @else
        New Course Request
    @endif
</a>
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
  <div class="col-lg-12">
    <attendance-today-component></attendance-today-component>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <attendance-history-component></attendance-history-component>
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
