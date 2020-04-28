<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseRequester extends Model
{
    protected $fillable = ['status'];
    //
    public function users(){
        return $this->belongsTo(User::class);
    }
}
