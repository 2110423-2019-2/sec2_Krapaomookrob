@extends('layouts.app')

@section('title', 'Usertype - Even Die I am The Tutor')

@section('topic', 'Search Results')

@section('content')
<div class="row">
  <div class="col-lg-12">

    {{-- Search Results Card --}}
    <div class="card">
        {{-- table head --}}
        <div class="d-flex flex-wrap pt-3">
            <div class="col-2">Student</div>
            <div class="col-2">Requests Subject</div>
            <div class="col-2">Areas</div>
            <div class="col-2">Requests Classes</div>
            <div class="col-2">Price/Start Date</div>
        </div>
        <hr color="#828C95">
        {{-- results --}}
        <div class="d-flex flex-wrap">
            <div class="col-2">
                <div class="d-flex flex-column flex-wrap align-items-stretch">
                    <div>N'Plakim</div>
                    <div><small>Chula Engineering</small></div>
                    <div class="pt-1"><a class="btn btn-light" href="#" style="width:100px">Chat</a></div>
                </div>
            </div>
            <div class="col-2">
                <small>Math, Physics, Programming, English</small>
            </div>
            <div class="col-2">
                <small>Siam, Bangkok, BTS Skytrain</small>
            </div>
            <div class="col-2">
                <div><small>Sat</small></div>
                <div><small>13:00-15:00</small></div>
                <div><small>2 hrs/class</small></div>
                <div><small>4 Classes,</small></div>
                <div><small>Individual</small></div>
            </div>
            <div class="col-2">
                <div>4000 THB</div>
                <div>Starts on 19/02/2020</div>
            </div>
            <div class="col-2">

                {{-- Modal --}}
                  <div class="btn ownbtn" data-toggle="modal" data-target="#yourModal">Request</div>
                    <div class="modal fade" id="yourModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Comfirm Request?</h4>
                          </div>
                          <div class="modal-body">
                            <div>Name: N'Plakim</div>
                            <div>Subject: Math, Physics, Programming, English</div>
                            <div>Places: Siam, Bangkok, BTS Skytrain</div>
                            <div>Date/Time: Sat 13:00-15:00</div>
                            <div>Class: 2 hrs/class 4 Classes, Individual</div>
                            <div>Price: 4000 THB</div>
                            <div>Starts on 19/02/2020</div>
                          </div>
                          <div class="modal-footer">
                            <div class="btn btn-light" data-dismiss="modal">Cancel</div>
                            <a class="btn ownbtn" href="/">Confirm</a>
                          </div>
                        </div>
                      </div>
                    </div>
            </div>
        </div>
        <hr color="#D6CECE">
    </div>
  </div>
</div>
@endsection
