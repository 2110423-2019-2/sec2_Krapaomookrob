<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

//use App\Http\Controllers\omisePhp\lib\omise\OmiseCharge as omc;
require_once (__DIR__ .'\omisePhp\lib\Omise.php');
use OmiseCharge;
use ChargeTest;
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
        if($charge['status'] == 'Success'){
            //checkCourse();
            return view('result');
         }
        else{
            //alert("failure");
            return view('dashboard');
        }
        
    }
    
    public function checkout(Request $request){
       //dd('xxx');
        //dd($request);
        
        //$omise = new Omise();
//        $charge = OmiseCharge::create(array(
//                'amount' => 10025,
//                'currency' => 'thb',
//                'card' => 'tokn_test_5iu8odxzio3t12f6irs'
//        ));
//        
        $data = [
          'dascription' =>'order1',
            'amount' => 10025,
            'currency' => 'thb',
            'offsite' => 'internet_banking_scb',
            'return_uri' => 'https://www.omise.co/example_return_uri'
        ];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.omise.co/charges",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data
//            CURLOPT_HTTPHEADER => array(
//                // Set here requred headers
//                "authorization: Basic c2tleV90ZXNOXzU1ajkwanQybX1qOtZnY2UxaG86Og==",
//                "cache-control: no-cache",
//                "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
//                )
        ));
        
        
        $response = curl_exec($curl);
        
        $err = curl_error($curl);
        dd($err);
        curl_close($curl);

        if ($err) {
            throw new Exception($err);
        } else {
            $json = json_decode($response);
            echo Html::a('ชำระเงิน', $json->authorize_uri,['class' =>'btn btn-success']);
        }
//        echo('<pre>');
//        print_r($_POST);
//        echo('</pre>');
//        if($request->has('internet_banking_scb')){
//            return view('banking');
//        }
//        else{
//            return view('result');
//        }
//        
        
    }
    public function tutorGetPaid(){
        
    }
    
}