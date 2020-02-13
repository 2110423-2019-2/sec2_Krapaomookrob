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

Route::get('/', function () {
    return view('dashboard', ['user' => auth()->user()]);
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


Route::get('/payment', function () {
    return view('payment');
});

//post to payment
Route::post('/card', 'Frontend\paymentGatewayController@chargeCard');
Route::post('/internet', 'Frontend\paymentGatewayController@checkout');
//want to sourceID to result by using controller
Route::get('/result/{paymentID}', 'Frontend\paymentGatewayController@returnPage');