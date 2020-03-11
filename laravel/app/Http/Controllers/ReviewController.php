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

    public function viewReviewCourse($courseId){
        $course = Course::find($courseId);
        $tutor = User::find($course -> user_id);
        $student = auth() -> user();
        //$coursestudent = CourseStudent::find('course_id',$courseId);
        //$registeredCourse = CourseStudent::where('user_id', auth()->user()->id)->where('course_id', '=', $course_id)->first();
        return view('review.course',compact('course', 'tutor', 'student'));
    }

    public function createReviewCourse(Request $request){
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
        $results = DB::Table('reviews')->select('rating')->where('tutor_id',$tutorId)->get();
        $averageStar = $results -> avg('rating');
        //dd($average);
        return $averageStar;
    }
}
