@extends('layouts.app')

@section('title', 'Advertisement')

@section('topic', 'Create Advertisement')

@section('menu')
<a href="#" class="btn ownbtn px-5">Back</a>
@endsection

@section('content')
    <div class="card pb-2">
        <div class="card-body">
            <h3 class="card-title">Let's us help promoting your courses</h3>
            <p>
                Start now by choosing your course that you want to promote.   
            </p>
            <p>
                The promoted course will be list first on the search result page when student are looking for some course to register.
            </p>

            <courses-card></courses-card>

        </div>
    </div>
@endsection