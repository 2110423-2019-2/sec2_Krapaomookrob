<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Course;
use App\CourseRequester;
use App\Day;
use App\User;
use App\Location;
use App\Subject;
use App\CourseStudent;


class SearchController extends Controller
{
    public function fetchTutors(){
        $tutors = User::all()
            ->where('role', '=', 'tutor')
            ->pluck('name');
        return $tutors;
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
        $area = json_decode($request->input('area'));
        return response($area, 200);
        $subjects = $request->input('subject');
        $lat = $area->lat;
        $long = $area->lng;
        //return response($area, 200);
        $days = $request->input('day');
        $time = $request->input('time');
        $hour = $request->input('hour');
        $noClass = $request->input('noClass');
        $maxPrice = $request->input('maxPrice');
        //return response('OK', 200);
        $query = DB::table('courses')
            ->leftjoin('course_subject', 'courses.id', '=', 'course_subject.course_id')
            ->leftjoin('subjects', 'course_subject.subject_id', '=', 'subjects.id')
            ->leftjoin('course_day', 'courses.id', '=', 'course_day.course_id')
            ->leftjoin('days', 'days.id', '=', 'course_day.day_id')
            ->leftjoin('users', 'users.id', '=', 'courses.user_id')
            ->leftjoin('locations', 'locations.id', '=', 'courses.location_id')
            ->where('users.role', '=', 'tutor');

        if ($tutor) {$query = $query->where('users.name', 'like', '%' . $tutor . '%');}
        if ($subjects) {$query = $query->whereIn('subjects.name', $subjects);}
        if ($days) {$query = $query->whereIn('days.name', $days);}
        if ($time) {$query = $query->where('courses.time', '=', $time);}
        if ($hour) {$query = $query->where('courses.hours', '=', $hour);}
        if ($noClass) {$query = $query->where('courses.noClasses', '=', $noClass);}
        if ($maxPrice) {$query = $query->where('courses.price', '<=', $maxPrice);}

        $query = $this->scopeDistance($query, $lat, $long);
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
            DB::raw("GROUP_CONCAT(DISTINCT subjects.name SEPARATOR ', ') as subjects"),
            DB::raw("GROUP_CONCAT(DISTINCT days.name SEPARATOR ', ') as days"),
            'locations.name as area',
            'users.name as tutor',
            'users.education_level'
            )->groupBy('courses.id');

        // for filtering only not registered course
        $registered_course = CourseStudent::all()->pluck('course_id');
        $query_2 = $query_2->whereNotIn('courses.id', $registered_course);
        return $query_2->get();
        
    }

    private function scopeDistance($query, $lat, $lng) {
        $unit = 6378.10;
        $lat = (float) $lat;
        $lng = (float) $lng;
        $radius = (double) 1;
        $distance = "($unit * acos(cos(radians(" . $lat . "))
                    * cos(radians(`latitude`))
                    * cos(radians(`longitude`)
                    - radians(" . $lng . "))
                    + sin(radians(" . $lat . "))
                    * sin(radians(`latitude`))))";
        return $query->selectRaw("{$distance} AS distance")
                    ->whereRaw("{$distance} < ?", [$radius]);
    }

    public function tutorSearchCourses(Request $request) {
        $area = json_decode($request->input('area'));
        $lat = $area->lat;
        $long = $area->lng;
        $subjects = $request->input('subject');
        $days = $request->input('day');
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
            ->leftjoin('locations', 'locations.id', '=', 'courses.location_id')
            ->where('users.role', '=', 'student');

        if ($subjects) {$query = $query->whereIn('subjects.name', $subjects);}
        if ($days) {$query = $query->whereIn('days.name', $days);}
        if ($time) {$query = $query->where('courses.time', '=', $time);}
        if ($hour) {$query = $query->where('courses.hours', '=', $hour);}
        if ($noClass) {$query = $query->where('courses.noClasses', '=', $noClass);}
        if ($maxPrice) {$query = $query->where('courses.price', '<=', $maxPrice);}

        $query = $this->scopeDistance($query, $lat, $long);
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
            DB::raw("GROUP_CONCAT(DISTINCT subjects.name SEPARATOR ', ') as subjects"),
            DB::raw("GROUP_CONCAT(DISTINCT days.name SEPARATOR ', ') as days"),
            'locations.name as area',
            'users.name as student',
            'users.education_level'
            )->groupBy('courses.id');

        // for filtering only not requested course
        $requested_course = CourseRequester::all()->where('requester_id', '=', auth()->user()->id)->pluck('course_id');
        $query_2 = $query_2->whereNotIn('courses.id', $requested_course);
        return $query_2->get();
    }

    public function redirectSearchCourses() {
        if (auth() -> user() -> isTutor()) {
            return redirect('/tutor-search');
        }
        return view('search_courses');
    }

    public function redirectTutorSearchCourses() {
        if (auth() -> user() -> isStudent()) {
            return redirect('/search-courses');
        }
        return view('tutor_search_course');
    }
}
