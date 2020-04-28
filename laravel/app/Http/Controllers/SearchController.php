<?php

namespace App\Http\Controllers;

use App\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Course;
use App\CourseRequester;
use App\Day;
use App\User;
use App\Location;
use App\Subject;
use App\CourseStudent;
use Illuminate\Validation\Rule;

class SearchController extends Controller
{
    //use Validator;
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
        $subjects = Subject::all()->pluck('name');
        return $subjects;
    }

    public function searchCourses(Request $request) {
        $tutor = $request->input('tutor');
        //  Default Area.
        $area = json_decode($request->input('area'));
        $lat = $area->lat;
        $long = $area->lng;
        // $lat = 13.7384627;
        // $long = 100.5320458;

        $subjects = $request->input('subject');
        $days = $request->input('day');
        $time = $request->input('time');
        $hour = $request->input('hour');
        $noClass = $request->input('noClass');
        $maxPrice = $request->input('maxPrice');

        //  Validator
        $data = request()->validate([
            'subject' => 'nullable',
            'day' => 'nullable',
            'time' => 'nullable|date_format:H:i',
            'hour' => 'nullable',
            'noClass' => 'gt:0|nullable',
            'maxPrice' => 'gte:0|nullable'
        ]);

        //  Validate if each day is days in a week
        $daysinweek = $this->fetchDays()->toArray();
        if(!empty($days)){
            foreach($days as $day){
                if(!in_array($day, $daysinweek) && $day != null){
                    return response($day,422);
                }
            }
        }

        //  Validate if each subject is in the subjectlist
        $subjectlist = $this->fetchSubjects()->toArray();
        if(!empty($subjects)){
            foreach($subjects as $subject){
                if(!in_array($subject, $subjectlist) && $subject != null){
                    return response($subject,422);
                }
            }
        }

        //  Validate if hour is in the hour list
        $hourlist = ['1','2','3','4'];
        if(!empty($hour)){
            foreach($hour as $number){
                if(!in_array($number, $hourlist)  && $number != null){
                    return response($number,422);
                }
            }
        }

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
        //return response('OK', 200);

        if ($lat != 13.7384627 || $long != 100.5320457) {
            $query = $this->scopeDistance($query, $lat, $long);
        }
        $query = $query->select('courses.id')->distinct()->pluck('courses.id');

        $query_2 = DB::table('courses')
            ->whereIn('courses.id', $query)
            ->leftjoin('course_subject', 'courses.id', '=', 'course_subject.course_id')
            ->leftjoin('subjects', 'course_subject.subject_id', '=', 'subjects.id')
            ->leftjoin('course_day', 'courses.id', '=', 'course_day.course_id')
            ->leftjoin('days', 'days.id', '=', 'course_day.day_id')
            ->leftjoin('users', 'users.id', '=', 'courses.user_id')
            ->leftjoin('locations', 'locations.id', '=', 'courses.location_id')
            // left join with advertisements table.
            ->leftjoin('advertisements', 'courses.id', '=', 'advertisements.course_id');

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
            'users.education_level',
            'advertisements.id as isAdvertised'
            )
            ->groupBy('courses.id')
            // if there exist an advertisement put it to the top if null last (priority advertisement first).
            ->orderByRaw('-advertisements.id DESC');

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

        if ($lat != 13.7384627 || $long != 100.5320457) {
            $query = $this->scopeDistance($query, $lat, $long);
        }
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
        $accepted_course = CourseRequester::all()->where('status', '=', 'Accepted')->pluck('course_id');
        $query_2 = $query_2->whereNotIn('courses.id', $accepted_course);
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
