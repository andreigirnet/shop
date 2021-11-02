@extends('layouts.app')
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
    <div class="w-2/3 mx-auto mt-72 h-2/3 text-center">
        <div class="font-bold text-2xl ">Thank you for</div>
        <div class="font-bold text-2xl ">Your order</div>
        <div>A confirmation email was sent</div>
        <div class="mt-4 mx-auto border border-gray-500 px-4 py-2 cursor-pointer w-32 text-gray-500 hover:bg-gray-500 hover:text-white"><a href="{{route('home')}}">Home Page</a></div>
    </div>
@endsection
