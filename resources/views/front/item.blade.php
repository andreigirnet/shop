@extends('layouts.app')
@section('extra-css')
    <link rel="stylesheet" href="{{asset('css/algolia.css')}}">
@endsection
@section('content')
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
            <div>></div>
            <div>{{$product->slug}}</div>
        </div>
        @include('partials.search')
    </div>
    <div class="flex w-3/4 mx-auto mt-20 pb-64">
        @if(session()->has('success'))

            <div class="bg-green-300 text-green-700 w-full h-14 flex rounded-lg items-center"><div class="ml-4">{{session()->get('success')}}</div></div>
        @endif
        @if(count($errors)>0)
            @foreach($errors->all() as $error)
                <div class="bg-red-300 text-white w-full h-14 flex rounded-lg items-center"><div class="ml-4">{{$error}}</div></div>
            @endforeach
        @endif
        <div style="width:600px" class="h-80 mt-8 flex items-center justify-center">
            <div>
            @if($product->image)
            <img class="w-96 h-80 rounded-lg active" id="currentImage" src="{{productImage($product->image)}}" alt="">
            @endif
                <div class="grid grid-cols-6 mt-8 gap-x-24">
                    <div class=" w-20 h-20 ml-2 thumbnails"><img class="w-20 h-20 cursor-pointer rounded-lg border border-gray-500" src="{{productImage($product->image)}}" alt=""></div>
                    @if($product->images)
                    @foreach(json_decode($product->images, true) as $image)
                        <div class="w-20 h-20 ml-2 thumbnails"><img class="w-20 h-20 border border-gray-500 cursor-pointer rounded-lg" src="{{productImage($image)}}" alt=""></div>
                    @endforeach
                        @endif
                </div>
            </div>
        </div>
        <div class="w-full ml-20">
            <div class="text-3xl font-bold mt-2">{{$product->name}}</div>
            <div class="font-semibold text-gray-500">{{$product->details}}</div>

            <div>{!!$stockLevel!!}</div>
            <div class="text-3xl font-bold mt-2">{{$product->presentPrice()}} </div>
            <div class="w-3/4 mt-4">{!!$product->description!!}</div>
            <form action="{{route('cart.store', $product)}}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$product->id}}">
                <input type="hidden" name="name" value="{{$product->name}}">
                <input type="hidden" name="price" value="{{$product->price}}">
                @if($product->quantity>0)
            <button type="submit" class="border border-gray-400 cursor-pointer hover:bg-gray-700 hover:text-white w-40 h-12 mt-12 text-lg font-semibold flex items-center justify-center "><div>Add To Cart</div></button>
                @endif
            </form>
        </div>
    </div>
    <div style="padding-bottom: 100px" id="home-blog" class="w-full bg-gray-200 mt-6 pb-12 position absolute ">
        <div class="text-center text-3xl font-semibold mt-8 ">You might also like...</div>
        <div class="grid grid-cols-4 gap-28 w-3/4 mx-auto mt-8">
            @foreach($mightAlsoLike as $product)
                <a href="{{route('front.show',$product->slug)}}">
                    <div class="h-64 w-64 bg-white border border-gray-500 flex items-center justify-center">
                        <div class="block text-center"><img class="" src="{{asset('assets/photos/macbook-pro.png')}}" alt="">
                            <div class="text-m font-bold mt-2 text-gray-500">{{$product->name}}</div>
                            <div class="text-m font-bold mt-2 text-gray-500">{{$product->presentPrice()}} $</div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    </div>
@endsection

@section('gallery.js')
    <script>
        (function(){
            const currentImage = document.querySelector('#currentImage');
            const images = document.querySelectorAll('.thumbnails');
            images.forEach((element)=>element.addEventListener('click',thumbnailClick));

            function thumbnailClick(e){

                currentImage.src = this.querySelector('img').src;
                images.forEach((element)=>element.classList.remove('selected'))
                this.classList.add('selected');
            }
        }())
    </script>
@endsection

@section('extra-js')
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{asset('js/algolia.js')}}"></script>
@endsection
