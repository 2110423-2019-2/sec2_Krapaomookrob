<?php

namespace App\Http\Controllers;
use App\CourseRequester;
use App\User;

use Illuminate\Http\Request;

class CourseRequesterController extends Controller
{
    //
    public function getRequestFromTutor(Request $request){
        $userId = auth()->user()->id;
        $courseReq = CourseRequester::select('id','course_id','requester_id','status')->where('receiver_id','=', $userId)->get();
        $retVal = [];
        foreach($courseReq as $req){
            if ($req['status'] == 'Init'){
                $arr = [
                    'id' => $req->id,
                    'name' => User::find($req->requester_id)->name,
                    'courseId' => $req['course_id']
                ];
                array_push($retVal, $arr);
            }
        }
        return $retVal;
    }

    public function declineRequest(Request $request){
        $reqId = $request->input('id');
        CourseRequester::where('id','=',$reqId)->update(['status' => 'Declined']);
        $name = auth()->user()->name;
        $title = "Request Declined";
        $message = $name.' has declined your request.';
        $receiver_id = CourseRequester::find($reqId)->requester_id;
        NotificationController::createNotification($receiver_id,$title,$message);
    }

    public function acceptRequest(Request $request){
        // only one tutor can teach
        $name = auth()->user()->name;
        $title = "Request Declined";
        $message = $name.' has declined your request.';
        $requests = CourseRequester::where('course_id','=',$request->input('courseId'))->get();
        foreach($requests as $rq){
            if ($rq->status != 'Declined'){
                $receiver_id = $rq->requester_id;
                $rq->update(['status'=>'Declined']);
                NotificationController::createNotification($receiver_id,$title,$message);
            }
        }
        
        $reqId = $request->input('id');
        CourseRequester::find($reqId)->update(['status' => 'Accepted']);
        $title = "Request Accepted";
        $message = $name.' has accepted your request.';
        $receiver_id = CourseRequester::find($reqId)->requester_id;
        NotificationController::createNotification($receiver_id,$title,$message);
    }
    
}
