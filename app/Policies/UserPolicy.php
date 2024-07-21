<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
          // index Users.
          $a=$user->hasPermission("index Users.");
          return   $a=='allow' ? true : false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        //
          // Show User.
          $a=$user->hasPermission("Show User.");
          return   $a=='allow' ? true : false;
    }

    

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        //
          // Update User.
         $a=$user->hasPermission("Update User.");
         return   $a=='allow' ? true : false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        //
         // Delete User.
         $a=$user->hasPermission("Delete User.");
         return   $a=='allow' ? true : false;
    }

   
}
