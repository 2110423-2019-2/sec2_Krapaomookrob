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

use App\Http\Controllers\CourseController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/api/course/subjects','CourseController@fetchSubjects');
Route::get('/api/course/days','CourseController@fetchDays');
Route::post('/api/course/new','CourseController@newCourse');
Route::get('/new-course', function () {
    return view('new_course');
});

Route::get('/api/course/subjects','CourseController@fetchSubjects');
Route::get('/api/course/days','CourseController@fetchDays');
Route::post('/api/course/new','CourseController@newCourse');
Route::get('/new-course', function () {
    return view('new_course');
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

//Tutor Search and Request
Route::get('/tutor-search', function () {
    $courses = [];
    return view('tutor_search_course',compact('courses'));
});
Route::post('/tutor-search','CourseController@search');

Route::post('/tutor-request','CourseController@requestCourse');


// Search API and its view
Route::get('/search', 'SearchController@searchCourse');
Route::get('/search-courses', function() {
    return view('searchCourses');
});

Route::get('/search-courses/search', 'SearchController@liveSearch')->name('search-courses.search');

Route::get('/cart', function(){
    // route to cart oage
    return view('cart');
});

Route::get('/api/course/{courseId}', 'CourseController@getCourseInfo');

// Route for payment
Route::get('/payment', function () {
    return view('payment');
});

Route::get('/search-courses/search', 'SearchController@liveSearch')->name('search-courses.search');

// Route for payment
//Route::post('/payment', 'Frontend\paymentGatewayController@cartToPayment');
Route::post('/api/getPayment', 'Frontend\paymentGatewayController@cartToPayment');

Route::get('/payment/{payment_id}/{totalprice}','Frontend\paymentGatewayController@getPaymentPage');
//post to payment
Route::post('/card', 'Frontend\paymentGatewayController@chargeCard');
Route::post('/internet', 'Frontend\paymentGatewayController@checkout');
//want to sourceID to result by using controller
Route::get('/result/{paymentID}', 'Frontend\paymentGatewayController@returnPage');

//My Courses
Route::get('/my-courses', 'CourseController@myCoursesIndex');
Route::post('/api/course/cancel','CourseController@cancelCourse');
Route::post('/api/course/status','CourseController@getStatus');

// My Profile View
Route::get('/profile', 'UserController@viewProfile')->name('profile.show');
Route::get('/profile/edit', 'UserController@editProfile')->name('profile.edit');
Route::patch('/profile', 'UserController@updateProfile')->name('profile.update');

// Tutor Profile View
Route::get('/tutor/profile/{user}', 'UserController@viewTutorProfile')->name('profile.tutor.show');

// Notification
Route::get('/api/notification', 'NotificationController@getNotification')->name('notification.index');