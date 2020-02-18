@extends('layouts.app')

@section('title', 'Dashboard - Even Die I am The Tutor')

@section('topic', 'Dashboard')

@section('menu')
<a class="btn ownbtn" href="#">Search Courses</a>
<a class="btn ownbtn" href="#">New Course Request</a>
@endsection

@section('content')
<div class="row">

<form name = 'intercheckout' method="POST" action ="payment" >
        @csrf
        <input name="course_id" type ="hidden" value = "1,2,3">
        <button class ="omise-checkout-button" type="submit" id="checkoutButton"  name="form2" >Pay with internet banking</button>
</div>
@endsection


