<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentRequest extends Model
{
    protected $guarded = [];
    protected $fillable = ['amount', 'status', 'bank_account', 'transferred_by', 'requested_by'];

    public function transferer(){
        return $this->belongsTo('App\User', 'transferred_by');
    }

    public function requester(){
        return $this->belongsTo('App\User', 'requested_by');
    }

    public function bankAccount(){
        return $this->hasOne('App\BankAccount');
    }

}
