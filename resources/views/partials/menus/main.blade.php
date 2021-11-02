<ul class="flex items-center">
    @foreach($items as $menu_item)

        <li class="text-lg font-medium text-white ml-12 cursor-pointer rounded-lg px-4 py-2 hover:bg-gray-700 flex">
            <a href="{{ $menu_item->link() }}">
                {{ $menu_item->title }}
                @if($menu_item->title ==='CART')

                @endif
            </a>
        </li>

    @endforeach

</ul>



{{--<ul >--}}
{{--    <li class="text-lg font-medium text-white ml-12 cursor-pointer rounded-lg px-4 py-2 hover:bg-gray-700">--}}
{{--        <a href="{{route('front.shop')}}">SHOP</a></li>--}}
{{--    <li class="text-lg font-medium text-white ml-12 cursor-pointer rounded-lg px-4 py-2 hover:bg-gray-700">ABOUT</li>--}}
{{--    <li class="text-lg font-medium text-white ml-12 cursor-pointer rounded-lg px-4 py-2 hover:bg-gray-700">BLOG</li>--}}
{{--    <li class="text-lg font-medium text-white ml-12 cursor-pointer rounded-lg px-4 py-2 hover:bg-gray-700">--}}
{{--        <div class="flex items-center">--}}
{{--            <div>--}}
{{--                <a href="{{route('front.cart')}}">CART</a>--}}
{{--            </div>--}}
{{--            @if(Cart::instance('default')->count()>0)--}}
{{--                <div class="bg-yellow-500 flex items-center text-xs justify-center ml-2 h-8 rounded-full w-8">--}}
{{--                    <div c>{{Cart::instance('default')->count()}}</div>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        </div>--}}
{{--    </li>--}}
{{--</ul>--}}
