<?php

namespace App\Providers;


use App\Models\{
    Category,
    User,
    Product,
    Order,
    Permission,
  
};

use App\Policies\{
    CategoryPolicy,
    UserPolicy,
    ProductPolicy,
    // OrderPolicy,
    PermissionPolicy,
};
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;



class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Category::class => CategoryPolicy::class,
        User::class => UserPolicy::class,
        Product::class => ProductPolicy::class,
        // Order::class => OrderPolicy::class,
        Permission::class => PermissionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //
    }
}
