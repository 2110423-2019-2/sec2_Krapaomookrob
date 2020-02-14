<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Day;
use App\Subject;
use App\Course;

class CourseController extends Controller
{
    public function fetchDays(){
        $days = Day::all()->pluck('name');
        return $days;
    }

    public function fetchSubjects(){
        $days = Subject::all()->pluck('name');
        return $days;
    }

    public function myCoursesIndex(){
        $courses = Course::with(['days', 'subjects'])->where('user_id', auth()->user()->id)->paginate(5)->onEachSide(1);
        return view('my_courses', ['courses' => $courses]);
    }
}
