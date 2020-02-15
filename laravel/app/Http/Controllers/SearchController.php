<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Course;
use App\Subject;
use App\User;

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
        } else if ($request->input('tutor')) {
            $key = $request->input('tutor');
            $result = User::select('name')
                ->where('name', 'like', '%' . $key . '%')
                ->distinct()
                ->orderByRaw('CHAR_LENGTH(name)')
                ->get();
            $out = "";
            foreach ($result as $row) {
                $out .= "<option value=" . $row->name . ">";
            }
            return $out;
        } else if ($request->input('area')) {
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
            ->leftjoin('days', 'days.id', '=', 'course_day.day_id')
            ->leftjoin('users', 'users.id', '=', 'courses.user_id')
            ->where('users.role', '=', 'tutor');
            
        $tutor = $request->input('tutor');
        $area = $request->input('area');
        $subject = $request->input('subject');
        $day = $request->input('day');
        $time = $request->input('time');
        $hour = $request->input('hour');
        $noClass = $request->input('noClass');
        $maxPrice = $request->input('maxPrice');

        if ($tutor) {$query = $query->where('users.name', 'like', '%' . $tutor . '%');}
        if ($area) {$query = $query->where('courses.area', 'like', '%' . $area . '%');}
        if ($subject) {$query = $query->where('subjects.name', 'like', '%' . $subject . '%');}
        if ($day != 'ns') {$query = $query->where('days.name', '=', $day);}
        if ($time != 'ns') {$query = $query->where('courses.time', '=', $time);}
        if ($hour != 'ns') {$query = $query->where('courses.hours', '=', $hour);}
        if ($noClass) {$query = $query->where('courses.noClasses', '=', $noClass);}
        if ($maxPrice) {$query = $query->where('courses.price', '<=', $maxPrice);}
        
        $query = $query->select('courses.id')->distinct()->pluck('courses.id');
        

        $query_2 = DB::table('courses')
            ->whereIn('courses.id', $query)
            ->leftjoin('course_subject', 'courses.id', '=', 'course_subject.course_id')
            ->leftjoin('subjects', 'course_subject.subject_id', '=', 'subjects.id')
            ->leftjoin('course_day', 'courses.id', '=', 'course_day.course_id')
            ->leftjoin('days', 'days.id', '=', 'course_day.day_id')
            ->leftjoin('users', 'users.id', '=', 'courses.user_id');
            

        $course_day = DB::table('course_day')
            ->leftjoin('days', 'days.id', '=', 'course_day.day_id')
            ->select('course_day.course_id', DB::raw("GROUP_CONCAT(days.name SEPARATOR ', ') as day"))
            ->groupBy('course_day.course_id');
            
        $query_2 = $query_2->select(
            'courses.user_id', 
            'courses.id', 
            'area', 
            'startDate', 
            'price', 
            DB::raw("GROUP_CONCAT(DISTINCT subjects.name SEPARATOR ', ') as sname"),
            DB::raw("GROUP_CONCAT(DISTINCT days.name SEPARATOR ', ') as dname"),
            'users.name as uname',
            'courses.time',
            'courses.hours',
            'users.education_level',
            'courses.noClasses',
            'courses.studentCount',
        )->groupBy('courses.id');
        return $query_2->get();
    }
}
