<?php
namespace App\Traits;
use Illuminate\Support\Facades\DB;
// use App\Events\RegisteredOrder;
use App\Events\RegisteredOrderEvent;
use App\Notifications\NewOrderNotification;
use App\Models\{
    Order,
    Product,
    User,
};

trait O_CRUD_Trait{

    public function errorMessage($message,$code){
        return response()->json([
            'status' => false,
            'message' => $message,
    
        ],$code);
    }

   

    public function successMessage($message,$code){
        return response()->json([
            'status' => true,
            'message' => $message,
    
        ],$code);
    }

    public function ordersUserWithStatuse($user,$status){

        $userOrders=$user->Orders()->where('status',$status);
        return  $userOrders;
       
    }

    public function allOrdersUser($user){
        
        //******************* */
        $userOrders=$user->Orders();
        return $userOrders->groupBy('status');
        //******************* */
       
    }


    //
    public function existsOrder($product,$order,$request){
        DB::transaction(function () use ($product,$order,$request){
          
            $order->increment('quantity',$request->quantity);
            $product->decrement('quantity',$request->quantity);
           

             });
             
             return $this->successMessage("add quantity to order",200);
    }

    //
    public function newOrder($request,$product){
        DB::transaction(function () use ($request,$product){
            $data=$request->all();
            $data['user_ip']= $request->ip();
            // $data['created_at']=now();

            $order=Order::create($data);
        
            $product->decrement('quantity',$request->quantity);
            event(new RegisteredOrderEvent($order));
             
             });
            
             
        return $this->successMessage("add new order",200);
    }

    //quantity
    public function updatQuantityOrder($request,$product,$order){
      
        DB::transaction(function () use ($request,$product,$order){
            $order->increment('quantity',$request->quantity);
            $product->decrement('quantity',$request->quantity);
           
            if($order->quantity<1)
            {

            DB::rollBack();
           echo "you can not update";
            }
            
        });
        
        return $this->successMessage(" update this order.",200);
    }
    
    //quantity
    public function deleteWatiningOrder($order,$product){
        DB::transaction(function () use ($order,$product){
            $product->increment('quantity',$order->quantity);
            $order->delete();
            // $order->increment('quantity',$request->quantity);
         });
       
        return $this->successMessage(" deleted order.",200);
    }
    ////

     //jjjjj
     public function getUserByIP($ip){

         $user=User::where('user_ip',$ip)->first();
         return  $user;
    }

    public function getOrderWaitingByProduct($request){
        $user = $this->getUserByIP($request->ip());
        $order = Order::where('product_id',$request->product_id)->where('status','waiting')->where('user_ip',$user->user_ip)->first();
        if( $order)
        return  $order;
    else 
    $order = Order::where('product_id',$request->product_id)->where('status','waiting')->where('user_id',$user->id)->first();
    return  $order;
   }

   public function getProductByID($id){

    $product = Product::where('id',$id)->first();
    return  $product;
}

//
public function getUserOrder($order,$ip){
    $user = $this->getUserByIP($ip);
    if($user->user_ip == $order->user_ip || $order->user_id == $user->id)
    return  $order;

    else
      return $this->errorMessage("you can not show this order.",400);
}

//
public function getUserOrderWaiting($order,$ip){
    $user = $this->getUserByIP($ip);
    if(($user->user_ip == $order->user_ip || $order->user_id == $user->id) && 
            $order->status=='waiting')
    return  $order;
}
    
}