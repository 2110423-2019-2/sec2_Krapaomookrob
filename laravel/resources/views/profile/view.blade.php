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
            <img src={{ $user -> getImage()}} class ="bg-white rounded-circle mb-3" style = "width: 15%;height:15%;">
          </div>
          <div class="row justify-content-center">
            <div class="h4">{{ $user -> name }}</div>
          </div>
          <div class="row justify-content-center">
          <div class="font-weight-light">{{ $user -> nickname }}</div>
          </div>
          <div class="row justify-content-center">
            <form>
              <button type="submit" formaction="/profile/edit" class="btn btn-light mt-3">Edit Profile</button>
            </form>
          </div>
        </div>
      </div>
      <div class="container d-flex">
        <div class="card-body col-4 mx-3 mb-5 mt-5 dash">
          <h4 class="card-title">Personal Info</h4>
          <div class="card p-2 border-0">
              <h6 class = "my-0" style = "color: lightgrey;">ROLE</h6>
              <span class = "mb-3" style = "color: grey;">{{ $role }}</span>

              <h6 class = "my-0" style = "color: lightgrey;">NAME</h6>
              <span class = "mb-3" style = "color: grey;">{{ $username }}</span>

              <h6 class = "my-0" style = "color: lightgrey;">NICKNAME</h6>
              <span class = "mb-3" style = "color: grey;">{{ $nickname }}</span>

              <h6 class = "my-0" style = "color: lightgrey;">PHONE</h6>
              <span class = "mb-3" style = "color: grey;">{{ $phone }}</span>

              <h6 class = "my-0" style = "color: lightgrey;">EDUCATION LEVEL</h6>
              <span class = "" style = "color: grey;">{{ $education_level }}</span>
          </div>
        </div>
        <div class="card-body col-4 mx-3 mb-5 mt-5 dash">
          <h4 class="card-title">Account</h4>
          <div class="card p-2 border-0">
              <h6 class = "my-0" style = "color: lightgrey;">EMAIL</h6>
              <span class = "mb-3" style = "color: grey;">{{ $email }}</span>

              <h6 class = "my-0" style = "color: lightgrey;">PASSWORD</h6>
              <span class = "mb-3" style = "color: grey;">{{ $password }}</span>
          </div>
        </div>
        <div class="card-body col-4 mx-3 mb-5 mt-5 dash">
          <h4 class="card-title">Banking Info</h4>
          <div class="card p-2 border-0">
              <h6 class = "my-0" style = "color: lightgrey;">ACCOUNT NUMBER</h6>
              <span class = "mb-3" style = "color: grey;">{{ $account_number}}</span>

              <h6 class = "my-0" style = "color: lightgrey;">ACCOUNT NAME</h6>
              <span class = "mb-3" style = "color: grey;">{{ $account_name}}</span>

              <h6 class = "my-0" style = "color: lightgrey;">BANK</h6>
              <span class = "mb-3" style = "color: grey;">{{ $bank }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
