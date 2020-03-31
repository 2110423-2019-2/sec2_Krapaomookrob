<?php

namespace App\Http\Controllers;
use App\CourseRequester;
use App\CourseStudent;
use App\Course;
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
            if ($req['status'] == 'Init' || $req['status'] == 'Pending'){
                $arr = [
                    'id' => $req->id,
                    'name' => User::find($req->requester_id)->name,
                    'courseId' => $req['course_id'],
                    'requesterId' => $req->requester_id
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
        $reqId = $request->input('id');
        $courseId = $request->input('courseId');
        $requesterId = $request->input('requesterId');

        // only one tutor can teach, change status of all previous request to init
        $previousRequests = CourseRequester::where('course_id','=',$courseId)
                                           ->where('id','!=',$reqId)
                                           ->update(['status' => 'Init']);
        
        // change request status
        CourseRequester::find($reqId)->update(['status' => 'Pending']);
    }

    public function deleteRequest(Request $request){
        $userId = auth()->user()->id;
        $course = Course::find($request->input('id'));
        
        // if user's id not match
        if ($course->user_id != $userId ){
            return response('Access denied', 401);
        }
        $res = Course::destroy($request->input('id'));
        return $res ? response("delete completed",200) : response("database entry not found",404);
    }

    // Static Methods 
    public static function confirmAcceptedRequest($courseId){
        // call this function when finish payment
        $name = auth()->user()->name;
        $title = "Request Declined";
        $message = $name.' has declined your request.';
        $requests = CourseRequester::where('course_id','=',$courseId)->get();
        foreach($requests as $rq){
            if ($rq->status != 'Declined' && $rq->requester_id != $courseId){
                $receiver_id = $rq->requester_id;
                $rq->update(['status'=>'Declined']);
                NotificationController::createNotification($receiver_id,$title,$message);
            }
        }

        CourseRequester::where('course_id','=',$courseId)->where('status','=','Pending')->update(['status' => 'Accepted']);
        $title = "Request Accepted";
        $message = $name.' has accepted your request.';
        $receiver_id = CourseRequester::where('course_id','=',$courseId)->where('status','=','Accepted')->get()->first()->requester_id;
        NotificationController::createNotification($receiver_id,$title,$message);
        return null;
    }

    public static function removeRequest($courseId){
        CourseRequester::where('course_id','=',$courseId)
                     ->where('status','=','Pending')
                     ->update(['status' => 'Init']);
    }
    
}
