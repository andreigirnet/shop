@extends('layouts.app')
@section('content')
    <div>
        <div id="nav-bar" class="flex justify-between w-full h-20 bg-black items-center">
            <div class="left flex items-center ml-20" style="margin-left: 100px">
                <a href="{{route('home')}}"> <div class="text-2xl font-bold text-white cursor-pointer " id="title">Shop</div></a>
                <nav>
                    {{menu('left','partials.menus.main')}}
                </nav>
            </div>
            <div class="right" style="margin-right: 100px">
                @include('partials.menus.main-right')
            </div>
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
                <div class="font-bold">Your Dashboard</div>
                <div class="mt-2">
                    <ul>
                        <a class="" href="{{route('dashboard')}}"><li class="mt-4 text-gray-600 text-lg cursor-pointer text-gray-600 hover:text-gray-400">My Profile</li></a>
                        <a class="" href="{{route('orders.index')}}"><li class="mt-4 text-gray-600 text-lg cursor-pointer text-gray-600 hover:text-gray-400">My Orders</li></a>
                    </ul>
                </div>
                <div>
                </div>
            </div>
            <div class="w-full">
                <div>
                    <div class="font-bold text-lg">Order Id: {{$order->id}}</div>
                        <div class="flex items-center font-semibold text-xl mt-4git"><div class=" text-gray-600">The total price paid was: </div>  {{presentPrice($order->billing_total)}}</div>
                        <div class="flex items-center justify-center mt-8">
                            @foreach($products as $product)
                                <div class="ml-8 border border-2 rounded-xl px-4 py-4 hover:shadow-lg">
                                    <div class="flex items-center font-semibold text-xl"><div>Product Name: </div>{{$product->name}}</div>
                                    <div class="flex justify-center"><img class="w-40 h-32" src="{{asset($product->image)}}" alt="Product Image"></div>
                                </div>
                            @endforeach
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-js')
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{asset('js/algolia.js')}}"></script>
@endsection

