<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'id', 'account_number', 'account_name', 'bank', 'user_id'
    ];

    public function User(){
        return $this->belongsTo('App\User');
    }
}
