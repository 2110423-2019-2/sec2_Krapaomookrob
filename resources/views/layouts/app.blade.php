<!DOCTYPE html>
<html lang="th">
    <head>
        <meta charset="UTF-8">
        <title>@yield('title')</title>
        <meta name="keywords" content="@yield('keywords')">
        <meta name="description" content="@yield('description')">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{asset('img/favicon.png')}}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="{{mix('css/app.css')}}" rel="stylesheet">
        @yield('head')
    </head>

    <body>
      <header id="header">
        <div class="container">
          <nav class="navbar navbar-expand-lg navbar-light px-0">
            <a class="navbar-brand" href="#"><img src="https://getbootstrap.com/docs/4.4/assets/brand/bootstrap-solid.svg" width="30" height="30" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <span class="navbar-text mr-auto"></span>
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="btn btn-outline-primary" href="#">Dashboard</a>
                </li>
                <li class="nav-item">
                  <a class="btn btn-outline-primary" href="#">My Courses</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="btn btn-outline-primary" href="#">My Calendar</a>
                </li>
                <li class="nav-item">
                  <a class="btn btn-outline-primary" href="#">Messages</a>
                </li>
                <li class="nav-item">
                  <a class="btn btn-outline-primary" href="#">My Account</a>
                </li>
                <li class="nav-item">
                  <a class="btn btn-outline-primary" href="#">🔔</a>
                </li>
                <li class="nav-item">
                  <a class="btn btn-outline-primary" href="#">🛒 Cart</a>
                </li>
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

      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>
