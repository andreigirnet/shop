<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class SaveForLaterController extends Controller
{


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Cart::instance('saveForLater')->remove($id);
        return back()->with('success', 'Item Has been removed');
    }
    /**
     * Switch item from save for later to cart
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switchToCart($id)
    {
        $item = Cart::instance('saveForLater')->get($id);
        Cart::instance('saveForLater')->remove($id);
        $duplicates = Cart::instance('default')->search(function($cartItem, $rowId) use ($id){
            return $rowId===$id;
        });
        if($duplicates->isNotEmpty()){
            return redirect(route('front.cart'))->with('success','Item is already in your cart');
        }

        Cart::instance('default')->add($item->id, $item->name,1 , (float)$item->price)->associate('App\Models\Product');
        return redirect(route('front.cart'))->with('success', 'Item has been moved to cart');
    }
}
