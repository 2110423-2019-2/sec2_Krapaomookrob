@extends('layouts.app')

@section('title', 'Profile')

@section('topic', 'My Account')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="card col-12 p-0">
      <div class="card-header editt-bg m-0 p-0">
        <div class="container justify-content-center py-4">
          <div class="row justify-content-center">
            <img src={{ $user -> getImage()}} class ="bg-white rounded-circle mb-3" style = "width: 15%">
          </div>
          <div class="row justify-content-center">
            <div class="h4">{{ $user -> name }}</div>
          </div>
          <div class="row justify-content-center">
          <div class="font-weight-light">{{ $user -> nickname }}</div>
          </div>
          <div class="row justify-content-center">
            <button class="btn btn-light mt-3">Edit Profile</button>
          </div>
        </div>
      </div>
      <div class="container d-flex">
        <div class="card-body col-4 mx-3 mb-5 mt-5 dash">
          <h4 class="card-title">Personal Info</h4>
          <div class="card p-2 border-0">
              <h6 class = "my-0" style = "color: lightgrey;">ROLE</h6>
              <h5 class = "mb-3" style = "color: grey;">{{ $role }}</h5>

              <h6 class = "my-0" style = "color: lightgrey;">NAME</h6>
              <h5 class = "mb-3" style = "color: grey;">{{ $username }}</h5>

              <h6 class = "my-0" style = "color: lightgrey;">NICKNAME</h6>
              <h5 class = "mb-3" style = "color: grey;">{{ $nickname }}</h5>

              <h6 class = "my-0" style = "color: lightgrey;">PHONE</h6>
              <h5 class = "mb-3" style = "color: grey;">{{ $phone }}</h5>

              <h6 class = "my-0" style = "color: lightgrey;">EDUCATION LEVEL</h6>
              <h5 class = "" style = "color: grey;">{{ $education_level }}</h5>
          </div>
        </div>
        <div class="card-body col-4 mx-3 mb-5 mt-5 dash">
          <h4 class="card-title">Account</h4>
          <div class="card p-2 border-0">
              <h6 class = "my-0" style = "color: lightgrey;">EMAIL</h6>
              <h5 class = "mb-3" style = "color: grey;">{{ $email }}</h5>

              <h6 class = "my-0" style = "color: lightgrey;">PASSWORD</h6>
              <h5 class = "mb-3" style = "color: grey;">{{ $password }}</h5>
          </div>
        </div>
        <div class="card-body col-4 mx-3 mb-5 mt-5 dash">
          <h4 class="card-title">Banking Info</h4>
          <div class="card p-2 border-0">
              <h6 class = "my-0" style = "color: lightgrey;">ACCOUNT NUMBER</h6>
              <h5 class = "mb-3" style = "color: grey;">025-3-13080-6</h5>

              <h6 class = "my-0" style = "color: lightgrey;">ACCOUNT NAME</h6>
              <h5 class = "mb-3" style = "color: grey;">Krit Kruaykitanon</h5>

              <h6 class = "my-0" style = "color: lightgrey;">BANK</h6>
              <h5 class = "mb-3" style = "color: grey;">Kasikorn Thai</h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
