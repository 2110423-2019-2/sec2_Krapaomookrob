<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;


class loggingController extends Controller{

    public function index($no){
        $user = auth()->user();
        if($user->isAdmin() || $user->isSuperuser()){
            return view('admin_log')->with('l',$no);
        }
        else{
            return response('Access denied', 401);
        }
    }

    public function getAllVeritiedReport(Request $request){
        $user = auth()->user();
        if($user->isAdmin() || $user->isSuperuser()){
            $report = DB::table('reports')->orderBy('id','ASC')->get();
            return response($report,200);
        }
        else{
            return response('Access denied', 401);
        }
    }

    public function getAllPaymentLog(Request $request){
        $user = auth()->user();
        if($user->isAdmin() || $user->isSuperuser()){
            $report = DB::table('payments')->orderBy('id','ASC')->get();
            return response($report,200);
        }
        else{
            return response('Access denied', 401);
        }
    }

    public function getAllPostponement(Request $request){
        $user = auth()->user();
        if($user->isAdmin() || $user->isSuperuser()){
            $report = DB::table('course_classes')->where('status', 'Postponed')->orderBy('id','ASC')->get();
            return response($report,200);
        }
        else{
            return response('Access denied', 401);
        }
    }

    public function getAllUserInfo(Request $request){
        $user = auth()->user();
        if($user->isAdmin() || $user->isSuperuser()){
            $report = DB::table('users')->orderBy('id','ASC')->get();
            return response($report,200);
        }
        else{
            return response('Access denied', 401);
        }
    }
}
