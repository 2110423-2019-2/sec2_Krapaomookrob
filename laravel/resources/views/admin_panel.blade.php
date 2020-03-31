@extends('layouts.app')

@section('title', 'Admin Panel - Even Die I am The Tutor')

@section('topic', 'Admin Panel')

@section('menu')
<a class="btn ownbtn" href="#">Manage Admin</a>
<a class="btn ownbtn" href="/admin/payment-request">Payment Requests</a>
<a class="btn ownbtn" href="/admin/log/1">Logging System</a>
@endsection

@section('content')
<div class="row">
  <div class="col-lg-9">
    <div class="card">
      <div class="card-body pr-0">
        <h4 class="card-title">Hello, Tee</h4>
        <admin_panel-component></admin_panel-component>
      </div>
    </div>
  </div>
</div>
@endsection
