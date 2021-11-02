<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
          $mightAlsoLike = Product::inRandomOrder()->take(4)->get();
          return view('front.cart', compact('mightAlsoLike'));
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $duplicates = Cart::search(function($cartItem, $rowId) use($request){
           return $cartItem->id ===$request->id;
        });
        if ($duplicates->isNotEmpty()){
            return redirect(route('front.cart'))->with('success','Item is already in your Cart');
        }
        Cart::add($request->id, $request->name,1 , (float)$request->price)->associate('App\Models\Product');

        return redirect(route('front.cart'))->with('success', 'Item added to the cart');
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'quantity'=>'required|numeric|between:1,5'
        ]);

        if($validator->fails()){
            session()->flash('errors', collect(['Quantity must be between 1 and 5']));
            return response()->json(['success'=>false], 400);
        }
        if ($request->quantity > $request->productQuantity){
            session()->flash('errors', collect(['We currently do not have enough items in stock']));
            return response()->json(['success'=>false], 400);
        }

       Cart::update($id, $request->quantity);
       session()->flash('success', 'Quantity was updated successfully');
       return response()->json(['success'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Cart::remove($id);
        return back()->with('success', 'Item Has been removed');
    }

    /**
     * Shopping cart to save for later
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switchToSaveForLater($id)
    {
        $item = Cart::get($id);
        Cart::remove($id);
        $duplicates = Cart::instance('saveForLater')->search(function($cartItem, $rowId) use ($id){
           return $rowId===$id;
        });
        if($duplicates->isNotEmpty()){
            return redirect(route('front.cart'))->with('success','Item is already saved for later');
        }
        Cart::instance('saveForLater')->add($item->id, $item->name,1 , (float)$item->price)->associate('App\Models\Product');
        return redirect(route('front.cart'))->with('success', 'Item has been saved for later');
    }
}
