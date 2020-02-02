<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
    }
    
    public function role(Request $request){
        $user = auth()->user();
        $user->role = $request->role;
        $user->save();
        return redirect('/');
    }
}
