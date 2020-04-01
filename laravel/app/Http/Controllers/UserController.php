<?php

namespace App\Http\Controllers;

use App\Advertisement;
use Illuminate\Http\Request;

use App\User;
use App\BankAccount;
use App\Course;
use App\Transaction;
use App\Report;
use App\Http\Controllers\ReviewController;
use Intervention\Image\Facades\Image;

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
        if($user -> isTutor()){
            $rating = ReviewController::getRating($user -> id);
            $reviews = ReviewController::getReviews($user -> id);
            $reviewsWithSubjects = [];
            foreach ($reviews as $review){
                $course = Course::find($review->course_id);
                $subjects = $course->subjects->pluck('name');
                array_push($reviewsWithSubjects,(object) ['review' => $review,'subjects'=>$subjects]);
            }
            $hasAds = false;
            return view('profile.tutor_view',compact('user','phone','education_level','nickname','username','role','email','password',
            'account_number', 'account_name', 'bank', 'rating', 'reviewsWithSubjects','hasAds'));
        }
        else if($user -> isStudent()){
            return view('profile.view',compact('user','phone','education_level','nickname','username','role','email','password',
                                            'account_number', 'account_name', 'bank'));
        }
    }

    public function viewTutorProfile(User $user){
        if($user -> isTutor()){
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
            $reviewsWithSubjects = [];
            foreach ($reviews as $review){
                $course = Course::find($review->course_id);
                $subjects = $course->subjects->pluck('name');
                array_push($reviewsWithSubjects,(object) ['review' => $review,'subjects'=>$subjects]);
            }
            return view('profile.tutor',compact('user','phone','education_level','nickname','username','role','email','account_number', 'account_name', 'bank','rating','reviewsWithSubjects'));
        }
        else if($user -> isStudent()){
            return redirect('/');
        }
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
        $data = request()->validate([ //need to workout the validation
            'role' => '',
            'name' => '',
            'phone' => '',
            'education_level' => '',
            'nickname' => '',
            'email' => '',
            'image' => '',
            'account_number' => '',
            'account_name' => '',
            'bank' => '',
        ]);
        // dd($data);
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

            // Schema::create('bank_accounts', function (Blueprint $table) {
            //     $table->bigIncrements('id');
            //     $table->string('account_number');
            //     $table->string('account_name');
            //     $table->string('bank');
            //     $table->unsignedBigInteger('user_id');
            //     $table->timestamps();
            //     $table->foreign('user_id')->references('id')->on('users');
            // });

        // Schema::create('advertisements', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->timestamps();
        //     $table->foreign('tutor_id')->references('id')->on('users');
        //     $table->string('image');
        // });

        if(request('image') && $user -> isTutor())
        {
            $imagePath = request('image') -> store('profile', 'public');
            $image = Image::make(public_path("storage/{$imagePath}")) -> fit(1200,1200);
            $image -> save();
            $advertisement = Advertisement::updateOrCreate(
                [
                    'tutor_id' => $user->id
                ],
                [
                    'image' => $data['image']
                ]
            );
            
        }
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
