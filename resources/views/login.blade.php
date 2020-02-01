@extends('layouts.app')

@section('title', 'Login - Even Die I am The Tutor')

@section('topic', '')

@section('menu')
@endsection

@section('content')
<div class="d-flex flex-column align-items-center">
    <div class='m-5'><img src="{{asset('img/logo.png')}}" height="150" alt=""></a></div>
    <a href="/login/facebook"><div class="fb-login-button" data-width="" data-size="large" data-button-type="login_with" data-auto-logout-link="false" data-use-continue-as="true"></div></a>  
</div>
@endsection

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v5.0&appId=575154483212413&autoLogAppEvents=1"></script>
