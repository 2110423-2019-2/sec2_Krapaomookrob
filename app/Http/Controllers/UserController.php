<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UserController extends Controller
{
    public function __construct()
    {
    }
    
    public function updateRole(Request $request){
        $user = auth()->user();
        $user->role = $request->role;
        $user->save();
        return redirect('/');
    }

    public function viewProfile(User $user){
        return view('profile.view',compact('user'));
    }

    public function editProfile(User $user){
        return view('profile.edit',compact('user'));
    }

    public function updateProfile(User $user){
        return view('profile.update',compact('user'));
    }
}
