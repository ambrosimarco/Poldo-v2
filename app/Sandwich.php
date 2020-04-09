<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sandwich extends Model
{
    use SoftDeletes;
    
    public function ingredients(){
        return $this->belongsToMany('App\Ingredient', 'pairings');
    }

    public function users(){
        return $this->belongsToMany('App\User', 'orders')
            ->withPivot('price', 'times', 'created_at', 'updated_at', 'deleted_at'); // Otherwise, default attributes of the pivot objects are just the two entities' IDs.
    }
}
