@extends('layouts.app')

@section('title', 'Usertype - Even Die I am The Tutor')

@section('topic', 'Welcome to EDITT. Please select your role.')

@section('menu')
@endsection

@section('content')
    <form class="icon-radiobtn" action="/user-role" method="POST">
        @csrf
        <div class="row justify-content-md-center">
            <div class="col text-center">
                <label>
                    <input class=.icselect type="radio" name='role' value="tutor" required>
                    <i class="fas fa-chalkboard-teacher fa-9x"></i>
                    <h2>Tutor</h2>
                </label>
            </div>
            <div class="col text-center">
                <label>
                    <input class=.icselect type="radio" name='role' value="student">
                    <i class="fas fa-user-graduate fa-9x"></i>
                    <h2>Student</h2>
                </label>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <button type="submit" class="btn ownbtn">Confirm</button>
        </div>
    </form>
    
@endsection
