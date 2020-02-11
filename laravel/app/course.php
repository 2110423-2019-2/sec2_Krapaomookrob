<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    //
    public function carts(){
        return $this->belongsToMany(Cart::class);
    }
}
