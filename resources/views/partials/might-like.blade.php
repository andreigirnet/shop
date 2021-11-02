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
