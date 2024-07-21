<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
         // index Products.
         $a=$user->hasPermission("index Products.");
         return   $a=='allow' ? true : false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Product $product): bool
    {
        //
         //Show Product.
         $a=$user->hasPermission("Show Product.");
         return   $a=='allow' ? true : false;
    }

   
   
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Product $product): bool
    {
        //
        // Delete Product.
        $a=$user->hasPermission("Delete Product.");
        return   $a=='allow' ? true : false;
    }

}
