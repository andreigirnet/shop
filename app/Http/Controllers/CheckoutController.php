<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckOutRequest;
use App\Mail\OrderPlaced;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Cartalyst\Stripe\Exception\CardErrorException;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        if (Cart::instance('default')->count() == 0) {
            return redirect()->route('front.shop');
        }

        if (auth()->user() && request()->is('guestCheckout')) {
            return redirect()->route('checkout.index');
        }

        return view('front.checkout')->with([
            'discount'=>$this->getNumbers()->get('discount'),
            'newSubtotal'=>$this->getNumbers()->get('newSubtotal'),
            'newTax'=>$this->getNumbers()->get('newTax'),
            'newTotal'=>$this->getNumbers()->get('newTotal'),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CheckOutRequest $request)
    {
        //Check if there is no double purchase on low quantity
        if($this->productsAreNoLongerAvailable()){
            return back()->withErrors('Sorry one of the items in your cart is no longer available');
        }
        $contents = Cart::content()->map(function($item){
           return $item->model->slug. ', '.$item->qty;
        })->values()->toJson();
        try {
            $charge = Stripe::charges()->create([
                'amount'=>$this->getNumbers()->get('newTotal')/100,
                'currency'=> 'USD',
                'source'=>$request->stripeToken,
                'description'=>'Order',
                'receipt_email'=> $request->email,
                'metadata'=>[
                    'contents'=> $contents,
                    'quantity'=> Cart::instance('default')->count(),
                    'discount'=>collect(session()->get('coupon'))->toJson(),
                ],
            ]);
            $order = $this->addToOrdersTable($request, null);
            Mail::send(new OrderPlaced($order));
            $this->decreaseQuantities();
            //Successful
            Cart::instance('default')->destroy();
            session()->forget('coupon');
            return redirect(route('confirmation.index'))->with('success','Thank you! Your payment has been successfully accepted');

        }catch(CardErrorException $e){
            $this->addToOrdersTable($request, $e->getMessage());
            return back()->withErrors('Error! '. $e->getMessage());

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    private function getNumbers(){
        $tax = config('cart.tax')/100;
        $discount = session()->get('coupon')['discount'] ?? 0;
        $code = session()->get('coupon')['name'] ?? null;
        $newSubTotal = (Cart::subtotal() - $discount);
        if($newSubTotal < 0){
            $newSubTotal=0;
        }
        $newTax = $newSubTotal * $tax;
        $newTotal = $newSubTotal * (1 + $tax);
        return collect([
            'tax'=>$tax,
            'discount'=>$discount,
            'code'=>$code,
            'newSubtotal'=> $newSubTotal,
            'newTax'=>$newTax,
            'newTotal'=>$newTotal
        ]);
    }

    private function addToOrdersTable(Request $request, $error){
        //Insert into orders table
        $order = Order::create([
            'user_id'=> auth()->user() ? auth()->user()->id :null,
            'billing_email'=>$request->email,
            'billing_name'=>$request->name,
            'billing_address'=>$request->address,
            'billing_city'=>$request->city,
            'billing_province'=>$request->province,
            'billing_postalcode'=>$request->zip,
            'billing_phone'=>$request->phone,
            'billing_discount'=>$this->getNumbers()->get('discount'),
            'billing_discount_code'=>$this->getNumbers()->get('code'),
            'billing_subtotal'=>$this->getNumbers()->get('newSubtotal'),
            'billing_tax'=>$this->getNumbers()->get('newTax'),
            'billing_total'=>$this->getNumbers()->get('newTotal'),
            'error'=>$error

        ]);
        //Store into order_product pivot
        foreach(Cart::content() as $item){
            OrderProduct::create([
                'order_id'=>$order->id,
                'product_id'=>$item->model->id,
                'quantity'=>$item->qty
            ]);
        }
        return $order;
    }
        protected function decreaseQuantities(){
            foreach(Cart::content() as $item){
                $product = Product::find($item->model->id);
                $product->update([
                    'quantity'=>$product->quantity - $item->qty
                ]);
            }
        }
        protected function productsAreNoLongerAvailable(){
            foreach(Cart::content() as $item){
                $product = Product::find($item->model->id);
                if($product->quantity < $item->qty){
                    return true;
                }
                return false;
            }
        }
}
