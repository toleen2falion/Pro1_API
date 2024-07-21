<?php

namespace App\Listeners;

use App\Events\RegisteredOrderEvent;
use App\Notifications\NewOrderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;
use App\Models\{
    
    User,
};

class SendAdminNotificationListener
{
    // protected $value;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
      
    }

    /**
     * Handle the event.
     */
    public function handle(RegisteredOrderEvent $event): void
    {
        //
  
        /////
        $admins = User::where('admin', 1)->get();
        foreach($admins as $admin)
        $admin->notify(new NewOrderNotification($event->order));
    ///////
   
    }
}
