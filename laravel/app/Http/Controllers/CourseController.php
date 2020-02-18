<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Day;
use App\Subject;
use Auth;
use Carbon\Carbon;

use App\Course;
use App\Course_day;
use App\Course_subject;
use App\User;

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

    public function getCourseInfo($courseId) {
        // find course
        $course = Course::find($courseId);
        
        // find days
        $days = $course->days->pluck('name');
        
        // find subject
        $subjects = $course->subjects->pluck('name');

        // find tutor's name
        $tutorName = $course->user->name;

        $returnObj = [
            'tutor_name' => $tutorName,
            'course_id' => $course->id,
            'area' => $course->locations->pluck('name'),
            'time' => $course->time,
            'hour' => $course->hours,
            'startDate' => $course->startDate,
            'price' => $course->price,
            'days' => $days,
            'subjects' => $subjects,
            'noClass' => $course->noClasses,
            'studentCount' => $course->studentCount 
        ];

        return $returnObj;
    }

}
