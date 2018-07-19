<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Traits\AdminActions;

class ProductPolicy
{
    use HandlesAuthorization, AdminActions;

    /**
     * Determine whether the user can view the product.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return mixed
     */
    public function view(User $user, Product $product)
    {
        // return $user->id === $product->seller->id;
    }

    /**
     * Determine whether the user can add a category from a product.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return mixed
     */
    public function addCategory(User $user, Product $product)
    {
        return $user->id === $product->seller->id;        
    }

    /**
     * Determine whether the user can update the product.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return mixed
     */
    public function update(User $user, Product $product)
    {
        //
    }

    /**
     * Determine whether the user can delete a category from a product.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return mixed
     */
    public function deleteCategory(User $user, Product $product)
    {
        return $user->id === $product->seller->id;
    }
}
