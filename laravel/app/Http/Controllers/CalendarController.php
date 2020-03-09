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
      $user = Auth::user();
      $colors = ['blue', 'indigo', 'deep-purple', 'cyan', 'green', 'orange', 'grey darken-1'];
      $result = collect();
      $classes = collect();
      if($user->isTutor()){
        $classes = DB::select('select courses.id,classes.date,classes.time,classes.hours,users.nickname from course_classes classes
                                inner join courses on classes.course_id = courses.id
                                inner join course_student student on classes.id = student.course_id
                                left join users on student.user_id = users.id
                                where courses.user_id = ? and student.status = ?', [$user->id, 'registered']);
        //{"date":"2021-02-18","time":"13:00:00","hours":1,"nickname":"Somsak"}
        //{"name":"Holiday","start":"2020-3-5 7:45","end":"2020-3-5 8:30","color":"indigo"}
        foreach($classes as $class){
          $nTime = Carbon::parse("{$class->date} {$class->time}")->addHour($class->hours);
          $temp = collect([
            'course_id' => $class->id,
            'name' => "N'{$class->nickname}",
            'start' => "{$class->date} {$class->time}",
            'end' => $nTime->toDateTimeString(),
            'color' => $colors[$class->id%7]
          ]);
          $result->push($temp);
        }
      }else{
        $classes = DB::select('select courses.id,classes.date,classes.time,classes.hours,users.nickname from course_classes classes
                                inner join courses on classes.course_id = courses.id
                                inner join course_student student on classes.id = student.course_id
                                left join users on courses.user_id = users.id
                                where student.user_id = ? and student.status = ?', [$user->id, 'registered']);
        foreach($classes as $class){
          $nTime = Carbon::parse("{$class->date} {$class->time}")->addHour($class->hours);
          $temp = collect([
            'course_id' => $class->id,
            'name' => "P'{$class->nickname}",
            'start' => "{$class->date} {$class->time}",
            'end' => $nTime->toDateTimeString(),
            'color' => $colors[$class->id%7]
          ]);
          $result->push($temp);
        }
      }
      return response()->json($result->toArray());
    }

}
