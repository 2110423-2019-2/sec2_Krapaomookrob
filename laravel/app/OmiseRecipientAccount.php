<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OmiseRecipientAccount extends Model
{
    protected $guarded = [];

    public function User(){
        return $this->belongsTo(User::user_id);
    }
}
