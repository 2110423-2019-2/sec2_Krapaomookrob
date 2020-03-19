<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function days()
    {
        return $this->belongsToMany(Day::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function location(){
        return $this->belongsTo(Location::class);
    }

    public function students(){
        return $this->belongsToMany('App\User', 'course_student')->withTimestamps();
    }

    public function courseClasses(){
        return $this->hasMany(CourseClass::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
