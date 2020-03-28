<?php

namespace App\Http\Controllers;

use App\Advertisement;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    //
    public function createAdvertisement(Request $request) {
        // dd($request);
        $user = auth()->user();
        if (!$user->isTutor()){
            return response('Access denied: this feature is only for tutors', 401);
        }
        $userId = $user->id;
        $courseId = $request->input('courseId');
        $status = Advertisement::create([
            'course_id' => $courseId,
            'user_id' => $userId
        ]);
        return response($status,200);
    }
}
