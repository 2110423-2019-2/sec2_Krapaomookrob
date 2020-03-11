
@extends('layouts.app')

@section('title', 'Review Course')

@section('topic', 'Review Course')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="card col-6 p-0">
      <div class="card-header editt-bg m-0 p-0">
        <div class="container justify-content-center py-4">
          <div class="row justify-content-center">
            <img src={{ $tutor -> getImage()}} class ="bg-white rounded-circle mb-3 mt-4" style = "width: 30%">
          </div>
          <div class="row justify-content-center">
            <div class="h4">{{ $tutor -> name }}</div>
          </div>
          <div class="row justify-content-center">
            <div class="font-weight-light">course ID: {{ $course -> id }}</div>
          </div>
          <form action="/report" enctype="multipart/form-data" method="post">
            @csrf
            <h6>Review Message</h6>
            <textarea class="form-control px-5" id="message" type="text" name="message" autofocus></textarea>
            <star-rating-button></star-rating-button>
            <div class="d-flex justify-content-end"><button class="btn btn-light mt-3 ">Rate</button></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
