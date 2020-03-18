@extends('layouts.app')

@section('title', 'Search Courses - Even Die I am The Tutor')
@section('topic','Search Courses')
@section('menu')
<a href="{{url('/new-course')}}" class='btn ownbtn'>Create New Course</a>
@endsection
@section('content')

<tutor-search-course-component></tutor-search-course-component>

@endsection
