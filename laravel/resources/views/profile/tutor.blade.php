
@extends('layouts.app')

@section('title', 'Profile')

@section('topic', 'Tutor Profile')

@section('content')

@if( $hasAds )
<div class="container bg-white" style = "height:15vw; width: 50vw; background-image: url('{{ $banner }}');background-size: cover;"></div>
@endif

<div class="container">
  <div class="row justify-content-center">
    <div class="card col-12 p-0">
      <div class="card-header editt-bg m-0 p-0">
        <div class="container justify-content-center py-4">
          <div class="row justify-content-center">
            <img src={{ $user -> getImage()}} class ="bg-white rounded-circle mb-3" style = "width: 150px;height:150px;">
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
          {{-- This is Star Display tutorid --}}
        {{-- <star-display tutorid = "{{$user -> id}}"></star-display> --}}
          <div class="card p-2 border-0">
            <div class="d-flex justify-content-start align-center">
                <h6 class = "my-0" style = "color: lightgrey;">OVERALL RATING</h6>
                <star-rating-score rating ="{{$rating}}"></star-rating-score>
            </div>
            <div class="container overflow-auto px-0" style = "height: 30vh">
              @foreach($reviewsWithSubjects as $review)
              <div class="card col-12 mb-3 border-0" style = "background-color: #EEEEEE;">
                <div class="container px-3 py-0 d-flex">
                  <div class="card-body px-3 py-0">
                    <div class="row">
                      <div class="d-flex align-center">
                        <h6 class = "my-0">{{$review -> review -> name}}</h6>
                        <star-rating-score rating ="{{$review -> review ->  rating}}"></star-rating-score>
                        </div>
                      </div>
                      <div class="row">
                        <span class = "" style = "color: #999999; font-weight: 200;"> Subject:
                        @foreach ($review->subjects as $subject)
                            {{$subject}}
                        @endforeach
                        </span>
                      </div>
                      <div class="row">
                        <span class = "" style = "color: #999999; font-weight: 200;">{{$review -> review ->message}}</span>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
