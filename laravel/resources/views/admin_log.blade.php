@extends('layouts.app')

@section('title', 'Admin Panel - Even Die I am The Tutor')

@section('topic', 'Admin logging')

@section('menu')
<a class="btn ownbtn" href="/admin-panel/">Manage Admin</a>
<a class="btn ownbtn" href="/admin/log/1">Payment logs</a>
<a class="btn ownbtn" href="/admin/log/2">Report logs</a>
<a class="btn ownbtn" href="/admin/log/3">Course logs</a>
<a class="btn ownbtn" href="/admin/log/4">Postponement logs</a>
<a class="btn ownbtn" href="/admin/log/5">User logs</a>
<a class="btn ownbtn" href="/admin/log/6">Attendance logs</a>
@endsection

@section('content')
<div class='row'>
    <div class='col-lg-9'>
    @if ($l==1)
    <payment-log-component></payment-log-component>
    @elseif($l==2)
    <verified-report-log-component></verified-report-log-component>
    @elseif($l==3)
    <admin-course-logs></admin-course-logs>
    @elseif($l==4)
    <postponement-log-component></postponement-log-component>
    @elseif($l==5)
    <user-log-component></user-log-component>
    @elseif($l==6)
    <admin-attendance-logs></admin-attendance-logs>
    @else
    <br>
    <h1>Page 404 NOT FOUND</h1>
    @endif
    </div>
  </div>
@endsection
