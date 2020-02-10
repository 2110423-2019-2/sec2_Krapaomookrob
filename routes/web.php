<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/payment', function () {
    return view('payment');
});
//Login for developers

Route::get('/login-dev/{id}', 'Auth\LoginController@loginDeveloper');

//Login View

Route::get('/login', function () {
    return view('login');
});
Route::get('/user-role', function () {
    if (Gate::allows('update-role')) return view('user_role');
    abort(403, 'Unauthorized action.');
});

//Login API

Route::get('/logout', 'Auth\LoginController@logout');
Route::prefix('login')->group(function () {
    Route::get('/{provider}', 'Auth\LoginController@redirectToProvider')->name('login.provider');
    Route::get('/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('login.provider.callback');
});
Route::post('/user-role', 'UserController@updateRole');


//post to payment
Route::post('/card', 'Frontend\paymentGatewayController@chargeCard');
Route::post('/internet', 'Frontend\paymentGatewayController@checkout');
//Route::post('/internet', function(Request $request){
//        if($_POST["internet_bnk"]!=NULL){
//            $bnk = $_POST["internet_bnk"];
//            Route::get('/{bnk}',function(){
//               return view('banking'); 
//            });
//        }
//        else{
//            return view('result');
//        }
//
//});
////ex post of credit card
//(
//    [_token] => dKD00CjEy1f9mzaAQRwvCZZ9fCnuQ0KO03nErMmf
//    [omiseToken] => tokn_test_5iu8odxzio3t12f6irs
//    [omiseSource] => 
//)
