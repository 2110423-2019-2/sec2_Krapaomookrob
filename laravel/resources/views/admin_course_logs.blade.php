@extends('layouts.app')

@section('title', 'Admin Panel - Even Die I am The Tutor')

@section('topic', 'Course Logs')

@section('menu')
<a class="btn ownbtn" href="#">Manage Admin</a>
<a class="btn ownbtn" href="/admin/payment-request">Payment Requests</a>
<a class="btn ownbtn" href="/admin-panel/attendance-logs">Attendance Logs</a>
<a class="btn ownbtn" href="/admin-panel/course-logs">Course Logs</a>
@endsection

@section('content')
  <div class='row'>
    <div class='col-lg-9'>
      <admin-course-logs></admin-course-logs>
    </div>
  </div>
@endsection
