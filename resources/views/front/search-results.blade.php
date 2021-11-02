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
    </div>
    <div class="w-full h-16 bg-gray-200 flex items-center justify-between">
        <div class="ml-36 flex items-center justify-center">
            <div><a href="/">home </a></div>
            <div>></div>
            <div><a href="{{route('front.shop')}}">shop</a></div>
            <div>></div>
            <div>Search</div>
        </div>
        @include('partials.search')
    </div>

    <div class=" mx-auto" style="width: 1200px">
        @if(session()->has('success'))

            <div class="bg-green-300 text-green-700 w-full h-14 flex rounded-lg items-center"><div class="ml-4">{{session()->get('success')}}</div></div>
        @endif
        @if(count($errors)>0)
            @foreach($errors->all() as $error)
                <div class="bg-red-300 text-white w-full h-14 flex rounded-lg items-center"><div class="ml-4">{{$error}}</div></div>
            @endforeach
        @endif
        <h1 class="text-3xl font-semibold text-gray-600 mt-4">Search Results</h1>
        <div class="text-lg font-medium">{{$products->total()}} result(s) for '{{request()->input('query')}}'</div>
        <div class="pb-28">

                <table class="" style="border: 1px solid gray; width: 1200px; padding-bottom: 100px" >
                    <thead>
                    <tr style="border-bottom: 1px solid black" >
                        <th scope="col" class="px-2 py-2">name</th>
                        <th scope="col" class="px-2 py-2">Details</th>
                        <th scope="col" class="px-2 py-2">Description</th>
                        <th scope="col" class="px-2 py-2">Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr style="border-bottom: 1px solid black">
                            <th style="border-right:  1px solid black" class="px-2 py-2"><a style="text-decoration: none" class="text-black-50" href="{{route('front.show', $product->slug)}}">{{$product->name}}</a></th>
                            <td style="border-right:  1px solid black" class="px-2 py-2">{{$product->details}}</td>
                            <td style="border-right:  1px solid black" class="px-2 py-2">{!!\Illuminate\Support\Str::limit($product->description, 80)!!}</td>
                            <td style="border-right:  1px solid black" class="px-2 py-2">{{$product->presentPrice()}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
        </div>
            <div class="mx-auto flex items-center justify-center pb-20 ">
                {{$products->appends(request()->input())->links()}}
            </div>
    </div>
    </div>
@endsection

@section('extra-js')
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{asset('js/algolia.js')}}"></script>
@endsection
