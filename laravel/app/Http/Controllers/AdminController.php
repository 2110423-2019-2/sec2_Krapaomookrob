<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    
    public function fetchAttendances(){
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
                                        GROUP BY timestamp, locations.name, student, tutor");
            return $attendances;
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
}
