<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use illuminate\Http\Response;

class PaymentInfoController extends Controller
{

    public function getInfoItem(Request $request){
        $paymentID = $request->input('pid');
        list($cartId, $res) = self::getUserCart(auth()->user()->id, $request);

        // if ($res != 'Success') return 'Error: create cart';
        $cartList =  Cart::where('payment_id',$paymentID)->get();

        $courses = array();
        // return $value;
            foreach($cartList as $item){
                    $course_id = $item['course_id'];
                    $course = CourseController::getCourseInfo(intval($course_id));
                    array_push($courses,$course);
                }


        return $courses ;
    }



}
