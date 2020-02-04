<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    protected $fillable = [
        'provider', 'provider_user_id', 'user_id'
    ];

    public function User(){
        return $this->belongsTo('App\User');
    }
}
