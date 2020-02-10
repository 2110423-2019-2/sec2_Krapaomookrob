<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this -> middleware('auth');
    }
    
    public function updateRole(Request $request){
        $user = auth()->user();
        $user->role = $request->role;
        $user->save();
        return redirect('/');
    }

    public function viewProfile(User $user){
        $user = auth() -> user();
        $role = ($user -> role)?($user -> role):"-";
        $username = ($user -> name)?($user -> name):"-";
        $phone = ($user -> phone)?($user -> phone):"-";
        $education_level = ($user -> education_level)?($user -> education_level):"-"; 
        $nickname = ($user -> nickname)?($user -> nickname):"-"; 
        $email = ($user -> email)?($user -> email):"-";
        $password = str_repeat("*",strlen($user -> password));

        return view('profile.view',compact('user','phone','education_level','nickname','username','role','email','password'));
    }

    public function editProfile(User $user){
        return view('profile.edit',compact('user'));
    }

    public function updateProfile(User $user){
        return view('profile.update',compact('user'));
    }
}
