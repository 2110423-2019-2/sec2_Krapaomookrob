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
}