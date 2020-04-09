<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredient extends Model
{
    use SoftDeletes;
    
    public function sandwiches(){
        return $this->belongsToMany('App\Sandwich', 'pairings');
    }
}
