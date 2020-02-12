<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;

class SearchController extends Controller
{
    
    public function searchCourse(Request $request){
        // dd($request->input('aaa'));
        // TODO: 
        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA'
        ]);    
    }
}
