<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Course;
use App\Subject;

class SearchController extends Controller
{
    public function liveSearch(Request $request) {
        if ($request->input('subject')) {
            $result = Subject::select('name')->get();
            $out = "";
            foreach ($result as $row) {
                $out .= "<option value=" . $row->name . ">";
            }
            return $out;
        } else {
            $key = $request->input('area');
            $result = Course::select('area')
                ->where('area', 'like', '%' . $key . '%')
                ->distinct()
                ->orderByRaw('CHAR_LENGTH(area)')
                ->get();
            $out = "";
            foreach ($result as $row) {
                $out .= "<option value=" . $row->area . ">";
            }
            return $out;
        }
    }

    public function searchCourse(Request $request){
        
        
        // $request->input('tutor');
        $area = $request->input('area');
        $subject = $request->input('subject');
        // $request->input('day');
        // $request->input('time');
        // $request->input('hour-class');
        // $request->input('no-class');
        // $request->input('max-price');

        // return DB::table()
        return DB::table('course_subject')
            // ->where('area', 'like', '%' . $area . '%')
            // ->orWhere('subject', 'like', '%' . $subject . '%')
            ->get();

        // echo $courses;
        // foreach ($courses as $course) {
        //     echo $course->area;
        // }

        return response()->json(array('data' => $courses));
    }
}
