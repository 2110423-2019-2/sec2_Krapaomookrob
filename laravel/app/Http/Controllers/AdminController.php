<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function fetchUsers(){
        // if (auth()->user()->can('verifyUser')){
            $users = DB::table('users')->get();
            return $users;
        // }
    }

    public function fetchAdmins(){
        // if (auth()->user()->can('verifyUser')){
            $admins = DB::table('users')->where('role','=','admin')->orWhere('role','=','superuser')->get();
            return $admins;
        // }
    }
    
    public function fetchAttendanceLogs(){
        // if (auth()->user()->can('???????????')){
            $attendances = DB::select("SELECT attendances.updated_at AS timestamp, GROUP_CONCAT(DISTINCT subjects.name SEPARATOR ', ') AS subject,
                                            locations.name AS location, u1.name AS tutor, u2.name AS student 
                                        FROM attendances
                                        LEFT JOIN course_classes ON attendances.course_classes_id = course_classes.id
                                        LEFT JOIN courses ON courses.id = course_classes.course_id
                                        LEFT JOIN locations ON locations.id = courses.location_id
                                        LEFT JOIN users u1 ON u1.id = courses.user_id
                                        LEFT JOIN users u2 ON u2.id = attendances.user_id
                                        LEFT JOIN course_subject on course_subject.course_id = courses.id
                                        LEFT JOIN subjects on subjects.id = course_subject.subject_id
                                        GROUP BY timestamp, locations.name, student, tutor
                                        ORDER BY timestamp DESC");
            return $attendances;
        // }
    }

    public function fetchCourseLogs(){
        // if (auth()->user()->can('???????????')){
            $course_logs = DB::select("SELECT loggings.created_at AS timestamp, loggings.level,
                                        GROUP_CONCAT(DISTINCT subjects.name SEPARATOR ', ') AS subject,
                                        locations.name as location, users.name as user, loggings.action as action
                                        FROM loggings
                                        LEFT JOIN courses ON courses.id = loggings.course_id
                                        LEFT JOIN locations ON locations.id = courses.location_id
                                        LEFT JOIN users ON users.id = courses.user_id
                                        LEFT JOIN course_subject on course_subject.course_id = courses.id
                                        LEFT JOIN subjects on subjects.id = course_subject.subject_id
                                        GROUP BY timestamp, locations.name, users.name, loggings.action
                                        ORDER BY timestamp DESC");
            return $course_logs;
        // }
    }

    public function promoteAdmin($email){
        // if (auth()->user()->can('assignAdmin')){
            $user = DB::table('users')->where('email','=',$email)->update(['role' => 'admin']);
            return $user;
        // }
    }

    public function demoteAdmin($email){
        // if (auth()->user()->can('assignAdmin')){
            $user = DB::table('users')->where('email','=',$email)->update(['role' => null]);
            return $user;
        // }
    }

    public function suspend($id){ 
        $user = DB::table('users')->where('id','=',$id)->first();
        $is_suspended = $user->is_suspended;
        if ($is_suspended == 0){
            $this->suspendUser($id);
            return 1;
        } else {
            $this->unsuspendUser($id);
            return 0;
        }
    }

    public function suspendUser($id){ 
        $user = DB::table('users')->where('id','=',$id)->update(['is_suspended' => '1']);
        return $user;
    }

    public function unsuspendUser($id){ 
        $user = DB::table('users')->where('id','=',$id)->update(['is_suspended' => '0']);
        return $user;
    }

    public function getReports(){
        //$reports = DB::table('reports')->join('users','reports.sender_id','=','users.id')->get();
        $reports = DB::table('users')->join('reports','reports.sender_id','=','users.id')->get();
        // dd($reports);
        return $reports;
    }

    public function readReport($id){
        $report = DB::table('reports')->where('id','=',$id)->update(['status' => 'read']);
        return $report;
    }

    public function getRefundRequestPage() {
        if (auth()->user()->isAdmin() | auth()->user()->isSuperuser()) return view('admin_refund_request');
        abort(401, "User can't perform this actions");
    }
}
