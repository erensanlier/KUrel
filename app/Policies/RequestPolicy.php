<?php

namespace App\Policies;

use App\User;
use App\Request;
use Illuminate\Auth\Access\HandlesAuthorization;

class RequestPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any requests.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function SLC(User $user)
    {
        return $user->role == 'slc';
    }

    /**
     * Determine whether the user can view the request.
     *
     * @param  \App\User  $user
     * @param  \App\Request  $request
     * @return mixed
     */
    public function view(User $user, Request $request)
    {
        return $user->role == 'slc';
    }

    /**
     * Determine whether the user can create requests.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //return $user == null;
    }

    /**
     * Determine whether the user can update the request.
     *
     * @param  \App\User  $user
     * @param  \App\Request  $request
     * @return mixed
     */
    public function update(User $user, Request $request)
    {
        return $user->role == 'slc';
    }

    public function softUpdate(User $user, Request $request)
    {
        return $user->role == 'slc' || $user->role == 'sl';
    }

    /**
     * Determine whether the user can delete the request.
     *
     * @param  \App\User  $user
     * @param  \App\Request  $request
     * @return mixed
     */
    public function delete(User $user, Request $request)
    {
        //return $user->role == 'slc';
    }

    /**
     * Determine whether the user can restore the request.
     *
     * @param  \App\User  $user
     * @param  \App\Request  $request
     * @return mixed
     */
    public function restore(User $user, Request $request)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the request.
     *
     * @param  \App\User  $user
     * @param  \App\Request  $request
     * @return mixed
     */
    public function forceDelete(User $user, Request $request)
    {
        //return $user->role == 'slc';
    }
}
