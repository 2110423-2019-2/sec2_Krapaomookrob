<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function requestCourse(Request $request) {
        $data = array('course_id'=>$request->course_id,"requester_id"=>$request->requester_id);
        DB::table("courses_requester")->insert($data);
        //dd(request());
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

        //dd($courses);
        return view("/tutor_search_course",compact('courses'));
    }

}
