<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PermissionPolicy
{
   
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Permission $permission): bool
    {
        //
          // Update Permissions.
         $a=$user->hasPermission("Update Permissions.");
         return   $a=='allow' ? true : false;
    }

    
}
