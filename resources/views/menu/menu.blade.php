<ul class="flex items-center">
    @foreach($items as $menu_item)

        <li class="text-lg font-medium text-white ml-12 cursor-pointer rounded-lg px-4 py-2 hover:bg-gray-700 flex">
            <a href="{{ $menu_item->link() }}" class="flex">
                {{ $menu_item->title }}
                @if($menu_item->title ==='CART')
                    @if(Cart::instance('default')->count() > 0)
                        <div class="bg-yellow-500 flex items-center text-xs justify-center ml-2 h-8 rounded-full w-8">
                            <div>{{Cart::instance('default')->count()}}</div>
                        </div>
                    @endif
                @endif
            </a>
        </li>

    @endforeach
</ul>
