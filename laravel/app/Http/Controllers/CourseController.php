<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Day;
use App\Location;
use App\Subject;
use Auth;
use Carbon\Carbon;

use App\Course;
use App\User;
use App\Course_subject;
use App\Course_day;
use App\CourseStudent;

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

    public function cancelCourse(Request $request){
        $user_id = $request->user_id;
        $course_id = $request->course_id;
        $registeredCourse = CourseStudent::where('user_id', $user_id)->where('course_id', '=', $course_id)->first();
        $registeredCourse->status = 'refunding';
        $registeredCourse->save();
        return response($registeredCourse, 200);
    }

    public function getStatus(Request $request){
        $user_id = $request->user_id;
        $course_id = $request->course_id;
        $registeredCourse = CourseStudent::where('user_id', $user_id)->where('course_id', '=', $course_id)->first();
        return response($registeredCourse->status, 200);
    }
    
    public function myCoursesIndex(){
        $user = auth()->user();
        $courses;
        $classDateList = [];
        $nextClasses = [];
        $isFinished = [];
        $classesLeft = [];
        if($user->isStudent()){
            $courses = $user->registeredCourses()->with(['days', 'subjects'])->orderBy('startDate', 'DESC')->paginate(10)->onEachSide(1);
        }
        else if($user->isTutor()){
            $courses = Course::with(['days', 'subjects'])->where('user_id', auth()->user()->id)->orderBy('startDate', 'DESC')->paginate(10)->onEachSide(1);
        }
        foreach($courses as $course){
            $classes = $this->allClasses($course->startDate,  $course->days->pluck('name')->toArray(), $course->noClasses);
            array_push($classDateList, $classes[0]);
            array_push($nextClasses, $classes[1]);
            array_push($classesLeft, $classes[2]);
            $now = Carbon::now()->addHours(7);
            array_push($isFinished, end($classes[0])->lt($now));
        }
        return view('my_courses', ['courses' => $courses, 'classDateList' => $classDateList, 'nextClasses' => $nextClasses, 'isFinished' => $isFinished, 'classesLeft' => $classesLeft]);
    }

    private function allClasses($startDate, $weekDays, $noClasses){
        $weekMap = [
            'Sunday' => 0,
            'Monday' => 1,
            'Tuesday' => 2,
            'Wednesday' => 3,
            'Thursday' => 4,
            'Friday' => 5,
            'Saturday' => 6,
        ];
        $count = $noClasses;
        $now = new Carbon($startDate);
        $classDate = [];
        $currentTime = Carbon::now()->addHours(7);
        $nextClass = null;
        $classesLeft = 0;
        while($count != 0){
            $min = $now->copy()->addDays(8);
            foreach($weekDays as $weekDay){
                $t = $now->copy()->next($weekMap[$weekDay]);
                if($t->lt($min)){
                    $min = $t;
                }
            }
            array_push($classDate, $min);
            if($nextClass == null && $currentTime->lte($min)){
                $nextClass = $min;
                $classesLeft = $count;
            }
            $now = $min;
            $count = $count - 1;
        }
        return [$classDate, $nextClass, $classesLeft];
    }
    
 
}
