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
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CalendarController;
use App\User;


Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('dashboard');
    });

    Route::get('/api/course/subjects','CourseController@fetchSubjects');
    Route::get('/api/course/days','CourseController@fetchDays');
    Route::post('/api/course/new','CourseController@newCourse');

    // Search Courses
    Route::get('/search-courses', 'SearchController@redirectSearchCourses');
    Route::get('/api/fetch-tutors','SearchController@fetchTutors');
    Route::get('/api/fetch-areas','SearchController@fetchAreas');
    Route::get('/api/fetch-days','SearchController@fetchDays');
    Route::get('/api/fetch-subjects','SearchController@fetchSubjects');
    Route::get('/api/search-courses','SearchController@searchCourses');

    // Route for payment
    Route::get('/payment', function () {
        return view('payment');
    });

    // Route for payment

    //post to payment
    Route::post('/card', 'Frontend\paymentGatewayController@chargeCard');
    Route::post('/internet', 'Frontend\paymentGatewayController@checkout');
    //want to sourceID to result by using controller

    Route::post('/checkrefund','Frontend\paymentGatewayController@checkRefund');

    //My Courses
    Route::get('/my-courses', 'CourseController@myCoursesIndex');
    Route::get('/api/course/status/{course_id}','CourseController@getCourseStatus');
    Route::get('/api/class/status/{class_id}','CourseController@getClassStatus');
    Route::get('/api/user/role','UserController@getRole');
    Route::post('/api/class/postpone', 'CourseController@postponeClass');

    // My Profile View
    Route::get('/profile', 'UserController@viewProfile')->name('profile.show');
    Route::get('/profile/edit', 'UserController@editProfile')->name('profile.edit');
    Route::patch('/profile', 'UserController@updateProfile')->name('profile.update');

    // Tutor Profile View
    Route::get('/tutor/profile/{user}', 'UserController@viewTutorProfile')->name('profile.tutor.show');
    Route::get('/tutor/star/{user}', 'ReviewController@getRating');

    //  Review & Rating Course
    Route::get('/review-course/{courseId}', 'ReviewController@viewReviewCourse');
    Route::post('/api/review/course', 'ReviewController@createReviewCourse');

    // Notification
    Route::get('/api/notification', 'NotificationController@getNotification')->name('notification.index');
    Route::get('/api/notification/markRead', 'NotificationController@markRead');

    //  Report via Contact Admin
    Route::post('/report','UserController@sendReport');

    Route::get('/my-calendar', function () {
        return view('my_calendar');
    });
    Route::get('/api/my-calendar', 'CalendarController@getMyClasses');

    //attendance
    Route::get('/api/classes-today', 'AttendanceController@getClassesToday');
    Route::post('/api/check-class', 'AttendanceController@checkClass');
    Route::get('/api/history-attendances', 'AttendanceController@getHistoryAttendances');

    //chat
    Route::get('/api/chat-list', 'ChatController@getChatList');
    Route::post('/api/send-message', 'ChatController@sendMessage');

    // new course
    Route::get('/new-course', function () {
        return view('new_course');
    });

    // payment result 
    Route::get('/result/{paymentID}/{isAdvertisement}/{courseId}', 'Frontend\paymentGatewayController@returnPage');

    //-------------student--------------------------//
    Route::group(['middleware' => ['student']], function(){

      Route::get('/cart', function(){
          // route to cart oage
          return view('cart');
      });
      Route::get('/api/cart', 'CartController@getCartItem');
      Route::post('/api/cart/remove', 'CartController@removeFromCart');
      Route::post('/api/cart/add', 'CartController@addToCart');
      Route::get('/api/cart/current', 'CartController@getCurrentCart');

      Route::post('/api/getPayment', 'Frontend\paymentGatewayController@cartToPayment');

      Route::get('/payment/{payment_id}/{totalprice}','Frontend\paymentGatewayController@getPaymentPage');

      // My Course Request
      Route::get('/api/course-requests', 'CourseRequesterController@getRequestFromTutor');
      Route::get('/api/get-my-course-request','CourseController@getMyCourseRequest');
      Route::post('api/decline-request', 'CourseRequesterController@declineRequest');
      Route::post('api/accept-request', 'CourseRequesterController@acceptRequest');
      Route::post('/api/delete-request', 'CourseRequesterController@deleteRequest');

      // My Course
      Route::post('/api/course/cancel','CourseController@cancelCourse');
    });



    //-------------tutor--------------------------//
    Route::group(['middleware' => ['tutor']], function(){
      Route::get('/tutor/payment-request', 'PaymentRequestController@tutorIndex');

      //Tutor Search and Request
      Route::get('/tutor-search', 'SearchController@redirectTutorSearchCourses');
      Route::post('/api/tutor-request','CourseController@requestCourse');
      Route::get('/api/tutor-search-courses','SearchController@tutorSearchCourses');

      //Payment Request
      Route::get('/api/user/bank-account', 'UserController@getBankAccount');
      Route::get('/api/user/balance', 'UserController@getBalance');
      Route::post('/api/payment-request/create', 'PaymentRequestController@create');
      Route::get('/api/payment-request/my-requests', 'PaymentRequestController@getMyRequests');

      // Wallet
      Route::get('/api/get-balance', 'UserController@getBalance');
      Route::post('/api/update-balance', 'UserController@updateBalance');

      // Advertisement
      Route::get('/create-advertisement', function() {
          return view('advertisement');
      });
      Route::get('/payment/create-advertisement','Frontend\paymentGatewayController@getAdsPaymentPage');
      Route::get('/api/getAdsCourses','CourseController@getAdsCourses');
    });





    //-------------admin--------------------------//
    Route::group(['middleware' => ['admin']], function(){
      Route::get('/admin/refund-request', 'AdminController@getRefundRequestPage');
      Route::get('/admin/payment-request', 'PaymentRequestController@adminIndex');

      // Admin panel
      Route::get('/admin-panel', function(){
          return view('admin_panel');
      });
      Route::get('/admin-panel/fetchUsers', 'AdminController@fetchUsers');
      Route::get('/admin-panel/fetchAdmins', 'AdminController@fetchAdmins');
      Route::get('/admin-panel/fetchAttendanceLogs', 'AdminController@fetchAttendanceLogs');
      Route::get('/admin-panel/fetchCourseLogs', 'AdminController@fetchCourseLogs');
      Route::get('/admin-panel/promoteAdmin/{email}', 'AdminController@promoteAdmin');
      Route::get('/admin-panel/demoteAdmin/{email}', 'AdminController@demoteAdmin');

      Route::get('/admin-panel/suspend', function(){
          return view('admin_panel_suspend');
      });
      Route::get('/admin-panel/suspend/{id}', 'AdminController@suspend');

      // Admin Report List
      Route::get('/admin-panel/reportList', function(){
          return view('admin_panel_report');
      });
      Route::get('/admin-panel/getReports', 'AdminController@getReports');
      Route::get('/admin-panel/readReport/{id}', 'AdminController@readReport');

      //logging
      Route::get('/getAllVeritiedReport','Frontend\loggingController@getAllVeritiedReport');
      Route::get('/getAllPaymentLog','Frontend\loggingController@getAllPaymentLog');
      Route::get('/getAllCourseCancellation','Frontend\loggingController@getAllCourseCancellation');
      Route::get('/getAllPostponement','Frontend\loggingController@getAllPostponement');
      Route::get('/getAllUserInfo','Frontend\loggingController@getAllUserInfo');
      Route::get('/admin/log/{no}', 'Frontend\loggingController@index');

      //transfer
      Route::post('/transfer','Frontend\paymentGatewayController@createTransferOmise');
      Route::get('/checktransfer','Frontend\paymentGatewayController@checkTransfer');

      Route::post('/api/refundPayment','Frontend\paymentGatewayController@refundPayment');
    });
});


//Login for developers
Route::get('/login-dev/{id}', 'Auth\LoginController@loginDeveloper');


//Login View
Route::get('/login', function () {
    return view('login');
})->name('login');
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


//privacy policy
Route::get('/privacy-policy', function () {
    return view('privacy-policy');
});

//term of service
Route::get('/tos', function () {
    return view('tos');
});
