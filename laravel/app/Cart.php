<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    public function cart_items(){
        return $this->hasMany(Cart_item::class);
    }

    public function courses(){
        return $this->belongsToMany(course::class);
    }
}
