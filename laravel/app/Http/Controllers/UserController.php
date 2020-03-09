<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\BankAccount;

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
        $account_number = ($user -> BankAccount)?$user -> BankAccount-> account_number:"-";
        $account_name = ($user -> BankAccount)?$user -> BankAccount -> account_name:"-";
        $bank = ($user -> BankAccount)?$user -> BankAccount -> bank:"-";

        return view('profile.view',compact('user','phone','education_level','nickname','username','role','email','password',
                                            'account_number', 'account_name', 'bank'));
    }

    public function viewTutorProfile(User $user){

        $role = ($user -> role)?($user -> role):"-";
        $username = ($user -> name)?($user -> name):"-";
        $phone = ($user -> phone)?($user -> phone):"-";
        $education_level = ($user -> education_level)?($user -> education_level):"-"; 
        $nickname = ($user -> nickname)?($user -> nickname):"-"; 
        $email = ($user -> email)?($user -> email):"-";
        $account_number = ($user -> BankAccount)?$user -> BankAccount-> account_number:"-";
        $account_name = ($user -> BankAccount)?$user -> BankAccount -> account_name:"-";
        $bank = ($user -> BankAccount)?$user -> BankAccount -> bank:"-";

        return view('profile.tutor',compact('user','phone','education_level','nickname','username','role','email','account_number', 'account_name', 'bank'));
    }

    public function editProfile(User $user){
        $user = auth() -> user();
        $password = str_repeat("*",strlen($user -> password));
        $account_number = ($user -> BankAccount)?$user -> BankAccount-> account_number:"";
        $account_name = ($user -> BankAccount)?$user -> BankAccount -> account_name:"";
        $bank = ($user -> BankAccount)?$user -> BankAccount -> bank:"";
        return view('profile.edit',compact('user','password','account_number', 'account_name', 'bank'));
    }

    public function updateProfile(User $user){
        $user=  auth() -> user();
        $data = request()->validate([
            'role' => '',
            'name' => '',
            'phone' => 'size:10',
            'education_level' => '',
            'nickname' => '',
            'email' => '',
            'image' => '',
            'account_number' => '',
            'account_name' => '',
            'bank' => '',
            //'account_number', 'account_name', 'bank', 'user_id'
        ]);
        $user -> update($data);
        $bank = BankAccount::updateOrCreate(
            [
                'user_id' => $user->id
            ] ,
            [
            'account_number' => $data['account_number'],
            'account_name' => $data['account_name'],
            'bank' => $data['bank'],
            ]);
        return redirect("/profile");
    }

    public function getRole(){
        return  response(auth()->user()->role, 200);
    }

    public function getBankAccount(){
        $ba = auth()->user()->BankAccount;
        return response($ba, 200);
    }
}
