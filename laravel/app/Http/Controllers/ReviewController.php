<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Day;
use App\Location;
use App\Subject;
use Auth;
use Carbon\Carbon;

use App\Course;
use App\User;
use App\Course_subject;
use App\Course_day;
use App\CourseStudent;
use App\Notification;
use App\CourseClass;
use App\Review;

class ReviewController extends Controller
{

    public function __construct()
    {
        $this -> middleware('auth');
    }

    public static function viewReviewCourse($courseId){
        if(auth()->user()->isStudent())
        {
            $course = Course::find($courseId);
            $tutor = User::find($course -> user_id);
            $student = auth() -> user();
            return view('review.course',compact('course', 'tutor', 'student'));
        }
        else{
            return redirect('/');
        }
    }

    public static function createReviewCourse(Request $request){
        Review::updateOrCreate([
            'student_id' => $request->studentid,
            'course_id' => $request->courseid,
            'tutor_id' => $request->tutorid],
            ['message' => $request->message,
            'rating' => $request->rating
        ]);
        return response('OK', 200);
    }

    public static function getRating($tutorId){
        $ratings = DB::Table('reviews')->select('rating')->where('tutor_id',$tutorId)->get();
        $averageStar = $ratings -> avg('rating');
        return number_format((float)$averageStar, 2, '.','');
    }

    public static function getReviews($tutorId){
        $reviews = DB::Table('reviews')
                        ->join('users','reviews.student_id','=','users.id')
                        ->select('message','rating','student_id','name','course_id')
                        ->where('tutor_id',$tutorId)
                        ->get();
        return $reviews;
    }
}
