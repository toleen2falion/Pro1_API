<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Order;
// use App\Models\Product;
// use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\O_CRUD_Trait;

use App\Http\Requests\{
    statusRequest,
    createOrderRequest,
    deleteOrderRequest,
    showOrderRequest,
    
  
};

// use App\Models\Product;

class OrderController extends Controller
{
    use O_CRUD_Trait;
    /**
     * Display a listing of the resource.
     */
    public function index(statusRequest $request)
    {
        //
       
        $user = $this->getUserByIP($request->ip());
  
        // return $user;
        if($request->status)
          { 
            return $this->ordersUserWithStatuse($user,$request->status);
       
          }

          return $this->allOrdersUser($user,$request->status);
        
       
}
        
    /**
     * Store a newly created resource in storage.
     */
    public function store(createOrderRequest $request)
    {
        //
    
    $product = $this->getProductByID($request->product_id);

    $order = $this->getOrderWaitingByProduct($request);

       if($product->quantity>=$request->quantity)
       {
        if($order)
           return $this->existsOrder($product,$order,$request);
        
    
        else
            return $this->newOrder($request,$product);
                  
        }
        else 
        return $this->errorMessage("no enough producte",400);
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order,showOrderRequest $request)
    {
        // $this->authorize('view',$order);
        return $this->getUserOrder($order,$request->ip());

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateOrderRequest $request, Order $order)
    {
        //
        $product = $this->getProductByID($order->product_id);

        $orderUpdate=$this->getUserOrderWaiting($order,$request->ip());

        if($orderUpdate && $product->quantity>=$request->quantity)     
        return $this->updatQuantityOrder($request,$product,$orderUpdate);
   
        else
        return $this->errorMessage("you can not update this order.",400);
  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(deleteOrderRequest $request,Order $order)
    {
        //
        // $this->authorize('delete',$order);
        // return  $order;
        $product = $this->getProductByID($order->product_id);

        $orderDelete=$this->getUserOrderWaiting($order,$request->ip());

        if($orderDelete)     
        return $this->deleteWatiningOrder($orderDelete,$product);
   
        else
        return $this->errorMessage("you can not delete this order.",400);
  
    }
}
