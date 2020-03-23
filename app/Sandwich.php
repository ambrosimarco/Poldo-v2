<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sandwich extends Model
{
    public function ingredients(){
        return $this->belongsToMany('App\Ingredient', 'pairings');
    }

    public function users(){
        return $this->belongsToMany('App\User', 'orders');
    }
}
