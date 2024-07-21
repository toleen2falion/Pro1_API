<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $fillable = [
        'user_id',
        'user_ip',
        'product_id',
        'quantity',
        'status',
        // 'created_at',
       
    ];
////
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
    //
    public function userID(){
        return $this->belongsTo(User::class,'user_id');
    }
    //
    public function userIP(){
        return $this->belongsTo(User::class,'user_ip','user_ip');
    }

    //////
    public function userName(){
        if($this->userID)
        $nameuser=$this->userID->first_name." ".$this->userID->last_name;
        else
        $nameuser=$this->userIP->first_name." ".$this->userIP->last_name;
        
     return  $nameuser;
    }
}
