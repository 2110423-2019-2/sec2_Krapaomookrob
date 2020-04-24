@extends('layouts.app')

@section('title', 'Admin Panel - Even Die I am The Tutor')

@section('topic', 'Suspend User Panel')

@section('menu')
<a class="btn ownbtn" href="/admin-panel/">Manage Admin</a>
<a class="btn ownbtn" href="/admin-panel/suspend">Suspend User</a>
<a class="btn ownbtn" href="/admin-panel/reportList">Report List</a>
<a class="btn ownbtn" href="/admin/payment-request">Payment Requests</a>
<a class="btn ownbtn" href="/admin/log/1">Logging System</a>
<a class="btn ownbtn" href="/admin/refund-request">Refund Requests</a>
@endsection

@section('content')
<div class="row">
  <div class="col-lg-9">
    <div class="card">
      <suspended-user-component></suspended-user-component>
    </div>
  </div>
</div>
@endsection
