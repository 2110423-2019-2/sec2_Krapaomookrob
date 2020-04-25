<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\User;
use App\course;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    //
     public static function createAdvertisement($courseId,$userId) {
        // dd($request);
        $user = User::find($userId);
        $course = Course::find($courseId);
        if($course==null || $course->user_id != $userId){
            return false;
        }
        if (!Advertisement::where('course_id','=',$courseId)->get()->isEmpty()){
            // already ad
            return true;
        }
        if (!$user->isTutor()){
            return false;
        }
        $userId = $user->id;
        $courseId = $courseId;
        $status = Advertisement::create([
            'course_id' => $courseId,
            'user_id' => $userId
        ]);
        return true;    // success
    }
}
