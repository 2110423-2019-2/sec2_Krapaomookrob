<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function getMyClasses(){
      $user = Auth::user();
      $colors = ['blue', 'indigo', 'deep-purple', 'cyan', 'green', 'orange', 'grey darken-1'];
      $result = collect();
      $classes = collect();
      if($user->isTutor()){
        $classes = DB::select('select classes.id as clid,courses.id as coid,classes.date,classes.time,classes.hours,users.nickname from course_classes classes
                                inner join courses on classes.course_id = courses.id
                                inner join course_student student on classes.id = student.course_id
                                left join users on student.user_id = users.id
                                where courses.user_id = ? and student.status = ?', [$user->id, 'registered']);
        //{"date":"2021-02-18","time":"13:00:00","hours":1,"nickname":"Somsak"}
        //{"name":"Holiday","start":"2020-3-5 7:45","end":"2020-3-5 8:30","color":"indigo"}
        foreach($classes as $class){
          $nTime = Carbon::parse("{$class->date} {$class->time}")->addHour($class->hours);
          $temp = collect([
            'class_id' => $class->clid,
            'course_id' => $class->coid,
            'name' => "N'{$class->nickname}",
            'start' => "{$class->date} {$class->time}",
            'end' => $nTime->toDateTimeString(),
            'color' => $colors[$class->coid%7],

            // for display in calendar's card
            'time' => date_format(date_create($class->time), 'H:i') . ' - ' . date_format(date_create($nTime), 'H:i'),
            'location' => $class->location,
            'postponable' => !($class->status==='Postponed' || $class->date < date("Y-m-d"))
          ]);
          $result->push($temp);
        }
      }else{
        $classes = DB::select('select classes.id as clid,courses.id as coid,classes.date,classes.time,classes.hours,users.nickname,locations.name as location,classes.status from course_classes classes
                                inner join courses on classes.course_id = courses.id
                                inner join course_student student on classes.id = student.course_id
                                inner join locations on locations.id = courses.location_id
                                left join users on courses.user_id = users.id
                                where student.user_id = ? and student.status = ?', [$user->id, 'registered']);
        foreach($classes as $class){
          $nTime = Carbon::parse("{$class->date} {$class->time}")->addHour($class->hours);
          $temp = collect([
            'class_id' => $class->clid,
            'course_id' => $class->coid,
            'name' => "P'{$class->nickname}",
            'start' => "{$class->date} {$class->time}",
            'end' => $nTime->toDateTimeString(),
            'color' => $colors[$class->coid%7],
            
            // for display in calendar's card
            'time' => date_format(date_create($class->time), 'H:i') . ' - ' . date_format(date_create($nTime), 'H:i'),
            'location' => $class->location,
            'postponable' => !($class->status==='Postponed' || $class->date <= date("Y-m-d"))
          ]);
          $result->push($temp);
        }
      }
      return response()->json($result->toArray());
    }

}
