<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'name',
        'created_at',
        'superCategory_id',
       
    ];

    //
    public function products(){
        return $this->hasMany(Product::class,'category_id');
    }

    
    // public function subCategories1(){
    //     return $this->hasMany(Category::class,'superCategory_id');
    // }


    // //

    public function children()
    {
        return $this->hasMany(
            Category::class,
            'superCategory_id'
        )->with(
            'children',
            'products'
            
        );
    }
}
