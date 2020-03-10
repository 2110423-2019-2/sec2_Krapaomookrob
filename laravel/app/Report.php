<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{

    protected $fillable = [
        'id', 'sender_id', 'title', 'message'
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }
}
