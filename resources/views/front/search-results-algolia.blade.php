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

            <div class=" flex justify-center ">
                <div>
                    <div id="search-box" class="mx-auto">

                    </div>
                    <div id="stats-container">

                    </div>
                </div>
            </div>
            <div id="algolia-right" class="mt-8">
                <div id="hits">

                </div>
                <div class="flex w-full">
                    <div id="pagination" class="mt-8 mx-auto pb-12">

                    </div>
                </div>
            </div>

    </div>

@endsection



