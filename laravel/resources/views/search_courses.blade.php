@extends('layouts.app')

@section('title', 'Search Courses - Even Die I am The Tutor')

@section('topic', 'Search Courses ')

@section('menu')
<a class="btn" style="color: #000 !important; background-color: #ffffff; border: solid 1px rgba(200,200,200, 0.6)" href="javascript:history.back()">< Back</a>
<a class="btn ownbtn" href="new-course">New Course Request</a>
@endsection

@section('content')
<search-course-component></search-course-component>
@endsection
