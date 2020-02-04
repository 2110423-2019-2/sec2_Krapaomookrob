@extends('layouts.app')

@section('title', 'Login - Even Die I am The Tutor')

@section('topic', '')

@section('menu')
@endsection

@section('content')
<div class="d-flex flex-column align-items-center">
    <div class='m-5'><img src="{{asset('img/logo.png')}}" height="150" alt=""></div>
    <a href='/login/facebook' class="fbbtn">
        <i class="fab fa-facebook-f fa-sm mr-1"></i> Login with Facebook
    </a>
</div>
@endsection
