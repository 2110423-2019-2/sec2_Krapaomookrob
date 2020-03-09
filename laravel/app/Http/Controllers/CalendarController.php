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
use App\User;
use App\Course_subject;
use App\Course_day;
use App\CourseStudent;
use App\CourseClass;

class CalendarController extends Controller
{
    public function getMyClasses(){
      //ENUM('registered', 'refunding', 'cancelled')
      $user = Auth::user();
      $classes = collect();
      if($user->isTutor()){
        foreach ($user->classes as $class){
          $students = $class->course->students;
          echo $students;
          if($class->course->students->count() > 0){
            //->only(['date', 'time','hours','course_id'])
            $classes->push($class);
          }
        }
        return $classes[0];
        return response()->json($classes,200);
      }else{

      }
    }

    public function fetchSubjects(){
        $days = Subject::all()->pluck('name');
        return $days;
    }
}
