<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    
    public function searchCourse(Request $request){
        dd($request->input('aaa'));
        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA'
        ]);    
    }
}
