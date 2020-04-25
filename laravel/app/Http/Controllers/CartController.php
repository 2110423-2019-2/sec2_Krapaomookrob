<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Course;
use App\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    const MAX = 1000000;
    const MIN = 0;
    const MINUTES =180;         // cookie lifetime(minute)

    public function __construct()
    {
        $this->middleware('auth');
    }

    public static function getUserCart($uid, $request){
        $cartId = null;
        $hasCart = false;
        if(!Cookie::has('cart'.$uid)){
            $cartId = rand(self::MIN,self::MAX);
            while(Cookie::has($cartId)){
                $cartId = rand(self::MIN,self::MAX);
            }
            $cookieCartId = cookie('cart'.strval($uid),$cartId, self::MINUTES);

        }else{
            $hasCart = True;
            $cartId = $request->cookie('cart'.strval($uid));
        }
        return [
            $cartId,
            $hasCart ? 'Success' : $cookieCartId
        ];
    }

    public function addToCart(Request $request){
    $hasCart = false;

        list($cartId, $res) = self::getUserCart(auth()->user()->id, $request);

        if ($res== 'Success') $hasCart=true;


        if(Cookie::has($cartId)){
            $value = $request->cookie($cartId);
            $items = explode(',', substr($value,0,-1));
            $cid = strval($request->input('course_id'));

            $key = array_search($cid,$items);
            if (!in_array($cid,$items)){
                $value .= strval($request->input('course_id')).',';
            }

        }else{
            $value = $request->input('course_id').',';
        }

        $cookie = cookie($cartId, $value, self::MINUTES);

        return $hasCart ? response(200)->withCookie($cookie) : response(200)->withCookie($res)->withCookie($cookie);
    }

    public function getCartItem(Request $request){

        list($cartId, $res) = self::getUserCart(auth()->user()->id, $request);

        // if ($res != 'Success') return 'Error: create cart';

        $value = $request->cookie($cartId);
        $courses = array();
        $totalPrice = 0;
        $cartString = null;
        // return $value;
        if ($value != null || $value != ''){
            $cartString = substr($value,0,-1);
            $items = explode(',', $cartString);
            foreach($items as $course_id){
                if ($course_id != null || $course_id != ''){
                    if(Course::find($course_id)->count()) continue;
                    $course = CourseController::getCourseInfo(intval($course_id));
                    array_push($courses,$course);
                    $totalPrice += $course['price'];
                }
            }
        }
        return [
            'info' => $courses,
            'totalPrice' => $totalPrice,
            'cartString' => $cartString
        ];
    }

    public function removeFromCart(Request $request){

        list($cartId, $res) = self::getUserCart(auth()->user()->id, $request);

        $value = $request->cookie($cartId);
        $items = explode(',', substr($value,0,-1));
        $cid = strval($request->input('course_id'));
        $key = array_search($cid,$items);
        if(in_array($cid,$items) ){
            unset($items[$key]);
        }

        // remove accept status
        if ( Course::find($request->input('course_id'))->isMadeByStudent() ){
            CourseRequesterController::removeRequest($request->input('course_id'));
        }

        $value = (join(',',$items).',' == ',') ? "":join(',',$items).',';
        $cookie = cookie($cartId, $value, self::MINUTES);
        return response(200)->cookie($cookie);
    }

    public function getCurrentCart(Request $request){
        list($cartId, $res) = self::getUserCart(auth()->user()->id, $request);
        $cart = $request->cookie($cartId);  // eg. cart = 1,2,3,
        $cart = substr($cart,0,-1);
        $cartArray = array_map('intval',explode(',',$cart));
        return $cartArray;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $course_ids = $request->cookie('course_ids');

        $payment = Payment::create([
            'user_id' => auth()->user()->id,

        ]);

        foreach ($course_ids as $course_id) {
            Cart::create([
                'payment_id' => $payment->id,
                'course_id' => $course_id
            ]);
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }

}
