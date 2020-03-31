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
}
