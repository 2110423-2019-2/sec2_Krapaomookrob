@extends('layouts.app')

@section('title', 'Advertisement')

@section('topic', 'Create Advertisement')

@section('menu')
@endsection

@section('content')
    <div class="card pb-2">
        <div class="card-body mx-3 px-5">
            <h3 class="card-title mt-3" >Let's us help promoting your courses</h3>
            <p class="font-weight-light" style="font-size: 1.05rem">
                Start now by choosing your course that you want to promote and let us help it get more attention from students.  
            </p>
            <br>
            <div>
                <h4 style="color: #55B3E0"><strong>How it works</strong></h4>
                <p>
                    The promoted course will be list first on the search result page when student are looking for some course to register.
                </p>
            </div>
            <courses-card class="mx- px-0"></courses-card>

        </div>
    </div>
@endsection