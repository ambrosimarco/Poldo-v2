<?php

namespace App\Policies;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function changePassword(User $user){
        if (!($user->role == 'admin')) {
            return Auth::user()->role == 'admin' || Auth::user()->id == $user->id;
        }else{
            return Auth::user()->id == $user->id;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return in_array($user->role, array('admin'));
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function view(User $user)
    {
        return in_array($user->role, array('admin'));
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create()
    {
        return true;
        return in_array($user->role, array('admin'));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        if ($model->role != 'admin') {
            //dd('Utente normale');
            return in_array($user->role, array('admin'));
        }elseif ($model->id == $user->id) {
           // dd('Utente admin ma se stesso');
            return in_array($user->role, array('admin'));
        }else{
           // dd('Altro utente admin');
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        if ($model->role != 'admin') {
            return in_array($user->role, array('admin'));
        }elseif ($model->id == $user->id) {
            return in_array($user->role, array('admin'));
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        return in_array($user->role, array('admin'));
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        if ($model->role != 'admin') {
            return in_array($user->role, array('admin'));
        }elseif ($model->id == $user->id) {
            return in_array($user->role, array('admin'));
        }else{
            return false;
        }
    }

    public function wipe(User $user)
    {
        return in_array($user->role, array('admin'));
    }
}
