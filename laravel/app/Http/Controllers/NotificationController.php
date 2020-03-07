<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

use App\Course;
use App\CourseStudent;


class NotificationController extends Controller
{
    //

    public function getNotification(Request $request) {
        
        $user_id = $request->user()->id;

        $notifications = Notification::select('title','message','status','created_at')->where('receiver_id','=',$user_id)->get()->all();

        $numNewNoti = 0;
        $notiData = array();

        foreach($notifications as $notification){
            if ($notification->status == 'new'){
                $numNewNoti += 1;
            }
            array_push($notiData,$notification);
        }
        return [
            'numNewNoti' => $numNewNoti,
            'notifications' => $notiData
        ];
    }

    public static function createNotification($receiver_id, $title, $message){
        $newNoti = new Notification;
        $newNoti->receiver_id = $receiver_id;
        $newNoti->title = $title;
        $newNoti->message = $message;
        $newNoti->save();
    }

    public static function multiNotify($course_id, $title, $message){
        // notify everyone enrolled to the course

        $teacher_id = Course::where('id', $course_id)->first()->user_id;
        self::createNotification($teacher_id, $title, $message);
        
        $students = CourseStudent::where('course_id', $course_id)->pluck('user_id')->toArray();
        foreach($students as $student_id){
            self::createNotification($student_id, $title, $message);
        }

    }
}
