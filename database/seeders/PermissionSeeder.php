<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('permissions')->insert([
            ['name'=>'Create User.'],
            ['name'=>'Show User.'],
            ['name'=>'index Users.'],
            ['name'=>'Update User.'],
            ['name'=>'Delete User.'],

            ['name'=>'Create Product.'],
            ['name'=>'Show Product.'],
            ['name'=>'index Products.'],
            ['name'=>'Update Product.'],
            ['name'=>'Delete Product.'],
            

            ['name'=>'Create Category.'],
            ['name'=>'Show Category.'],
            ['name'=>'index Categorys.'],
            ['name'=>'Update Category.'],
            ['name'=>'Delete Category.'],
          

            ['name'=>'Update Permissions.'],
            
            ['name'=>'index Orders.'],
            ['name'=>'Show Order.'],
            ['name'=>'Update Order.'],
            ['name'=>'Delete Order.'],
           
        ]);
    }
}
