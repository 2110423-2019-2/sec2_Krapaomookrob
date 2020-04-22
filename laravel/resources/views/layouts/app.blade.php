<!DOCTYPE html>
<html lang="th">
    <head>
        <meta charset="UTF-8">
        <title>@yield('title')</title>
        <meta name="keywords" content="@yield('keywords')">
        <meta name="description" content="@yield('description')">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{asset('img/favicon.png')}}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="{{mix('css/app.css')}}" rel="stylesheet">
        @yield('head')
    </head>

    <body>
      <v-app class="main-body" id="app">
        <header id="header">
          <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light px-0">
              {{-- add link to home, for convenience --}}
              <a class="navbar-brand" href="/"><img src="{{asset('img/logo.png')}}" height="50" alt=""></a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <span class="navbar-text mr-auto"></span>
                <ul class="navbar-nav">
                  @php($user = auth()->user())
                  {{-- Navbar for user --}}
                  @if(!empty($user))
                    @if($user->isTutor())
                      <li class="nav-item">
                        <a class="btn ownbtn" href="/tutor/payment-request">Request Payment</a>
                      </li>
                    @endif
                    <li class="nav-item active">
                      <a class="btn btn-light btn-nav" href="/">Dashboard</a>
                    </li>
                    @if($user->isTutor() || $user->isStudent())
                      <li class="nav-item">
                        <a class="btn btn-light btn-nav" href="/my-courses">My Courses</a>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="btn btn-light btn-nav" href="/my-calendar">My Calendar</a>
                      </li>
                    @endif
                    <li class="nav-item">
                      <a class="btn btn-light btn-nav" href="/chat">Messages</a>
                    </li>
                    <li class="nav-item">
                      <a class="btn btn-light btn-nav" href="/profile">My Account</a>
                    </li>
                    @if($user->isStudent() || $user->isTutor())
                      <li class="nav-item">
                        <notification-bar></notification-bar>
                      </li>
                    @endif
                    @if($user->isStudent())
                      <li class="nav-item">
                        <a class="btn ownbtn" href="/cart">🛒 Cart</a>
                      </li>
                    @endif
                    @if($user->isAdmin() || $user->isSuperuser())
                    <li class="nav-item">
                      <a class="btn btn-light btn-nav" href="/admin-panel">Admin Panel</a>
                    </li>
                    @endif
                    <li class="nav-item">
                      <a class="btn btn-light btn-nav" href="/logout">Logout</a>
                    </li>
                  {{-- Navbar for guest --}}
                  @else
                    <li class="nav-item">
                        <a class="btn btn-light" href="/login">Login</a>
                    </li>
                  @endif
                </ul>
              </div>
            </nav>
          </div>
      </header>

        <div class="container">
          <div class="d-flex justify-content-between mt-4">
            <h1>@yield('topic')</h1>
            <div>@yield('menu')</div>
          </div>
          @yield('content')
        </div>
      </v-app>
        <script src="{{mix('js/app.js')}}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha384-vk5WoKIaW/vJyUAd9n/wmopsmNhiy+L2Z+SBxGYnUkunIxVxAv/UtMOhba/xskxh" crossorigin="anonymous"></script>
        {{-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/544fc5cc4f.js" crossorigin="anonymous"></script>
        @include('layouts.footer')
    </body>
</html>
