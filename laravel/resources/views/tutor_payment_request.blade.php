@extends('layouts.app')

@section('title', 'Payment Request - Even Die I am The Tutor')

@section('topic', 'Payment Request')

@section('menu')
@endsection

@section('content')
    <tutor-payment-request userid={{auth()->user()->id}}></tutor-payment-request>
@endsection
