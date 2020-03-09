<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\PaymentRequest;

class PaymentRequestController extends Controller
{
    public function create(Request $request){
        /** 
         * Mock up balance
         */
        $balance = 25000;

        $validatedData = $request->validate([
            'amount' => 'required|integer|between:1,' . $balance,
        ]);

        PaymentRequest::create([
            'amount' => $request->amount,
            'requested_by' => auth()->user()->id,
            'bank_account' => auth()->user()->BankAccount->id
        ]);

        return response("Create payment request successfully.",200);
    }

    public function getMyRequests(){
        return response(auth()->user()->requestPaymentRequests()->orderBy('created_at','DESC')->get(), 200);
    }

    public function getInitRequests(){
        return response(Paymment::where('status', '=', 'init'), 200);
    }
}
