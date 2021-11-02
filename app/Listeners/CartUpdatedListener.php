<?php

namespace App\Listeners;


use App\Jobs\UpdateCoupon;
use App\Models\Coupon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CartUpdatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if (session()->has('coupon')) {
            $couponName = session()->get('coupon')['name'];
        }

        if (session()->has('coupon')&& $couponName) {
            $coupon = Coupon::where('code', $couponName)->first();

            dispatch_now(new UpdateCoupon($coupon));
        }
    }
}
