<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Transaction;
use App\Traits\AdminActions;

class TransactionPolicy
{
    use HandlesAuthorization, AdminActions;

    /**
     * Determine whether the user can view the trasanction.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Trasanction  $trasanction
     * @return mixed
     */
    public function view(User $user, Transaction $trasanction)
    {
        return $user->id === $trasanction->buyer->id || $user->id === $trasanction->product->seller->id;

    }

    /**
     * Determine whether the user can create trasanctions.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the trasanction.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Trasanction  $trasanction
     * @return mixed
     */
    public function update(User $user, Trasanction $trasanction)
    {
        //
    }

    /**
     * Determine whether the user can delete the trasanction.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Trasanction  $trasanction
     * @return mixed
     */
    public function delete(User $user, Trasanction $trasanction)
    {
        //
    }
}
