<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use illuminate\Http\Response;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
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
                'payment_id' => $payment->user_id,
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

    public function setCookie(Request $request)
    {
        $minute = 60;
        $response = new Response('Set Cookie');
        $response->withCookie(cookie('','',''));
        return $response;
    }

    public function getCookie(Request $request)
    {
        return $request->cookie('');
    }


}
