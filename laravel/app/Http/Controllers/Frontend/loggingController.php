<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;


class loggingController extends Controller{

    public function getAllVeritiedReport(Request $request){
        $report = DB::table('reports')->orderBy('id','DESC')->get();
        return response($report,200);
    }

    public function getAllPaymentLog(Request $request){
        $report = DB::table('payments')->orderBy('id','DESC')->get();
        return response($report,200);
    }

    public function getAllCourseCancellation(Request $request){
        $user = auth()->user();
        if($user->isAdmin() || $user->isSuperuser()){
            $report = DB::table('course_student')->where('status', 'refunding')->orWhere('status', 'cancelled')->orderBy('id','DESC')->get();
            return response($report,200);
        }
        else{
            return response('Access denied', 401);
        }
    }

    public function getAllPostponement(Request $request){
        $user = auth()->user();
        if($user->isAdmin() || $user->isSuperuser()){
            $report = DB::table('course_classes')->where('status', 'Postponed')->orderBy('id','DESC')->get();
            return response($report,200);
        }
        else{
            return response('Access denied', 401);
        }
    }
}
