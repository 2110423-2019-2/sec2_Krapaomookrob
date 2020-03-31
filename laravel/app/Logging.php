<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logging extends Model
{
    protected $guarded = [];

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }
}
