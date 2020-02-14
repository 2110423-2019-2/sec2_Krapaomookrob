@extends('layouts.app')

ิ@section('title', 'My Courses')

@section('topic', 'My Courses')

@section('menu')

    <a href="/" class="btn ownbtn px-5">Back</a>

@endsection


@section('content')
    
    <table class="table owntable">
        <thead>
            <tr class='d-flex'>
            <th scope="col" class='col-2'>Tutor</th>
            <th scope="col" class='col-2'>Available Subjects</th>
            <th scope="col" class='col-2'>Areas</th>
            <th scope="col" class='col-2'>Classes</th>
            <th scope="col" class='col-2'>Price/Start Date</th>
            <th scope="col" class='col-2'></th>
            </tr>
        </thead>
        <tbody>
            @if($courses->total() == 0)
                <td scope="row" class='d-flex justify-content-center font-italic text-muted'>No registered course.</td>
            @endif
            @foreach($courses as $course)
                <tr class='d-flex'>
                    <td scope="row" class='col-2'>
                        <p class='font-weight-bold mb-0'> {{$course->user->nickname}} </p>
                        <p> {{$course->user->education_level}} </p>
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
                        {{$course->price}}  THB
                        <br/>
                        Starts on {{date('d-M-y', strtotime($course->startDate))}}
                    </td>
                    <td class="col-2 text-success">Success</td>
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

<style>
.owntable{
    margin-bottom: 0px !important;
    border-radius: 4px;
    background-color: white;
    box-shadow: 0px 0px 1px #888;
}

.owntable td{
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6 !important;
    
}

.owntable th{
    border-top: 0px !important;
    padding-top: 30px !important;
}

.owntable .ownbtn{
    width: 60%;
}


</style>