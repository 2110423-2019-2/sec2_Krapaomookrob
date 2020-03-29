@extends('layouts.app')

@section('title', 'Admin Panel - Even Die I am The Tutor')

@section('topic', 'Admin logging')

@section('menu')
<a class="btn ownbtn" href="/admin/log/1">Payment Logging</a>
<a class="btn ownbtn" href="/admin/log/2">Report Logging</a>
@endsection

@section('content')
<div class='row'>
    <div class='col-lg-9'>
    @if ($l==1)
    <payment-log-component></payment-log-component>
    @elseif($l==2)
    <verified-report-log-component></verified-report-log-component>
    @endif
    </div>
  </div>
@endsection
