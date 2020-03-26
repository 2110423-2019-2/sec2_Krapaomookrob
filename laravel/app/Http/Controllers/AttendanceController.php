<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;
use App\Attendance;

class AttendanceController extends Controller
{
    public function getClassesToday(){
      $user = Auth::user();
      $result = collect();
      $classes = collect();
      if($user->isTutor()){
        $classes = DB::select('select classes.id as clid,classes.date,courses.user_id as user_id,classes.time,classes.hours,users.nickname,attendances.checked from course_classes classes
                                inner join courses on classes.course_id = courses.id
                                inner join course_student student on courses.id = student.course_id
                                left join users on student.user_id = users.id
                                left join attendances on classes.id = attendances.course_classes_id and attendances.user_id = ?
                                where courses.user_id = ? and student.status = ? and classes.date= ?', [$user->id, $user->id, 'registered',Carbon::today()]);
        foreach($classes as $class){
          $nTime = Carbon::parse("{$class->date} {$class->time}")->addHour($class->hours);
          $temp = collect([
            'class_id' => $class->clid,
            'checked' => $class->checked,
            'user_id' => $class->user_id,
            'name' => "N'{$class->nickname}",
            'date' => Carbon::parse($class->date)->isoFormat('dddd, D MMM YYYY'),
            'time' => date_format(date_create($class->time),'H:i').'-'.date_format(date_create($nTime),'H:i').'('.$class->hours.'hrs)',
          ]);
          $result->push($temp);
        }
      }else{
        $classes = DB::select('select classes.id as clid,classes.date,student.user_id as user_id,classes.time,classes.hours,users.nickname,attendances.id as attendance_id,attendances.checked from course_classes classes
                                inner join courses on classes.course_id = courses.id
                                inner join course_student student on courses.id = student.course_id
                                left join users on courses.user_id = users.id
                                left join attendances on classes.id = attendances.course_classes_id and attendances.user_id = ?
                                where student.user_id = ? and student.status = ? and classes.date=?', [$user->id, $user->id, 'registered',Carbon::today()]);
        foreach($classes as $class){
          $nTime = Carbon::parse("{$class->date} {$class->time}")->addHour($class->hours);
          $temp = collect([
            'class_id' => $class->clid,
            'checked' => $class->checked,
            'user_id' => $class->user_id,
            'name' => "P'{$class->nickname}",
            'date' => Carbon::parse($class->date)->isoFormat('dddd, D MMM YYYY'),
            'time' => date_format(date_create($class->time),'H:i').'-'.date_format(date_create($nTime),'H:i').'('.$class->hours.'hrs)',
          ]);
          $result->push($temp);
        }
      }
      return response()->json($result->toArray());
    }

    public function checkClass(Request $request){
      $attendance = new Attendance;
      $attendance->course_classes_id = $request->class_id;
      $attendance->user_id = $request->user_id;
      $attendance->checked = true;
      $attendance->save();
      return $attendance;
    }

    public function getHistoryAttendances(){
      $user = Auth::user();
      $result = collect();
      $classes = collect();
      if($user->isTutor()){
        $classes = DB::select('select course_classes.date, course_classes.time, course_classes.hours, users.nickname from attendances
                                inner join course_classes on course_classes.id = attendances.course_classes_id
                                inner join courses on course_classes.course_id = courses.id
                                inner join course_student student on courses.id = student.course_id
                                left join users on student.user_id = users.id
                                where attendances.user_id = ?
                                order by course_classes.date desc, course_classes.time desc', [$user->id]);
        foreach($classes as $class){
          $nTime = Carbon::parse("{$class->date} {$class->time}")->addHour($class->hours);
          $temp = collect([
            'name' => "N'{$class->nickname}",
            'date' => Carbon::parse($class->date)->isoFormat('dddd, D MMM YYYY'),
            'time' => date_format(date_create($class->time),'H:i').'-'.date_format(date_create($nTime),'H:i').'('.$class->hours.'hrs)',
          ]);
          $result->push($temp);
        }
      }else{
        $classes = DB::select('select course_classes.date, course_classes.time, course_classes.hours, users.nickname from attendances
                                inner join course_classes on course_classes.id = attendances.course_classes_id
                                inner join courses on course_classes.course_id = courses.id
                                inner join course_student student on courses.id = student.course_id
                                left join users on courses.user_id = users.id
                                where attendances.user_id = ?
                                order by course_classes.date desc, course_classes.time desc', [$user->id]);
        foreach($classes as $class){
          $nTime = Carbon::parse("{$class->date} {$class->time}")->addHour($class->hours);
          $temp = collect([
            'name' => "P'{$class->nickname}",
            'date' => Carbon::parse($class->date)->isoFormat('dddd, D MMM YYYY'),
            'time' => date_format(date_create($class->time),'H:i').'-'.date_format(date_create($nTime),'H:i').'('.$class->hours.'hrs)',
          ]);
          $result->push($temp);
        }
      }

      return response()->json($result->toArray());
    }

}
