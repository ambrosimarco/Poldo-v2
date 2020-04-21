<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'last_login_at', 'last_login_ip',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function canAdminEdit(){
        return $this->role == 'admin';
    }
    
    public function canBarEdit(){
        return $this->role == 'bar';
    }

    public function sandwiches(){
        return $this->belongsToMany('App\Sandwich', 'orders')
        ->withPivot('price', 'times', 'created_at', 'updated_at', 'deleted_at'); // Otherwise, default attributes of the pivot objects are just the two entities' IDs.
    }
}
