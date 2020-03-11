<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    protected $guarded = [];

    public function courseStudent(){
        return $this->belongsTo(CourseStudent::class);
    }

    public function student(){
        return $this->belongsTo(User::class);
    }

    public function tutor(){
        return $this->belongsTo(User::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }
}
