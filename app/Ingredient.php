<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    public function sandwiches(){
        return $this->belongsToMany('App\Sandwich', 'pairings');
    }
}
