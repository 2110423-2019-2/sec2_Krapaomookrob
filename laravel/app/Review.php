<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'id', 'student_id', 'course_id', 'tutor_id', 'message', 'rating'
    ];

    public function student(){
        return $this->belongsTo(User::class);
    }

    public function tutor(){
        return $this->belongsTo(User::class);
    }

    public function course(){
        return $this->belongsTo(CourseStudent::class);
    }
}
