<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Traits\Payment_Trait;


class PaymentController extends Controller
{
   use Payment_Trait;

    public function handle(Request $request)
    {
     
      $paymentIntent =$this->createPymentIntent($request);
      return $this->getClientSecret($paymentIntent);
          // return $paymentIntent->id;
     }

    
    public function confirm(Request $request)
    {
     
      $paymentIntent=$this-> paymentIntentRetrieve($request->payment_intent);
// return  $paymentIntent;
      if($paymentIntent->status == 'succeeded')
      return $this->paymentSuccessProcedures($paymentIntent,$request->ip());


       
      return $this-> paymentMessage('Payment failed',400);
        
    }

   
  
}
