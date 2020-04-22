<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];
    
    public function sender(){
        return $this->belongsTo(User::class);
    }

    public function receiver(){
        return $this->belongsTo(User::class);
    }
}
