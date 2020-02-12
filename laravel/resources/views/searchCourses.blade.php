@extends('layouts.app')

@section('title', 'Search Courses - Even Die I am The Tutor')

@section('topic', 'Search Courses ')

@section('menu')
<a class="btn ownbtn" href="#">< Back</a>
<a class="btn ownbtn" href="#">New Course Request</a>
@endsection

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body pr-0">
        <h4 class="card-title">Classes Today</h4>
        <div class="d-flex flex-wrap">
          <div class="card p-3 dash mr-3">
              <h5>P'Taan</h5>
              <span>Saturday, 23 Nov 2019</span>
              <span>13:00-15:00 (2hrs)</span>
              <a class="btn ownbtn" href="#">Start Attendance Checking</a>
          </div>
          <div class="card p-3 dash mr-3">
              <h5>P'Taan</h5>
              <span>Saturday, 23 Nov 2019</span>
              <span>13:00-15:00 (2hrs)</span>
              <a class="btn ownbtn" href="#">Start Attendance Checking</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
