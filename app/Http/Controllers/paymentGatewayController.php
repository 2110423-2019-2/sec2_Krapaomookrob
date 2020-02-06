<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
require_once (__DIR__ .'\omise-php\lib\Omise.php');

class paymentGatewayController extends Controller{
    
    public function checkout(){
        dd('xxx');
//            $charge = OmiseCharge::create(array(
//                'amount' => 10025,
//                'currency' => 'thb',
//                'card' => $_POST["omiseToken"]
//        ),$_ENV['PUBLIC_KEY'],$_ENV['SECRET_KEY']);
//        define('OMISE_API_VERSION' , $_ENV['API_VERSION']);
//        define('OMISE_PUBLIC_KEY' , $_ENV['PUBLIC_KEY']);
//        define('OMISE_SECRET_KEY',  $_ENV['SECRET_KEY']);
//
//        

//        echo('<pre>');
//        print_r($_POST);
//        echo('</pre>');
//        if($charge['status'] == 'Success'){
//            return view('result');
//        }
//        else{
//            return view('payment');
//        }
//        
    }
    public function tutorGetPaid(){
        
    }
    
}