<?php

namespace App\Policies;
// use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;


class CategoryPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    // public function __construct() {
    //   echo "ll";
    // }
    // public function befor(){
    //     return true;
    // }
    public function viewAny(User $user): bool
    {
        //
          // index Categorys.
          $a=$user->hasPermission("index Categorys.");
          return   $a=='allow' ? true : false;
        
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Category $category): bool
    {
        //
         // Show Category.
         $a=$user->hasPermission("Show Category.");
         return   $a=='allow' ? true : false;
        
    }

   

    

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Category $category): bool
    {
        //
          // Delete Category.
         $a=$user->hasPermission("Delete Category.");
         return   $a=='allow' ? true : false;
    }

   

   
}
