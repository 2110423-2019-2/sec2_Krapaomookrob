@extends('layouts.app')

@section('title', 'Admin Panel - Even Die I am The Tutor')

@section('topic', 'Admin logging')

@section('menu')
<a class="btn ownbtn" href="/admin/log/1">Payment</a>
<a class="btn ownbtn" href="/admin/log/2">Report</a>
<a class="btn ownbtn" href="/admin/log/3">Course Cancellation</a>
<a class="btn ownbtn" href="/admin/log/4">Postponement</a>
<a class="btn ownbtn" href="/admin/log/5">User</a>
@endsection

@section('content')
<div class='row'>
    <div class='col-lg-9'>
    @if ($l==1)
    <payment-log-component></payment-log-component>
    @elseif($l==2)
    <verified-report-log-component></verified-report-log-component>
    @elseif($l==3)
    <course-cancel-log-component></course-cancel-log-component>
    @elseif($l==4)
    <postponement-log-component></postponement-log-component>
    @elseif($l==5)
    <user-log-component></user-log-component>
    @endif
    </div>
  </div>
@endsection
