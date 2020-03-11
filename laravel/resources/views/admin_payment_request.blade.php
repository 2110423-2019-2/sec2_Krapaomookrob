@extends('layouts.app')

@section('title', 'Admin Panel - Even Die I am The Tutor')

@section('topic', 'Admin Payment Requests')

@section('menu')
@endsection

@section('content')
  <div class='row'>
    <div class='col-lg-9'>
      <admin-payment-request></admin-payment-request>
    </div>
  </div>
@endsection
