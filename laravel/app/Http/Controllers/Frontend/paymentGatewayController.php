<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

use App\Payment;
use App\course;
use App\Cart;
use App\User;
use App\CourseStudent;
use App\PaymentRequest;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Cookie;
use App\BankAccount;
use App\OmiseRecipientAccount;
use App\Http\Controllers\NotificationController;

require_once dirname(__FILE__).'/../../../../vendor/autoload.php';

use OmiseCharge;
use OmiseTransfer;
use OmiseSource;
use OmiseRecipient;
define('OMISE_API_VERSION' , env("OMISE_API_VERSION", null));
define('OMISE_PUBLIC_KEY' , env("OMISE_PUBLIC_KEY", null));
define('OMISE_SECRET_KEY', env("OMISE_SECRET_KEY", null));

class paymentGatewayController extends Controller{

    public function cartToPayment(Request $request){
        //return 'xxx';
        //$course1 = array(1,2,3);
        //check course that isnt taken

        foreach ($request->input('course_id') as $value)
        //foreach ($course1 as $value)
        {
            if($value == null) return abort(406);
            $courseStudent = CourseStudent::find($value);
            if($courseStudent != null && $courseStudent->status == 'registered'){
                 return abort(406,'Some course is taken.');
            }
        }
        //create payment
        $payment = Payment::create([
            'user_id' => auth()->user()->id
            //'user_id' => 1
        ]);
        //count price + create cart
        $totalprice = 0;
        foreach ($request->input('course_id') as $value)
        //foreach ($course1 as $value)
        {
            $totalprice = $totalprice + (Course::find($value))->price;
            //dd($totalprice);
            Cart::create([
                'payment_id' => $payment->id,
                'course_id' =>  $value
            ]);
        }
/*
        $pay = [
            'payment_id' => $payment->id,
            'totalprice' => $totalprice
        ];
        */
        $cookie = Cookie::forget(CartController::getUserCart(auth()->user()->id,$request)[0]);
        return response()->json([
                'payment_id' => $payment->id,
                'totalprice' => $totalprice
              ])->withCookie($cookie);
     //   return view('payment')->with('payment',$pay);

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
            $cart = Cart::select('course_id')
                        ->where('payment_id',$request->input('paymentID'))->get();
           // dd($cart);
            foreach ($cart as $value) {
               // dd($value);
               auth()->user()->registeredCourses()->attach(Course::find($value->course_id));

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
          $payment = Payment::find($request->input('paymentID'));
          $payment->charge_id = $charge['id'];
          $payment->save();

//        //pay destination
//        redirect to
//        dd($charge['authorize_uri']);
//        ->
           // dd($source['id']);
            return redirect($charge['authorize_uri']);

    }
    public function createTransferOmise(Request $request){
        $payReq = PaymentRequest::find($request->input('paymentReqID'));
        if($payReq['omise_id']!=null){
            return response('Request ID ' . $payReq['id'] . ' is already transfer' , 403);
        }
        $user = User::find($payReq['requested_by']);
        $money = $payReq['amount'];
        $recipient1 = OmiseRecipientAccount::where('user_id',$payReq['requested_by'])->count();

        if($recipient1==0){
            $bank = BankAccount::find($payReq['bank_account']);
            $rec1 = OmiseRecipient::create(array('name'     => $user['name'],
                                                  'description'   => '',
                                                  'email'         => $user['email'],
                                                  'type'          => 'individual',
                                                  'bank_account'  => array( 'brand'   => $bank['bank'],
                                                                            'number'  => $bank['account_number'],
                                                                            'name'    => $bank['account_name'])));
            OmiseRecipientAccount::create([
                'user_id' => $user['id'],
               'recipient' => $rec1['id']
            ]);

        }
        $recipient1 = OmiseRecipientAccount::where('user_id',$payReq['requested_by'])->get();

        $transfer = OmiseTransfer::create(array(
            'amount' => $money*100,
            'recipient' => $recipient1[0]['recipient']
        ),OMISE_PUBLIC_KEY,OMISE_SECRET_KEY);
        //update transfer
        $payReq->omise_id = $transfer['id'];
        $payReq->transferred_by = auth()->user()->id;
        $payReq->save();

        $http = sprintf("https://dashboard.omise.co/test/transfers/%s",$transfer['id']);

        return response($http, 200);

    }

    public function checkTransfer(Request $request){

        // qeury data
        $arr1 =  PaymentRequest::where('status','!=', 'successful')->get();
        foreach($arr1 as $payReq){
            if($payReq['omise_id']==null) continue;

            $result = OmiseTransfer::retrieve($payReq['omise_id']);

            if($result['paid']){

                $payReq->status = "successful" ;
                $payReq->save();


                NotificationController::createNotification($payReq['requested_by'],'Transfer money',
                sprintf("money: %s to your account",$payReq['amount']));

            }
            else if($result['sent']){
                $payReq->status = "pending";
                $payReq->save();
            }

        }
        $arr =  PaymentRequest::where('status','!=', 'successful')->get();
        $data = response()->json($arr);
        // dd($data);
        return response($arr, 200);

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
           // $cart = Cart::select('payment_id',$paymentID);
            $cart = Cart::select('course_id')
                        ->where('payment_id',$paymentID)->get();


            foreach ($cart as $value) {

                   // 'user_id' => auth()->user()->id,
                   auth()->user()->registeredCourses()->attach(Course::find($value));

            }
            return view('dashboard')->with('alert','Successful');
        }
    }

    public function getPaymentPage($payment_id,$totalprice){
        return view('/payment', ['payment_id'=> $payment_id, 'totalprice' => $totalprice]);
    }

}
