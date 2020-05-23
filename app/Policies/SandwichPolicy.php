<?php

namespace App\Policies;

use App\Sandwich;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SandwichPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any sandwiches.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return in_array($user->role, array('admin', 'class', 'bar'));
    }

    /**
     * Determine whether the user can view the sandwich.
     *
     * @param  \App\User  $user
     * @param  \App\Sandwich  $sandwich
     * @return mixed
     */
    public function view(User $user, Sandwich $sandwich)
    {
        return in_array($user->role, array('admin', 'class', 'bar'));
    }

    /**
     * Determine whether the user can edit sandwiches.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function edit(User $user)
    {
        return in_array($user->role, array('admin', 'bar'));
    }

    /**
     * Determine whether the user can update the sandwich.
     *
     * @param  \App\User  $user
     * @param  \App\Sandwich  $sandwich
     * @return mixed
     */
    public function update(User $user)
    {
        return in_array($user->role, array('admin'));
    }

    /**
     * Determine whether the user can update the sandwich.
     *
     * @param  \App\User  $user
     * @param  \App\Sandwich  $sandwich
     * @return mixed
     */
    public function create(User $user)
    {
        return in_array($user->role, array('admin', 'bar'));
    }

    /**
     * Determine whether the user can restore the sandwich.
     *
     * @param  \App\User  $user
     * @param  \App\Sandwich  $sandwich
     * @return mixed
     */
    public function restore(User $user, Sandwich $sandwich)
    {
        return in_array($user->role, array('admin'));
    }

    /**
     * Determine whether the user can permanently delete the sandwich.
     *
     * @param  \App\User  $user
     * @param  \App\Sandwich  $sandwich
     * @return mixed
     */
    public function delete(User $user)
    {
        return in_array($user->role, array('admin', 'bar'));
    }

    /**
     * Determine whether the user can permanently delete the sandwich.
     *
     * @param  \App\User  $user
     * @param  \App\Sandwich  $sandwich
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return in_array($user->role, array('admin'));
    }
}
