<script src="https://kit.fontawesome.com/544fc5cc4f.js" crossorigin="anonymous"></script>
<style>
    #boostrap-override .btn {
    width: 225px;
    padding: 12px;
    border: none;
    border-radius: 4px;
    margin: 5px 0;
    opacity: 0.85;
    display: inline-block;
    font-size: 17px;
    line-height: 20px;
    text-decoration: none;
    }
    #boostrap-override .btn:hover {
    opacity: 1;
    }
    #boostrap-override .fb {
    background-color: #3B5998;
    color: white;
    }

    #boostrap-override i.fab {
    margin-right: 4px;
    }
</style>

@extends('layouts.app')

@section('title', 'Login - Even Die I am The Tutor')

@section('topic', '')

@section('menu')
@endsection

@section('content')
<div id=boostrap-override class="d-flex flex-column align-items-center">
    <div class='m-5'><img src="{{asset('img/logo.png')}}" height="150" alt=""></a></div>
    <a href='/login/facebook' class="fb btn">
        <i class="fab fa-facebook-f fa-sm"></i> Login with Facebook
    </a>
</div>
@endsection
