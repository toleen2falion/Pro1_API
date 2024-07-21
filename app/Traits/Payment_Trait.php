<?php
namespace App\Traits;
use Illuminate\Support\Facades\DB;
use Stripe\StripeClient;
use  Stripe;
use App\Models\{
 
    Payment,
    User,
};

trait Payment_Trait{

    public function createPymentIntent($request){

        $user = $this->getUser($request->ip());
        $amount=$user->getAmountForBay(); 
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
        $paymentIntent =  $stripe->paymentIntents->create([
                'amount' => $amount,
                'currency' => 'usd',
                'automatic_payment_methods' => ['enabled' => true],
                // 'automatic_payment_methods' => ['card'],
            ]);
                return  $paymentIntent;
       }

    public function getClientSecret($paymentIntent){
        return response()->json([
            'client_secret'=> $paymentIntent->client_secret,
        ]);
    }
    public function getUser($ip){

        $user=User::where('user_ip',$ip)->first();
        return  $user;
   }

 
   public function paymentIntentRetrieve(  $payment_intent){
    // $user = $this->getUser($request->ip());
  
    $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
    $paymentIntent=$stripe->paymentIntents->retrieve(
        $payment_intent,
      []

    );
    return  $paymentIntent;
   }


   public function paymentSuccessProcedures($paymentIntent,$ip)
   {
    $user = $this->getUser($ip);
    DB::transaction(function () use ($paymentIntent,$user){
        $payment = new Payment();
        $payment->forceFill([
        'orders_ids'=> implode(",", $user->getOrdersIdsForBay()),
        'amount'=>$paymentIntent->amount,
        'currency'=>$paymentIntent->currency,
        'transaction_id'=>$paymentIntent->id,
         ])->save();
         $user->updateOrdersStatusToPaid();
         });
         return $this->paymentMessage('Payment succeeded',200);
   }


   public function paymentMessage($message,$code){
    return response()->json([
        'message' => $message,

    ],$code);
}

}