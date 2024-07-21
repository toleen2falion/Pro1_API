<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use App\Models\Order;

class deleteOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $orders = Order::where('status','delivered')->where('updated_at', '<=', Carbon::now()->subDays(3))->get();
        foreach ($orders as $order) {
        $order->delete();
        }
        // $orders=Order::where('status','delivered')->get();
        // foreach($orders as  $order){
        //     if($order->updated_at)
        // }
    }
}
