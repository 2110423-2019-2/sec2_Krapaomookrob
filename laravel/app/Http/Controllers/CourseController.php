<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Day;
use App\Location;
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
        $location = Location::firstOrCreate(
          ['locationId' => $request->locationId],
          ['name' => $request->area, 'address' => $request->address, 'latitude' => $request->center['lat'],'longitude' =>$request->center['lng']]
        );

        $course = new Course;
        $course->time = $request->time;
        $course->hours = $request->hours;
        $course->startDate = new Carbon($request->startDate);
        $course->price = $request->price;
        $course->noClasses = $request->noClasses;
        $course->studentCount = $request->studentCount;
        $course->user()->associate(Auth::user());
        $course->location()->associate($location);
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
            'area' => $course->area,
            'time' => $course->time,
            'hour' => $course->hours,
            'startDate' => $course->startDate,
            'price' => $course->price,
            'days' => $days,
            'subjects' => $subjects,
            'noClass' => $course->noClass,
            'studentCount' => $course->studentCount
        ];

        return $returnObj;
    }

    public function requestCourse(Request $request) {
        $data = array('course_id'=>$request->course_id,"requester_id"=>auth()->user()->id);
        DB::table("courses_requester")->insert($data);
        return response()->json(array('msg'=> "Done"), 200);
    }

    public function search(Request $request) {
        $student_name = $request->input("student_name");
        $area = $request->input("area");
        $subject = $request->input("subject");
        $day = $request->input("day");
        $time = $request->input("time");
        $num_students = $request->input("num_students");
        $max_price = $request->input("max_price");
        $courses = DB::table('courses')->paginate(15);
        return view("/tutor_search_course",compact('courses'));
    }

}
