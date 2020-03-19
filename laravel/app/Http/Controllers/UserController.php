<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\BankAccount;
use App\Transaction;
use App\Report;
use App\Http\Controllers\ReviewController;

class UserController extends Controller
{
    public function __construct()
    {
        $this -> middleware('auth');
    }
    
    public function updateRole(Request $request){
        if(auth()->user()){
            $user = auth()->user();
            $user->role = $request->role;
            $user->save();
            return redirect('/');
        }
        abort(401, 'Login required');
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
        $rating = ReviewController::getRating($user -> id);
        $reviews = ReviewController::getReviews($user -> id);

        return view('profile.tutor',compact('user','phone','education_level','nickname','username','role','email','account_number', 'account_name', 'bank','rating','reviews'));
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
        if(auth()->user()){
            return  response(auth()->user()->role, 200);
        }
        abort(401, 'Login required');
    }

    public function sendReport(Request $request){
        //validation should be implemented in the future.
        Report::create([
            'sender_id' => auth()->user()->id,
            'title' => $request->title,
            'message' => $request->message,
        ]);
        return redirect('/');
    }

    public function getBankAccount(){
        if(auth()->user()){
            $ba = auth()->user()->BankAccount;
            return response($ba, 200);
        }
        abort(401, 'Login required');
    }
    
    public function getBalance(){
        if(auth()->user()){
            $user = auth()->user();
            return $user->balance;
        }
        abort(401, 'Login required');
    }


    public function addBalance($id,$amount){
        $user = User::findOrFail($id);
        if ($amount >= 0){
            $user->balance = $user->balance + $amount;
            $transaction = Transaction::create(['user_id' => $id, 'amount' => $amount, 'method' => 'add']);
            $user->save();
            return response('Add balance successfully.', 200);
        } else {
            return response('Invalid amount of money.', 400);
        }
    }

    public function withBalance($id,$amount){
        $user = User::findOrFail($id);
        if ($amount >= 0 && $user->balance >= $amount){
            $user->balance = $user->balance - $amount;
            $transaction = Transaction::create(['user_id' => $id, 'amount' => $amount, 'method' => 'withdraw']);
            $user->save();
            return response('Withdraw balance successfully.', 200);
        } else {
            return response('Not enough money or invalid amount of money.', 400);
        }
    }

    public function updateBalance(Request $request){
        $user = User::findOrFail($request->id);
        if ($request->method == "add"){
            $this->addBalance($request->id, $request->amount);
        } elseif ($request->method == "withdraw"){
            $this->withBalance($request->id, $request->amount);
        } else {
            return response('Invalid request method.', 400);
        }
    }
}
