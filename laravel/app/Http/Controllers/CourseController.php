<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Day;
use App\Subject;

class CourseController extends Controller
{
    public function fetchDays(){
        $days = Day::all()->pluck('name');
        return $days;
    }

    public function fetchSubjects(){
        $days = Subject::all()->pluck('name');
        return $days;
    }
}
