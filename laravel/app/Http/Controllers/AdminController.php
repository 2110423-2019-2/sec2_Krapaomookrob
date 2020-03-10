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

    public function getAllReports(){
        
    }
}
