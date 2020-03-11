<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseStudent extends Pivot
{
    protected $guarded = ['user_id', 'course_id'];

    public function reviews(){
        return $this -> hasOne(Review::class) -> orderBy('created_at', 'DESC');
    }

}
