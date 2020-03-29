@extends('layouts.app')

@section('title', 'Search Courses - Even Die I am The Tutor')
@section('topic','Search Courses')
@section('menu')
<a class="btn" style="color: #000 !important; background-color: #ffffff; border: solid 1px rgba(200,200,200, 0.6)" href="javascript:history.back()">< Back</a>
<a href="{{url('/new-course')}}" class='btn ownbtn'>Create New Course</a>
@endsection
@section('content')

<tutor-search-course-component></tutor-search-course-component>

@endsection
