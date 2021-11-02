<ul class="flex items-center mr-8">
    @guest
    <li class="text-md font-medium text-white ml-12 cursor-pointer rounded-lg px-4 py-2 hover:bg-gray-700 flex"><a href="/register">Sign Up</a></li>
    <li class="text-md font-medium text-white ml-12 cursor-pointer rounded-lg px-4 py-2 hover:bg-gray-700 flex"><a href="/login">Login</a></li>
    @else
        <li>
            <a class="text-md font-medium text-white ml-12 cursor-pointer rounded-lg px-4 py-2 hover:bg-gray-700 flex" href="{{route('dashboard')}}">My Account</a>
        </li>
        <a class="text-md font-medium text-white ml-12 cursor-pointer rounded-lg px-4 py-2 hover:bg-gray-700 flex" href="{{route('logout')}}" onclick="event.preventDefault();
           document.getElementById('logout-form').submit();
        ">Logout</a>
        <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none">
            @csrf
        </form>
    @endguest
    <li class="text-md font-medium text-white ml-12 cursor-pointer rounded-lg px-4 py-2 hover:bg-gray-700 flex"><a href="{{route('front.cart')}}">Cart</a></li>
        @if(Cart::instance('default')->count())
    <div class="bg-yellow-500 flex items-center text-xs justify-center  h-8 rounded-full w-8 text-white font-semibold">

        <div>{{Cart::instance('default')->count()}}</div>
    </div>
        @endif


</ul>
