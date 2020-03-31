<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    //
    protected $fillable = ['course_id', 'user_id'];
    public function users(){
        return $this->belongsTo(User::class);
    }

    public function courses(){
        return $this->belongsTo(Course::class);
    }
}
