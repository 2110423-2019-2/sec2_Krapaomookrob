<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\PaymentRequest;

class PaymentRequestController extends Controller
{
    
    public function tutorIndex(){
        if(auth()->user()->isTutor()) return view('tutor_payment_request');
        abort(401, "User can't perform this actions");
    }

    public function adminIndex(){
        if(auth()->user()->isAdmin() | auth()->user()->isSuperuser()) return view('admin_payment_request');
        abort(401, "User can't perform this actions");
    }
    
    public function create(Request $request){
        if(auth()->user()){
            $validatedData = $request->validate([
                'amount' => 'required|integer|min:1|max:' . auth()->user()->balance,
            ]);
    
            if(!auth()->user()->BankAccount){
                return response(['message' => 'You need to add bank account information.', 'errors' => ['bankAccount' => ['Bank account information is required']]] ,422);
            }
    
            PaymentRequest::create([
                'amount' => $request->amount,
                'requested_by' => auth()->user()->id,
                'bank_account' => auth()->user()->BankAccount->id
            ]);
            
            return response("Create payment request successfully.",200);
        }
        abort(401, "Login required");
    }

    public function getMyRequests(){
        if(auth()->user()){
            return response(auth()->user()->requestPaymentRequests()->orderBy('created_at','DESC')->get(), 200);
        }
        abort(401, "Login required");
    }
}
