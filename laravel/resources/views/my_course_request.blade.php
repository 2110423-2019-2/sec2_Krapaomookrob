@extends('layouts.app')

@section('title', 'Manage Course Request')

@section('topic', 'Course Requests')

@section('menu')
<a href="#" class="btn ownbtn px-5">Back</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <course-request></course-request>
    </div>
</div>
@endsection