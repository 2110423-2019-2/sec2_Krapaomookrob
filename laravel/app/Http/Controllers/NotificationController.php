<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //
    public function getNotification(Request $request) {
        
        $user_id = $request->user()->id;

        $notifications = Notification::select('message','status','created_at')->where('receiver_id','=',$user_id)->get()->all();

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
}
