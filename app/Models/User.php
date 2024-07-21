<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_ip',
        'first_name',
        'last_name',
        'date_of_birth',
        'email',
        'password',
        'address',
        'admin',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /////
    //  //many to many product_user
    //  public function Products(){
    //     return $this->belongsToMany(Product::class,'orders');
    // }
    ////
     //
     public function OrdersID(){
        return $this->hasMany(Order::class,'user_id')->with('product');
    }

    //
    public function OrdersIP(){
        return $this->hasMany(Order::class,'user_ip','user_ip')->with('product');
    }
    //
     //
     
    ////
    public function createAddress($postal_code,$country,$city){
        $this->address=$postal_code.'_'.$country.'_'.$city;
        $this->save();
    }
    ///////////9
//     public function Roles(){
//         return $this->hasMany(Role::class,'user_id');
//     }
    public function Roles(){
        return $this->belongsToMany(Role::class,'user__roles');
    }
//     /////
    public function hasPermission($P){

    foreach($this->Roles as $Role)
    {
        if($Role->name=='Owner')  return "allow";
    foreach($Role->Permissions as $Permission)
       { 
        $r= $Permission->name==$P? 1 : 0;
        if($r)
        return "allow";
       }
       return "deny";

    }
}

//////update task8
public function Orders()
{
    $OrdersIP = $this->OrdersIP;
    $OrdersID = $this->OrdersID;
    // $orders = $OrdersIP->merge($OrdersID);
    return $OrdersIP->merge($OrdersID);
}
///////////////////////task11

public function userOrdersWaiting()
{
   return $this->Orders()->where('status','waiting');  
}
///
public function getAmountForBay()
{
    $userOrders=$this->userOrdersWaiting();
    $amount = 0;
    foreach ($userOrders as $userOrder)
    $amount+=$userOrder->product->price* $userOrder->quantity ;
    return  $amount;    
}
public function getOrdersIdsForBay()
{
    $OrdersIds=[];
    $userOrders=$this->userOrdersWaiting();
    foreach ($userOrders as $userOrder)
    $OrdersIds[]=$userOrder->id;
    return  $OrdersIds;    
}
public function updateOrdersStatusToPaid()
{
    $userOrders=$this->userOrdersWaiting();
    foreach ($userOrders as $userOrder)
    $userOrder->update([
        'status' =>'paid',
      ]);
    // $OrdersIds[]=$userOrder->id;
    // return  $OrdersIds;    
}
}
