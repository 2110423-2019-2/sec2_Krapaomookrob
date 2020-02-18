<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Payment;

require_once dirname(__FILE__).'/../../../../vendor/autoload.php';

use OmiseCharge;
use OmiseTransfer;
use OmiseSource;

define('OMISE_API_VERSION' , env("API_VERSION", null));
define('OMISE_PUBLIC_KEY' , env("OMISE_PUBLIC_KEY", null));
define('OMISE_SECRET_KEY', env("OMISE_SECRET_KEY", null));

class paymentGatewayController extends Controller{

    public function cartToPayment(Request $request){
        //dd($request->input('course_id')[0]);
        //check course that isnt taken
        foreach ($request->input('course_id') as $value) {
            if(value == null) break;
            $courseStudent = User_student::find(value);
            if($courseStudent->status == 'registed'){
                 return abort(400,'Some course is taken.');
            }
        }
        //create payment
        $payment = Payment::create([
            'user_id' => auth()->user()->id
            //'user_id' => 1
        ]);
        //count price + create cart
        $totalprice = 0;
        foreach ($request->input('course_id') as $value) {
            $totalprice += Course::find($value)->price;
            $cart = Cart::create([
                'course_id' => $value,
                'payment_id' => $payment->id
            ]);
        }

        $pay = [
            'payment_id' => $payment->id,
            'totalprice' => $totalprice
        ];

        return view('payment')->with('payment',$pay);

    }

    public function chargeCard(Request $request){
        $charge = OmiseCharge::create(array('amount'      => $request->input('p'),
                                            'currency'    => 'thb',
                                            'description' => 'Order-384',
                                            'ip'          => '127.0.0.1',
                                            'card'        => $request->input('omiseToken')),OMISE_PUBLIC_KEY,OMISE_SECRET_KEY);

        $payment = Payment::find($request->input('paymentID'));
        $result = OmiseCharge::retrieve($charge['id']);
        $payment->charge_id = $charge['id'];
        $payment->status = $result['status'];
        $payment->save();
        if($charge['status'] == 'failed'){
            return view('dashboard')->with('error','Fail to pay');
         }
        else{
            //create taken course
            $cart = Cart::select('payment_id',$request->input('paymentID'));
            foreach ($cart as $value) {
                Course_student::create([
                    'user_id' => auth()->user()->id,
                    'status' => 'registed',
                    'course_id' => $value->course_id
                    //'user_id' => 1
                ]);
            }
            return view('dashboard')->with('alert','Successful');
        }

    }

    public function checkout(Request $request){
        $source = OmiseSource::create(array(
            'type'     => $request->input('internet_bnk'),
            'amount'   => $request->input('p'),
            'currency' => 'thb'
        ),OMISE_PUBLIC_KEY,OMISE_SECRET_KEY);


        $charge = OmiseCharge::create(array(
            'amount' => $request->input('p'),
            'currency' => 'thb',
            'return_uri' => url(sprintf("http://localhost:8000/result/%s",$request->input('paymentID'))),
            'source' => $source['id']
          ),OMISE_PUBLIC_KEY,OMISE_SECRET_KEY);
          $payment->charge_id = $charge['id'];
          $payment->save();

//        //pay destination
//        redirect to
//        dd($charge['authorize_uri']);
//        ->
           // dd($source['id']);
            return redirect($charge['authorize_uri']);

    }
    public function Paid(){
        $transfer = OmiseTransfer::create(array(
            'amount' => 100000
        ),OMISE_PUBLIC_KEY,OMISE_SECRET_KEY);


    }

    public function returnPage($paymentID){
        $payment = Payment::find($paymentID);


        //chage status in payment
        $result = OmiseCharge::retrieve($payment->charge_id);
        $payment->status = $result['status'];
        $payment->save();
        if($result['status'] == "failed"){
            return view('dashboard')->with('error','Fail to pay');
        }
        else{
            //create taken course
            $cart = Cart::select('payment_id',$request->input('paymentID'));
            foreach ($cart as $value) {
                Course_student::create([
                    'user_id' => auth()->user()->id,
                    'status' => 'registed',
                    'course_id' => $value->course_id
                    //'user_id' => 1
                ]);
            }
            return view('dashboard')->with('alert','Successful');
        }
    }

}
