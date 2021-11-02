<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Nicolaslopezj\Searchable\SearchableTrait;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = 9;
        $categories = Category::all();
        if (request()->category){
            $products = Product::with('categories')->whereHas('categories',function($query){
                $query->where('slug', request()->category);
            });
            $categoryName = optional($categories->where('slug',request()->category)->first())->name;
        }else{
            $products = Product::where('featured',true);
            $categoryName = 'Featured';
        }

        if (request()->sort === 'low_to_high'){
            $products = $products->orderBy('price')->paginate($pagination);
        }elseif(request()->sort === 'high_to_low'){
            $products = $products->orderBy('price', 'desc')->paginate($pagination);
        }else{
            $products = $products->paginate($pagination);
        }


        return view('front.shop', compact('products','categories','categoryName'));
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug',$slug)->firstOrFail();
        $mightAlsoLike = Product::where('slug','!=',$slug)->inRandomOrder()->take(4)->get();
        $stockLevel = getStockLevel($product->quantity);
        return view('front.item', compact('product','mightAlsoLike','stockLevel'));
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
    public function search(Request $request){
        $request->validate([
            'query'=>'required|min:3'
        ]);
        $query = $request->input('query');
        $products = Product::where('name','like',"%$query%")
            ->orWhere('details','like',"%$query%")
            ->orWhere('description','like',"%$query%")->paginate(15);
        //$products = Product::search($query)->paginate(15);
        return view('front.search-results')->with('products',$products);
    }
    public function searchAlgolia(Request $request){

        return view('front.search-results-algolia');
    }
    public function vueAlgolia(Request $request){

        return view('front.search-results-algolia-vue');
    }
}
