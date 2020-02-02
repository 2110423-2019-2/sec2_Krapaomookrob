<script src="https://kit.fontawesome.com/544fc5cc4f.js" crossorigin="anonymous"></script>
<style>
    [type=radio] { 
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }
    [type=radio] + i {
        cursor: pointer;
    }
    [type=radio]:checked + i {
        box-shadow: 0px 0px 12px #3498DB;
    }
    i.fas {
        display: inline-block;
        border-radius: 4px;
        box-shadow: 0px 0px 2px #888;
        padding: 0.5em 0.6em;
        width: 300px;
        margin-top: 20px;
        margin-bottom: 20px;
    }
    label {
        text-align: center;
    }
</style>

@extends('layouts.app')

@section('title', 'Usertype - Even Die I am The Tutor')

@section('topic', 'Welcome!!!! Please select your role first.')

@section('menu')
@endsection

@section('content')
    <form class="container" action="/user-role" method="POST">
        @csrf
        <div class="row justify-content-md-center">
            <div class="col text-center">
                <label>
                    <input type="radio" name='role' value="tutor" required>
                    <i class="fas fa-chalkboard-teacher fa-9x"></i>
                    <h2>Tutor</h2>
                </label>
            </div>
            <div class="col text-center">
                <label>
                    <input type="radio" name='role' value="student">
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
