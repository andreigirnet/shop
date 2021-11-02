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
                    <table class="w-full">
                        <tr  class="border border-2 h-12">
                            <th class="border border-2">Order Id</th>
                            <th class="border border-2 ml-4">Order Details</th>
                            <th class="border border-2">Order Total Price</th>
                            <th class="border border-2">Products</th>
                        </tr>
                    @foreach($orders as $order)
                            <tr style="text-align:center" class="hover:bg-gray-200 py-4s">
                                <td>{{$order->id}}</td>
                                <td><a href="{{route('orders.show',$order->id)}}" class="text-blue-500">Order Details</a></td>
                                <td>{{presentPrice($order->billing_total)}}</td>
                                <td>
                                    @foreach($order->products as $product)
                                            <div class="text-gray-600 font-semibold">{{$product->name}}</div>
                                            <div class="flex justify-center">
                                                <div><img class="w-32 h-20 mt-2 " src="{{asset($product->image)}}" alt="Product Image"></div>
                                            </div>
                                    @endforeach
                                </td>
                            </tr>
                    @endforeach
                    </table>
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

