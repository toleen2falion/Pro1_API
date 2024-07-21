<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'price',
        'created_at',
        'category_id',
       
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    // //many to many product_user
    // public function Users(){
    //     return $this->belongsToMany(User::class,'orders');
    // }
    public function Orders(){
        return $this->hasMany(Order::class,'product_id');
    }

}
