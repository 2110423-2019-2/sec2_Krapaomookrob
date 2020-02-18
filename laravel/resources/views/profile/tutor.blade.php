
@extends('layouts.app')

@section('title', 'Profile')

@section('topic', 'Tutor Profile')

@section('content')
<div id = "app" class="container">
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
            <a class="btn btn-light col-1 mt-3" href="#">Chat</a>
          </div>
        </div>
      </div>
      <div class="container d-flex">
        <div class="card-body col-4 mx-3 mb-5 mt-5 dash">
          <h4 class="card-title">General Info</h4>
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
        <div class="card-body col-8 mx-3 mb-5 mt-5 dash">
          <h4 class="card-title">Reviews</h4>
          <div class="card p-2 border-0">

            <h6 class = "my-0" style = "color: lightgrey;">OVERALL RATING</h6>
            <div style = "color: grey;">
              <star-rating :rating="3.8" :star-size="25" :border-width="0"  :rounded-corners="false" :read-only="true" :increment="0.01"></star-rating>
            </div>
            <div class="container overflow-auto px-0 mt-3" style = "height: 30vh">
              <div class="card col-12 mb-3 border-0" style = "background-color: #EEEEEE;">
                <div class="container d-flex">
                  <div class="card-body">
                    <div class="row flex">
                      <h6 class = "my-0">Review Subject</h6>
                      <div class="ml-auto">
                        <star-rating :rating="3.8" :star-size="15" :inline="true" :border-width="0" :rounded-corners="false" :read-only="true" :increment="0.01"></star-rating>
                      </div>
                    </div>
                    <div class="row">
                      <span class = "" style = "color: #999999; font-weight: 200;">Review Content. Lorem ipsum dolor sit amet</span>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="card col-12 mb-3  border-0" style = "background-color: #EEEEEE;">
                <div class="container d-flex">
                  <div class="card-body">
                    <div class="row flex">
                      <h6 class = "my-0">Review Subject</h6>
                      <div class="ml-auto">
                        <star-rating :rating="3.8" :star-size="15" :inline="true" :border-width="0" :rounded-corners="false" :read-only="true" :increment="0.01"></star-rating>
                      </div>
                    </div>
                    <div class="row">
                      <span class = "" style = "color: #999999; font-weight: 200;">Review Content. Lorem ipsum dolor sit amet</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card col-12 mb-3  border-0" style = "background-color: #EEEEEE;">
                <div class="container d-flex">
                  <div class="card-body">
                    <div class="row flex">
                      <h6 class = "my-0">Review Subject</h6>
                      <div class="ml-auto">
                        <star-rating :rating="3.8" :star-size="15" :inline="true" :border-width="0" :rounded-corners="false" :read-only="true" :increment="0.01"></star-rating>
                      </div>
                    </div>
                    <div class="row">
                      <span class = "" style = "color: #999999; font-weight: 200;">Review Content. Lorem ipsum dolor sit amet</span>
                    </div>
                  </div>
                </div>
              </div>

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src = "{{mix('js/app.js')}}"></script>
@endsection
