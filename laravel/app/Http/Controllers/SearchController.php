<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;

class SearchController extends Controller
{
    
    public function searchCourse(Request $request){
        
        // $request->input('tutor');
        // $request->input('area');
        // $request->input('subject');
        // $request->input('day');
        // $request->input('time');
        // $request->input('hour-class');
        // $request->input('no-class');
        // $request->input('max-price');

        $courses = Course::all();

        // echo $courses;
        // foreach ($courses as $course) {
        //     echo $course->area;
        // }
        
        return response()->json(array('data' => $courses));
        
        // dd($request->input('aaa'));
        // return response()->json([
        //     'name' => 'Abigail',
        //     'state' => $course->area
        // ]);    
    }
}
