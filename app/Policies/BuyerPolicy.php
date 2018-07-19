<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Buyer;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Traits\AdminActions;

class BuyerPolicy
{
    use HandlesAuthorization, AdminActions;

    /**
     * Determine whether the user can view the buyer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Buyer  $buyer
     * @return mixed
     */
    public function view(User $user, Buyer $buyer)
    {
        return $user->id === $buyer->id;
    }

    /**
     * Determine whether the user can create buyers.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    // public function create(User $user)
    public function purchase(User $user)
    {
        return $user->id === $buyer->id;        
    }

    /**
     * Determine whether the user can update the buyer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Buyer  $buyer
     * @return mixed
     */
    public function update(User $user, Buyer $buyer)
    {
        //
    }

    /**
     * Determine whether the user can delete the buyer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Buyer  $buyer
     * @return mixed
     */
    public function delete(User $user, Buyer $buyer)
    {
        //
    }
}
