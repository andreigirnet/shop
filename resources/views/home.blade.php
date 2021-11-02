@extends('layouts.app')
@section('content')
{{--    <form method="POST" action="{{ route('logout') }}">--}}
{{--        @csrf--}}
{{--        <button type="submit" class="btn btn-primary">Logout</button>--}}
{{--    </form>--}}
    <div  class=" w-full">
        <div  id="header" >
            <!--Section for nav bar-->
            <div class="h-16 w-full bg-black flex items-center justify-between">
                <div class="text-white ml-8">+447365365156</div>
                @include('partials.menus.main-right')
            </div>
            <div class="py-6 flex justify-between items-center" id="nav-wrap">
                <div style="color: gray" class="left flex items-center ml-20 bg text-gray-700" style="margin-left: 100px">
                    <a href="{{route('home')}}"> <div class="text-2xl font-bold text-gray-800 cursor-pointer " id="title">SHOP</div></a>
                    <nav style="list-style: none; margin-left: 300px " class="flex items-center text-gray-700 font-semibold">
                        <li  class="cursor-pointer hover:text-red-500 li-nav">HOME</li>
                        <a href="{{route('front.shop')}}"><li  class="ml-12 hover:text-red-500 cursor-pointer li-nav">SHOP</li></a>
                        <li  class="ml-12 hover:text-red-500 cursor-pointer li-nav">CATEGORY</li>
                        <li  class="ml-12  hover:text-red-500 cursor-pointer li-nav">BLOG</li>
                    </nav>
                    <!--search input algolia-->
                    <div class="aa-input-container mr-6" id="aa-input-container">
                        <input type="search" id="aa-search-input" class="aa-input-search rounded-2xl" style="width: 200px; margin-left: 100px;" placeholder="Search for items" name="search"
                               autocomplete="off" />
                        <svg class="aa-input-icon" viewBox="654 -372 1664 1664">
                            <path d="M1806,332c0-123.3-43.8-228.8-131.5-316.5C1586.8-72.2,1481.3-116,1358-116s-228.8,43.8-316.5,131.5  C953.8,103.2,910,208.7,910,332s43.8,228.8,131.5,316.5C1129.2,736.2,1234.7,780,1358,780s228.8-43.8,316.5-131.5  C1762.2,560.8,1806,455.3,1806,332z M2318,1164c0,34.7-12.7,64.7-38,90s-55.3,38-90,38c-36,0-66-12.7-90-38l-343-342  c-119.3,82.7-252.3,124-399,124c-95.3,0-186.5-18.5-273.5-55.5s-162-87-225-150s-113-138-150-225S654,427.3,654,332  s18.5-186.5,55.5-273.5s87-162,150-225s138-113,225-150S1262.7-372,1358-372s186.5,18.5,273.5,55.5s162,87,225,150s113,138,150,225  S2062,236.7,2062,332c0,146.7-41.3,279.7-124,399l343,343C2305.7,1098.7,2318,1128.7,2318,1164z" />
                        </svg>
                    </div>
                    <div id="wishist" class="border border-gray-500 px-4 py-4 rounded-full ml-12 relative cursor-pointer hover:bg-gray-100">
                        <i class="far fa-heart "></i>
                        @if(Cart::instance('saveForLater')->count())
                        <div class="wish-counter absolute w-6 h-6 rounded-full bg-red-500 flex items-center justify-center text-white"><div>
                            {{Cart::instance('saveForLater')->count()}}</div></div>
                        @endif
                    </div>
                    <div style="position: relative" x-data="{cart: false}">
                        <div id="cart" @mouseover="cart=!cart" @mouseout="cart = false" class="border border-gray-500 px-4 py-4 rounded-full ml-12 relative cursor-pointer hover:bg-gray-100">
                            <a href="{{route('front.cart')}}"><i class="fas fa-shopping-cart"></i>
                            @if(Cart::instance('default')->count())
                            <div class="cart-counter absolute w-6 h-6 rounded-full bg-red-500 flex items-center justify-center text-white"><div>
                                {{Cart::instance('default')->count()}}</div></div>
                            @endif
                            </a>
                        </div>
                        <div s class="w-72 bg-white rounded-lg {{Cart::content()->count()>3 ? 'cart-scroll':''}}" @mouseover="cart=!cart" @mouseout="cart = false" style="position: absolute; z-index: 22; bottom: -155px; right: -170px; height: 154px" x-show="cart">
                            @foreach(Cart::content() as $item)

                                <a href="{{route('front.cart')}}">
                                    <div style="margin-top: 2px; " class=" w-full h-12 flex items-center  hover:bg-red-200">
                                        <div><img src="{{asset($item->model->image)}}" class="w-16 h-12" alt=""></div>
                                        <div class="ml-4">{{$item->model->name}}</div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        {{--banner with images--}}
        <!-- Slider main container -->
            <div class="swiper">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide bg-blue-300 bg-opacity-70">
                        <div class="flex w-full relative">
                        <img src="{{asset('assets/photos/lady.webp')}}" alt="">
                        <div id="right-slide">
                            <div style="font-family: Yellowtail,cursive; font-style: italic; color: #2577fd; font-size:40px;">50% Discount</div>
                            <div class="font-bold" style="font-family:Playfair Display,serif; font-size: 100px; line-height: 1.1; text-transform: capitalize">Winter </div>
                            <div class="font-bold" style="font-family:Playfair Display,serif; font-size: 100px; line-height: 1.1; text-transform: capitalize">Collection</div>
                            <div style="font-family:Playfair Display,serif; font-style: italic; font-size: 20px; font-weight:300;margin-bottom: 50px; color:#313639;">Newest items on the market</div>
                            <button class="w-32 h-12 rounded-2xl bg-blue-600 text-white py-2">Shop Now</button>
                        </div>
                        </div>
                    </div>
                    <div class="swiper-slide bg-blue-300 bg-opacity-70"><img style="width: 100%;" src="{{asset('assets/photos/banner2.jpg')}}" alt=""></div>
                    <div class="swiper-slide bg-blue-300 bg-opacity-70"><img src="{{asset('assets/photos/banner3.jpg')}}" alt=""></div>
                </div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>


            </div>
            <!--End of Section for nav bar-->
            <!--Section Header info-->
        </div>
            <!--Featured items-->
            <div class=" mx-auto  mt-44">
                <div class="text-5xl text-black font-semibold text-center  w-full">Shop by category</div>
                <div class=" w-9/12 grid grid-cols-3 gap-x-8 gap-y-12 mx-auto mt-20 ">
                    @foreach($categories as $category)
                        <a href="{{route('front.shop')}}">
                            <div style="height: 100px" class="rounded-xl bg-blue-200 cursor-pointer flex items-center justify-center hover:bg-blue-400 hover:text-white">
                                <div class="font-semibold text-xl ">{{$category->name}}</div>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="w-full mb-12">
                    <a href="{{route('front.shop')}}"> <div class="mx-auto text-center mt-20 w-52 border-2 border-gray-500 px-4 text-gray-500 font-normal py-2 px-4  cursor-pointer hover:bg-gray-500 hover:text-white">View more products</div></a>
                </div>
            </div>
        <div x-data="{ tab: 'tab1' }">
            <div class="w-9/12 mx-auto flex items-center justify-between mt-44" >
                <div class="text-5xl text-black font-semibold">Latest Products</div>
                <div class="flex items-center font-semibold text-lg text-gray-700 mt-4">
                    <div style="transition: 0.8s" class="hover:text-red-400 mr-8 cursor-pointer" :class="{'text-red-700' : tab==='tab1'}">
                        <div @click="tab = 'tab1'">All</div>
                    </div>
                    <div style="transition: 0.8s" class="hover:text-red-400 mr-8 cursor-pointer" :class="{'text-red-700' : tab==='tab2'}">
                        <div  @click="tab = 'tab2'">New</div>
                    </div>
                    <div style="transition: 0.8s" class="hover:text-red-400 mr-8 cursor-pointer" :class="{'text-red-700' : tab==='tab3'}">
                        <div  @click="tab = 'tab3'">Featured</div>
                    </div>
                    <div style="transition: 0.8s" class="hover:text-red-400 mr-4 cursor-pointer" :class="{'text-red-700' : tab==='tab4'}">
                        <div  @click="tab = 'tab4'">Offer</div>
                    </div>
                </div>
            </div>
            <hr style="width:80%; margin: 20px auto 0 auto" >

            <div class=" w-9/12 grid grid-cols-3 gap-x-8 gap-y-12 mx-auto mt-20">

                    @foreach($products as $product)
                        <div style="height: 500px" class="rounded-xl "  x-show="tab === 'tab1'">
                            <a href="{{route('front.show', $product->slug)}}">
                            <img style="height: 300px; width: 350px" src="{{asset($product->image)}}" alt="">
                            <div style="text-align: center; color: #383838;" class="mt-8 text-xl">{{$product->name}}</div>
                            <div style="text-align: center; color: #383838" class="mt-2 text-lg font-bold">{{presentPrice($product->price)}}</div>
                            </a>
                        </div>
                    @endforeach

                    @foreach($latest as $product)
                            <div style="height: 500px" class="rounded-xl "  x-show="tab === 'tab2'">
                                <a href="{{route('front.show', $product->slug)}}">
                                <img style="height: 300px; width: 350px" src="{{asset($product->image)}}" alt="">
                                <div style="text-align: center; color: #383838;" class="mt-8 text-xl">{{$product->name}}</div>
                                <div style="text-align: center; color: #383838" class="mt-2 text-lg font-bold">{{presentPrice($product->price)}}</div>
                                </a>
                            </div>
                    @endforeach

                    @foreach($featured as $product)
                            <div style="height: 500px" class="rounded-xl "  x-show="tab === 'tab3'">
                                <a href="{{route('front.show', $product->slug)}}">
                                    <img style="height: 300px; width: 350px" src="{{asset($product->image)}}" alt="">
                                    <div style="text-align: center; color: #383838;" class="mt-8 text-xl">{{$product->name}}</div>
                                    <div style="text-align: center; color: #383838" class="mt-2 text-lg font-bold">{{presentPrice($product->price)}}</div>
                                </a>
                            </div>
                    @endforeach

                    @foreach($offer as $product)
                            <div style="height: 500px" class="rounded-xl "  x-show="tab === 'tab4'">
                                <a href="{{route('front.show', $product->slug)}}">
                                <img style="height: 300px; width: 350px" src="{{asset($product->image)}}" alt="">
                                <div style="text-align: center; color: #383838;" class="mt-8 text-xl">{{$product->name}}</div>
                                <div style="text-align: center; color: #383838" class="mt-2 text-lg font-bold">{{presentPrice($product->price)}}</div>
                                </a>
                            </div>
                    @endforeach
            </div>
        </div>

        <div style="padding-bottom: 100px; margin-top: 100px" id="home-blog" class="w-full mt-6 pb-12 position absolute ">
                <div class="text-center text-4xl font-semibold mt-8 ">From Our Blog</div>
                <div class="w-2/4 text-center mx-auto mt-8">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, doloremque esse facilis id ipsa maiores minima odio? C repellat, sequi velit voluptates! Praesentium!</div>
                <div class=" w-9/12 grid grid-cols-3 gap-x-8 gap-y-12 mx-auto mt-20">
                    @foreach($posts as $post)
                        <div style="height: 500px" class="rounded-xl post-body">
                            <img src="{{asset('storage/'.$post->image)}}" alt="">
                            <div style="text-align: center; color: #383838;" class="mt-8 text-xl">{{$post->title}}</div>
                            <div style="text-align: center; color: #383838" class="mt-2 text-lg font-bold">{{\Illuminate\Support\Str::limit($post->excerpt, $limit = 80, $end = '...')}}</div>
                        </div>
                    @endforeach
                </div>
        </div>
            <!--Footer-->


    </div>

@endsection
