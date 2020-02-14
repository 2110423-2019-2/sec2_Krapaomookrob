<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Day;
use App\Subject;
use Auth;
use Carbon\Carbon;

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

    public function newCourse(Request $request){
        $course = new Course;
        $course->area = $request->area;
        $course->time = "{$request->time['HH']}:{$request->time['mm']}:00";
        $course->hours = $request->hours;
        $course->startDate = (new Carbon($request->startDate))->addHours(7);
        $course->price = $request->price;
        $course->noClasses = $request->noClasses;
        $course->studentCount = $request->studentCount;
        $course->user()->associate(Auth::user());
        $course->save();

        $days = Day::whereIn('name', $request->days)->get()->pluck('id');
        $subjects = Subject::whereIn('name', $request->subjects)->get()->pluck('id');
        $course->subjects()->sync($subjects);
        $course->days()->sync($days);
        $course->save();
        return response('OK', 200);
    }
}
