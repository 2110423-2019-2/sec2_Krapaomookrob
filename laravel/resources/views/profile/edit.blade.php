@extends('layouts.app')

@section('title', 'Profile')

@section('topic', 'My Account')

@section('content')
<div class="container">
  <form action="/profile" enctype="multipart/form-data" method="post">
    @csrf
    @method('PATCH')

    <div class="row justify-content-center">
      <div class="card col-12 p-0">
        <div class="card-header editt-bg m-0 p-0">
          <div class="container justify-content-center py-4">
            <div class="row justify-content-center">
              <img src={{ $user -> getImage()}} class ="input-file bg-white rounded-circle mb-3" style = "width: 150px;height:150px;">
            </div>
            <div class="row justify-content-center">
              <div class="h4">{{ $user -> name }}</div>
            </div>
            <div class="row justify-content-center">
            <div class="font-weight-light">{{ $user -> nickname }}</div>
            </div>
          </div>
        </div>
        <div class="container d-flex">
          <div class="card-body col-4 mx-3 mb-5 mt-5 dash">
            <h4 class="card-title">Personal Info</h4>
            <div class="card p-2 border-0">

                <div class="form-group row">
                <h6 class = "my-0" style = "color: lightgrey;">ROLE</h6>
                <input id="role"
                    type="text"
                    class="form-control @error('role') is-invalid @enderror"
                    name="role"
                    value="{{ old('role') ?? $user -> role }}"
                    autocomplete="role"
                    autofocus
                    disabled>
                </div>

                <div class="form-group row">
                  <h6 class = "my-0" style = "color: lightgrey;">NAME</h6>
                  <input id="name"
                      type="text"
                      class="form-control @error('name') is-invalid @enderror"
                      name="name"
                      value="{{ old('name') ?? $user -> name }}"
                      autocomplete="name"
                      autofocus>

                      @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors -> first('name') }}</strong>
                          </span>
                      @enderror
                  </div>

                <div class="form-group row">
                <h6 class = "my-0" style = "color: lightgrey;">NICKNAME</h6>
                  <input id="nickname"
                      type="text"
                      class="form-control @error('nickname') is-invalid @enderror"
                      name="nickname"
                      value="{{ old('nickname') ?? $user -> nickname }}"
                      autocomplete="nickname"
                      autofocus>

                      @error('nickname')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors -> first('nickname') }}</strong>
                          </span>
                      @enderror
                </div>

                <div class="form-group row">
                  <h6 class = "my-0" style = "color: lightgrey;">PHONE</h6>
                  <input id="phone"
                      type="text"
                      class="form-control @error('phone') is-invalid @enderror"
                      name="phone"
                      value="{{ old('phone') ?? $user -> phone }}"
                      autocomplete="phone"
                      autofocus>

                      @error('phone')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors -> first('phone') }}</strong>
                          </span>
                      @enderror
                </div>

                <div class="form-group row">
                  <h6 class = "my-0" style = "color: lightgrey;">EDUCATION LEVEL</h6>
                  <input id="education_level"
                      type="text"
                      class="form-control @error('education_level') is-invalid @enderror"
                      name="education_level"
                      value="{{ old('education_level') ?? $user -> education_level }}"
                      autocomplete="education_level"
                      autofocus>

                      @error('education_level')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors -> first('education_level') }}</strong>
                          </span>
                      @enderror
                </div>
            </div>
          </div>
          <div class="card-body col-4 mx-3 mb-5 mt-5 dash">
            <h4 class="card-title">Account</h4>
            <div class="card p-2 border-0">
                <h6 class = "my-0" style = "color: lightgrey;">EMAIL</h6>
                <span class = "mb-3" style = "color: grey;">{{ $user -> email }}</span>

                {{-- <h6 class = "my-0" style = "color: lightgrey;">PASSWORD</h6>
                <span class = "mb-3" style = "color: grey;">{{ $user -> getSecret() }}</span> --}}
            </div>
          </div>
          <div class="card-body col-4 mx-3 mb-5 mt-5 dash">
            <h4 class="card-title">Banking Info</h4>
            <div class="card p-2 border-0">

              <div class="form-group row">
                <h6 class = "my-0" style = "color: lightgrey;">ACCOUNT NUMBER</h6>
                <input id="account_number"
                    type="text"
                    class="form-control @error('account_number') is-invalid @enderror"
                    name="account_number"
                    value="{{ old('account_number') ?? $account_number }}"
                    autocomplete="account_number"
                    autofocus>
                    @error('account_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors -> first('account_number') }}</strong>
                        </span>
                    @enderror
              </div>

              <div class="form-group row">
                <h6 class = "my-0" style = "color: lightgrey;">ACCOUNT NAME</h6>
                <input id="account_name"
                    type="text"
                    class="form-control @error('account_name') is-invalid @enderror"
                    name="account_name"
                    value="{{ old('account_name') ?? $account_name }}"
                    autocomplete="account_name"
                    autofocus>
                    @error('account_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors -> first('account_name') }}</strong>
                        </span>
                    @enderror
              </div>

              <div class="form-group row">
                <h6 class = "my-0" style = "color: lightgrey;">BANK</h6>
                <input id="bank"
                    type="text"
                    class="form-control @error('bank') is-invalid @enderror"
                    name="bank"
                    value="{{ old('bank') ?? $bank }}"
                    autocomplete="bank"
                    autofocus>
                    @error('bank')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors -> first('bank') }}</strong>
                        </span>
                    @enderror
              </div>
            </div>
          </div>
        </div>

        <div class="container">

          {{-- image uploader --}}
          @if($user -> isTutor())
          <div class="row">
            <label for = "AdsImage" class="p-0 col-6 offset-1 col-form-lable" style = "color: #55B3E0;">Post Ads Banner (1000x300 px)</label>

              <input type = "file" class="offset-1 form-control-file" id="AdsImage" name ="AdsImage">
              @error('AdsImage')
                      <strong>{{ $errors -> first('AdsImage') }}</strong>
              @enderror
          </div>
          @endif

          <div class="row">
            <button class="btn ownbtn mb-3 col-2 offset-9">Save Profile</button>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
