@extends('layouts.app')
@section('extra-css')
    <link rel="stylesheet" href="{{asset('css/algolia.css')}}">
@endsection
@section('content')
<div>
    <div id="nav-bar" class="flex justify-between w-full h-20 bg-black items-center">
        <div class="left flex items-center ml-20" style="margin-left: 100px">
            <a href="{{route('home')}}"> <div class="text-2xl font-bold text-white cursor-pointer " id="title">SHOP</div></a>
            <nav>
                {{menu('left','partials.menus.main')}}
            </nav>
        </div>
        <div class="right" style="margin-right: 100px">
            @include('partials.menus.main-right')
        </div>
    </div>

    <div class="w-full h-16 bg-gray-200 flex items-center justify-between">
        <div class="ml-36 flex items-center justify-center">
            <div><a href="/">home </a></div>
            <div>></div>
            <div><a href="{{route('front.shop')}}">shop</a></div>
        </div>
        @include('partials.search')
    </div>
    @if(session()->has('success'))

        <div class="bg-green-300 text-green-700 w-full h-14 flex rounded-lg items-center"><div class="ml-4">{{session()->get('success')}}</div></div>
    @endif
    @if(count($errors)>0)
        @foreach($errors->all() as $error)
            <div class="bg-red-300 text-white w-full h-14 flex rounded-lg items-center"><div class="ml-4">{{$error}}</div></div>
        @endforeach
    @endif
    <div class="w-3/4 mx-auto flex mt-8 pb-64" id="content">

            <div class="w-64">
                <div class="font-bold">By Category</div>
                <div class="mt-2">
                    <ul>
                        @foreach($categories as $category)
                            <a class="" href="{{route('front.shop',['category'=>$category->slug])}}"><li class="mt-4 text-gray-600 text-lg cursor-pointer text-gray-600 hover:text-gray-400 {{setActiveCategory($category->slug)}}">{{$category->name}}</li></a>
                        @endforeach
                    </ul>
                </div>
                <div >

            </div>

            </div>
        <div class="w-full">
            <div>
                <div class="flex items-center justify-between">
                    <div>
                        <hr style="width: 80px; height:2px; background-color:gray">
                        <div class="text-3xl font-semibold mt-2 mb-2">{{$categoryName}}</div>
                        <hr class="mt-2" style="width: 80px; height:3px; background-color:gray">
                    </div>
                    <div class="flex items-center ">
                        <div class="text-lg mr-4">Sort by Price:</div>
                            <a class="border border-gray-600 rounded-lg px-2 py-2 hover:bg-gray-500 hover:text-white" href="{{route('front.shop',['category'=>request()->category,'sort'=>'low_to_high'])}}">Low-to-High</a>
                            <a class="ml-2 border border-gray-600 rounded-lg px-2 py-2 hover:bg-gray-500 hover:text-white" href="{{route('front.shop',['category'=>request()->category,'sort'=>'high_to_low'])}}">High-to-Low</a>

                    </div>
                </div>
                <div class="grid grid-cols-3 gap-y-32 gap-x-32 ml-436 mt-12 " id="products">
                    @forelse($products as $product)

                        <a href="{{route('front.show', $product->slug)}}"> <div class="relative">
                                @if($product->image)
                                    <div style="height: 200px" class="relative">
                                    <img style="height: 200px" src="{{asset($product->image)}}" alt="">
                                    </div>
                                @endif
                            <div class="absolute -bottom-12 left-20">
                                <div class="text-center mt-2">{{$product->name}}</div>
                                <div class="text-center text-gray-500">{{$product->presentPrice()}}</div>
                            </div>
                        </div>
                        </a>
                    @empty
                        <div>No items yet</div>
                    @endforelse
                </div>
            </div>


        </div>

    </div>


</div>
<div class="mx-auto flex items-center justify-center pb-20 ">
{{$products->appends(request()->input())->links()}}
</div>

@endsection

@section('extra-js')
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{asset('js/algolia.js')}}"></script>
@endsection
