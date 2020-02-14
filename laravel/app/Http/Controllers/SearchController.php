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
        
        $query = DB::table('courses')
            ->leftjoin('course_subject', 'courses.id', '=', 'course_subject.course_id')
            ->leftjoin('subjects', 'course_subject.subject_id', '=', 'subjects.id')
            ->leftjoin('course_day', 'courses.id', '=', 'course_day.course_id')
            ->leftjoin('days', 'days.id', '=', 'course_day.day_id');

        $tutor = $request->input('tutor');
        $area = $request->input('area');
        $subject = $request->input('subject');
        $day = $request->input('day');
        $time = $request->input('time');
        // $request->input('hour-class');
        // $request->input('no-class');
        // $request->input('max-price');

        // if ($tutor) {$query = $query->where('area', 'like', '%' . $area . '%');}
        if ($area) {$query = $query->where('courses.area', 'like', '%' . $area . '%');}
        if ($subject) {$query = $query->where('subjects.name', 'like', '%' . $subject . '%');}
        if ($day != 'ns') {$query = $query->where('days.name', '=', $day);}
        // if ($time != 'ns') {$query = $query->where('days.name', 'like', '%' . $day . '%');}

        $query = $query->select('area', 'startDate', 'price', 'subjects.name as sname', 'days.name as dname');
        return $query->get();

        // echo $courses;
        // foreach ($courses as $course) {
        //     echo $course->area;
        // }

        return response()->json(array('data' => $courses));
    }
}
