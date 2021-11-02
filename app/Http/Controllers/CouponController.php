<?php

namespace App\Http\Controllers;

use App\Jobs\UpdateCoupon;
use App\Models\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CouponController extends Controller
{




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
       $coupon = Coupon::where('code',$request->coupon_code)->first();

       if (!$coupon){
           return redirect(route('guestCheckout'))->withErrors('Invalid coupon code. Please try again');
       }
        //dispatching th job update cart
        dispatch_now(new UpdateCoupon($coupon));
        return redirect(route('guestCheckout'))->with('success','Coupon has been applied');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy()
    {
        session()->forget('coupon');
        return redirect(route('guestCheckout'))->with('success','Coupon has been removed');

    }
}
