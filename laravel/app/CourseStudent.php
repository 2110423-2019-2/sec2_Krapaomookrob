<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseStudent extends Pivot
{
    protected $guarded = ['user_id', 'course_id'];

}
