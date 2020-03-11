@extends('layouts.app')

@section('title', 'Admin Panel - Even Die I am The Tutor')

@section('topic', 'Report Message List')

{{-- @section('menu') --}}
{{-- <a class="btn ownbtn" href="#">Manage Admin</a>
<a class="btn ownbtn" href="#">For etc</a> --}}
{{-- @endsection --}}

@section('content')
<div class="row">
  <div class="col-lg-9">
    <div class="card">
        <report-list></report-list>
    </div>
  </div>
</div>
@endsection
