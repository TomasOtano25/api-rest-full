<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Seller;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Traits\AdminActions;

class SellerPolicy
{
    use HandlesAuthorization, AdminActions;

    /**
     * Determine whether the user can view the seller.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Seller  $seller
     * @return mixed
     */
    public function view(User $user, Seller $seller)
    {
        return $user->id === $seller->id;
    }

    /**
     * Determine whether the user can create sellers.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function sale(User $user, User $seller)
    {
        return $user->id === $seller->id;
    }

    /**
     * Determine whether the user can update a product.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Seller  $seller
     * @return mixed
     */
    public function editProduct(User $user, Seller $seller)
    {
        return $user->id === $seller->id;
    }

    /**
     * Determine whether the user can delete a product.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Seller  $seller
     * @return mixed
     */
    public function deleteProduct(User $user, Seller $seller)
    {
        return $user->id === $seller->id;
    }
}
