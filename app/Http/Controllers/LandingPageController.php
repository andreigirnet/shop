<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Post;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('featured', true)->take(6)->inRandomOrder()->get();
        $latest = Product::latest('created_at')->take(6)->inRandomOrder()->get();
        $featured = Product::where('featured', true)->take(6)->inRandomOrder()->get();
        $offer = Product::where('price','<',170000)->take(6)->inRandomOrder()->get();
        $categories = Category::all()->take(3);
        $posts = Post::where('status','=','published')->take(3)->inRandomOrder()->get();
        return view('home', compact('products','latest','offer','featured','categories','posts'));
    }



}
