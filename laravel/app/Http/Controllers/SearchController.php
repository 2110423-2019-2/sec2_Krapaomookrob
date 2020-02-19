<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Course;
use App\Day;
use App\User;
use App\Location;
use App\Subject;

class SearchController extends Controller
{
    public function fetchTutors(){
        $tutors = User::all()
            ->where('role', '=', 'tutor')
            ->pluck('name');
        return $tutors;
    }

    public function fetchAreas() {
        $areas = Location::all()
            ->pluck('name');
        return $areas;
    }

    public function fetchDays(){
        $days = Day::all()->pluck('name');
        return $days;
    }

    public function fetchSubjects(){
        $days = Subject::all()->pluck('name');
        return $days;
    }

    public function searchCourses(Request $request) {
        $tutor = $request->input('tutor');
        $area = $request->input('area');
        $subject = $request->input('subject');
        $day = $request->input('day');
        $time = $request->input('time');
        $hour = $request->input('hour');
        $noClass = $request->input('noClass');
        $maxPrice = $request->input('maxPrice');

        $query = DB::table('courses')
            ->leftjoin('course_subject', 'courses.id', '=', 'course_subject.course_id')
            ->leftjoin('subjects', 'course_subject.subject_id', '=', 'subjects.id')
            ->leftjoin('course_day', 'courses.id', '=', 'course_day.course_id')
            ->leftjoin('days', 'days.id', '=', 'course_day.day_id')
            ->leftjoin('users', 'users.id', '=', 'courses.user_id')
            ->where('users.role', '=', 'tutor');

        if ($tutor) {$query = $query->where('users.name', 'like', '%' . $tutor . '%');}
        if ($area) {
            $areaArray = explode(',', $area);
            $query = $query->where(function ($queryTem) use($areaArray) {
                for ($i = 0; $i < count($areaArray); $i++){
                    $queryTem->orwhere('courses.area', 'like',  '%' . $areaArray[$i] .'%');
                }      
            });
        }
        if ($subject) {
            $subjectArray = explode(',', $subject);
            $query = $query->whereIn('subjects.name', $subjectArray);
        }
        // if ($day) {$query = $query->where('days.name', '=', $day);}
        if ($day) {
            $dayArray = explode(',', $day);
            $query = $query->whereIn('days.name', $dayArray);
        }
        if ($time) {$query = $query->where('courses.time', '=', $time);}
        if ($hour) {$query = $query->where('courses.hours', '=', $hour);}
        if ($noClass) {$query = $query->where('courses.noClasses', '=', $noClass);}
        if ($maxPrice) {$query = $query->where('courses.price', '<=', $maxPrice);}
        
        $query = $query->select('courses.id')->distinct()->pluck('courses.id');
        

        $query_2 = DB::table('courses')
            ->whereIn('courses.id', $query)
            ->leftjoin('course_subject', 'courses.id', '=', 'course_subject.course_id')
            ->leftjoin('subjects', 'course_subject.subject_id', '=', 'subjects.id')
            ->leftjoin('course_day', 'courses.id', '=', 'course_day.course_id')
            ->leftjoin('days', 'days.id', '=', 'course_day.day_id')
            ->leftjoin('users', 'users.id', '=', 'courses.user_id')
            ->leftjoin('locations', 'locations.id', '=', 'courses.location_id');

        $query_2 = $query_2->select(
            'courses.id', 
            'courses.user_id', 
            'courses.price', 
            'courses.startDate', 
            'courses.time',
            'courses.hours',
            'courses.noClasses',
            'courses.studentCount',
            DB::raw("GROUP_CONCAT(DISTINCT subjects.name SEPARATOR ', ') as sname"),
            DB::raw("GROUP_CONCAT(DISTINCT days.name SEPARATOR ', ') as dname"),
            'locations.name', 
            'users.name as uname',
            'users.education_level',
        )->groupBy('courses.id');

        return $query_2->get();
    }
}
