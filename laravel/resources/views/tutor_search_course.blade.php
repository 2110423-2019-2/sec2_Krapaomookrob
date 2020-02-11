@extends('layouts.app')

@section('title', 'Usertype - Even Die I am The Tutor')

{{-- @section('topic', 'Search Courses') --}}

@section('content')
<div class="row pb-4">
  <div class="col-lg-12">
    <h2>Search Courses</h2>
    <div class="card">
        <div class="d-flex flex-wrap flex-column p-3">
            <div class="strong h5" style="align-self: center">Search Courses</div>
            <form action="/tutor-search" method="POST" role="search">
                <div class="d-flex flex-wrap pt-3">
                        @csrf
                        <div class="col-3">
                            <h5>Tutor</h5>
                            <input type="text" placeholder="Student's Name" name="student_name" class="pl-2 small">
                            <h5 class="pt-2">Area</h5>
                            <input type="text" placeholder="Area/City/Province" name="area" class="pl-2 small">
                        </div>
                        <div class="col-3">
                            <h5>Subjects</h5>
                            <input type="text" placeholder="Subject" name="subject" class="pl-2 small">
                        </div>
                        <div class="col-3">
                            <h5>Day</h5>
                            <select class="dropdown-primary" name="day">
                                <option value="">Not Specified</option>
                                <option value="monday">Monday</option>
                                <option value="tuesday">Tuesday</option>
                                <option value="wednesday">Wednesday</option>
                                <option value="thursday">Thursday</option>
                                <option value="friday">Friday</option>
                                <option value="saturday">Saturday</option>
                                <option value="sunday">Sunday</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <h5>Time</h5>
                            <select class="dropdown-primary" name="time">
                                <option value="">Not Specified</option>
                                <option value="morning">Morning</option>
                                <option value="afternoon">Afternoon</option>
                                <option value="evening">Evening</option>
                                <option value="night">Night</option>
                            </select>
                            <h5 class="pt-2">No. of Students</h5>
                            <input type="text" placeholder="Not Specified" name="num_students" class="pl-2 small">
                            <h5 class="pt-2">Max Price</h5>
                            <input type="text" placeholder="Not Specified" name="max_price" class="pl-2 small">
                        </div>
                </div>
                <div class="d-flex flex-wrap pt-3" style="justify-content: center"><button type="submit" class="btn ownbtn">Search Courses</button></div>
            </form>
        </div>
    </div>
    @if (!empty($courses))
    <h2 class="pt-3">Search Results</h2>
    <div class="card">
        <div class="d-flex flex-wrap pt-3">
            <div class="col-2">Student</div>
            <div class="col-2">Requests Subject</div>
            <div class="col-2">Areas</div>
            <div class="col-2">Requests Classes</div>
            <div class="col-2">Price/Start Date</div>
        </div>
        <hr color="#828C95">
        @foreach ($courses as $course)
        <div class="d-flex flex-wrap">
            <div class="col-2 d-flex flex-column flex-wrap">
                <div>{{$course->area}}</div>
                <div style="margin-bottom: auto"><small>Chula Engineering</small></div>
                <div class="pt-1"><a class="btn btn-light" href="#" style="width:100px">Chat</a></div>
            </div>
            <div class="col-2 d-flex flex-column flex-wrap">
                <small>Math, Physics, Programming, English</small>
            </div>
            <div class="col-2 d-flex flex-column flex-wrap">
                <small>Siam, Bangkok, BTS Skytrain</small>
            </div>
            <div class="col-2 d-flex flex-column flex-wrap">
                <div><small>Sat</small></div>
                <div><small>13:00-15:00</small></div>
                <div><small>2 hrs/class</small></div>
                <div><small>4 Classes,</small></div>
                <div><small>Individual</small></div>
            </div>
            <div class="col-2 d-flex flex-column flex-wrap">
                <div>{{$course->price}} THB</div>
                <div>Starts on 19/02/2020</div>
            </div>
            <div class="col-2 d-flex flex-column flex-wrap" style="justify-content: flex-end">
                <div class="btn ownbtn" data-toggle="modal" data-target="#x{{$course->id}}">Request to be Tutor</div>
                    <div class="modal fade" id="x{{$course->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Comfirm Request?</h4>
                          </div>
                          <div class="modal-body">
                            <div>Name: {{$course->id}}</div>
                            <div>Subject: Math, Physics, Programming, English</div>
                            <div>Places: Siam, Bangkok, BTS Skytrain</div>
                            <div>Date/Time: Sat 13:00-15:00</div>
                            <div>Class: 2 hrs/class 4 Classes, Individual</div>
                            <div>Price: {{$course->price}} THB</div>
                            <div>Starts on 19/02/2020</div>
                          </div>
                          <div class="modal-footer">
                            <div class="btn btn-light" data-dismiss="modal">Cancel</div>
                            <form class="icon-radiobtn" action="/tutor-request" method="POST">
                                @csrf
                                <input type="hidden" name="course_id" value=" {{$course->id}}">
                                <input type="hidden" name="requester_id" value=" {{auth()->user()->id}}">
                                <button id=1 type="submit" class="btn ownbtn" >Confirm</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
            </div>
        </div>
        <hr color="#D6CECE">
        @endforeach
    </div>
    @endif
  </div>
</div>
@endsection
