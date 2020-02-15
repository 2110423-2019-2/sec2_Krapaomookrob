@extends('layouts.app')

@section('title', 'My Courses - Even Die I am The Tutor')

@section('topic', 'My Courses')


@section('content')
    <table class="table owntable">
        <thead>
            <tr class='d-flex'>
            @if(auth()->user()->isTutor())
                <th scope="col" class='col-2'>Courses</th>
            @else
                <th scope="col" class='col-2'>Tutor</th>
            @endif
            <th scope="col" class='col-2'>Available Subjects</th>
            <th scope="col" class='col-2'>Areas</th>
            <th scope="col" class='col-2'>Classes</th>
            <th scope="col" class='col-2'>Schedule</th>
            <th scope="col" class='col-2'>Status</th>
            </tr>
        </thead>
        <tbody>
            @if($courses->total() == 0)
                <td scope="row" class='d-flex justify-content-center font-italic text-muted'>No registered course.</td>
            @endif
            @foreach($courses as $index => $course)
                <tr class='d-flex'>
                    <td scope="row" class='col-2'>
                        @if(auth()->user()->isTutor())
                            <p class='font-weight-bold mb-0'>Course ID {{$course->id}} </p>
                            <p>No. of student {{$course->studentCount}} </p>
                        @else
                            <p class='font-weight-bold mb-0'> {{$course->user->nickname}} </p>
                            <p> {{$course->user->education_level}} </p>
                        @endif
                        <a href='#' class='btn ownbtn'>Chat</a> 
                    </td>
                    <td class='col-2'>{{implode(', ', $course->subjects->pluck('name')->toArray())}}</td>
                    <td class='col-2'> {{$course->area}}</td>
                    <td class='col-2'>
                        {{implode(', ', $course->days->pluck('name')->toArray())}}
                        <br/>
                        {{date('G:i', strtotime($course->time))}}  -  {{date('G:i', strtotime($course->time) + $course->hours*3600)}}
                        <br/>
                        ({{$course->hours}} hrs/class)
                        <br/>
                        {{$course->noClasses}} Classes
                        <br/>
                        {{$course->studentCount==1?'Individual':'Group' }}
                    </td>
                    <td class='col-2 font-weight-bold'>
                        Starts on {{date('d/m/y', strtotime($course->startDate))}}
                        <br/>
                        @if(!$isFinished[$index])
                            Next class {{date('d/m/y', strtotime($nextClasses[$index]))}}
                            <br/>
                            {{$classesLeft[$index]}} Classes Left
                        @else
                            Finished on {{date('d/m/y', strtotime(end($classDateList[$index])))}}
                        @endif
                    </td>
                    <td class="col-2">
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{100*(1-$classesLeft[$index]/$course->noClasses)}}%" ></div>
                        </div>
                        @if($isFinished[$index])
                            <div class="row justify-content-md-center"">
                                <p class="text-success">Finished</p>
                            </div>
                        @elseif(!$isFinished[$index] & auth()->user()->isStudent())
                            <div class="row"><a class="btn btn-danger" href="#">Cancel</a></div>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <footer>
        <tr>
            {{$courses->links('paginator')}}
        </tr>
    </footer>
@endsection

