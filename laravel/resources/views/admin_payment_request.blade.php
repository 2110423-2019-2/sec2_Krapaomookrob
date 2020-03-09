@extends('layouts.app')

@section('title', 'Admin Panel - Even Die I am The Tutor')

@section('topic', 'Admin Payment Requests')

@section('menu')
@endsection

@section('content')
  <div class='row'>
    <div class='col-lg-9'>
        <form name = 'transfer' method="POST" action ="/transfer" target="_blank">
        @csrf
            <input name="paymentReqID" type ="hidden" value = "1">
            <button class ="omise-checkout-button" type="submit">transfer </button>
        </form>
        <form name = 'transfer' method="POST" action ="/checktransfer" >
        @csrf
            <button class ="omise-checkout-button" type="submit">check </button>
        </form>
      <admin-payment-request></admin-payment-request>
    </div>
  </div>
@endsection

@if (isset($error))
    <div class="alert alert-warning alert-dismissible fade show">
    {{ $error }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif
