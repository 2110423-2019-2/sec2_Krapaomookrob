<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

//use App\Http\Controllers\omisePhp\lib\omise\OmiseCharge as omc;
require_once (__DIR__ .'\omisePhp\lib\Omise.php');
use OmiseCharge;
use OmiseTransfer;
use OmiseSource;

define('OMISE_API_VERSION' , env("API_VERSION", "somedefaultvalue"));
define('OMISE_PUBLIC_KEY' ,env("PUBLIC_KEY", "somedefaultvalue") );
define('OMISE_SECRET_KEY',env("SECRET_KEY", "somedefaultvalue")  );

class paymentGatewayController extends Controller{
    
    public function chargeCard(Request $request){
        $charge = OmiseCharge::create(array('amount'      => 100000,
                                            'currency'    => 'thb',
                                            'description' => 'Order-384',
                                            'ip'          => '127.0.0.1',
                                            'card'        => $request->input('omiseToken')),OMISE_PUBLIC_KEY,OMISE_SECRET_KEY);
        if($charge['status'] == 'failed'){
            //alert("failure");
            return view('dashboard');
         }
        else{
            //checkCourse();
            return view('result');
        }

    }

    public function checkout(Request $request){
        $source = OmiseSource::create(array(
            'type'     => $request->input('internet_bnk'),
            'amount'   => 15000,
            'currency' => 'thb'
        ),OMISE_PUBLIC_KEY,OMISE_SECRET_KEY);

        $charge = OmiseCharge::create(array(
            'amount' => 15000,
            'currency' => 'thb',
            'return_uri' => 'http://www.example.com',
            'source' => $source['id']
          ),OMISE_PUBLIC_KEY,OMISE_SECRET_KEY);

        //pay destination
        dd($charge['authorize_uri']);

        //Charge status. One of failed, expired, pending, reversed or successful.

        /*if($charge['status'] == 'failed'){
            //alert("failure");
            return view('dashboard');
         }
        else{
            //checkCourse();
            return view('result');
        }*/


    }
    public function tutorGetPaid(){
        $transfer = OmiseTransfer::create(array('amount' => 100000),OMISE_PUBLIC_KEY,OMISE_SECRET_KEY);
    }

}
