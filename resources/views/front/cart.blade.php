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
    <div class="w-full h-16 bg-gray-200 flex items-center justify-between">
        <div class="ml-36 flex items-center justify-center">
            <div><a href="/">home </a></div>
            <div>></div>
            <div><a href="{{route('front.shop')}}">shop</a></div>
        </div>
        @include('partials.search')
    </div>
    <div class="w-3/4 mx-auto mt-12 pb-24">
        <div class="w-2/4">
            @if(session()->has('success'))

            <div class="bg-green-300 text-green-700 w-full h-14 flex rounded-lg items-center"><div class="ml-4">{{session()->get('success')}}</div></div>
            @endif
            @if(count($errors)>0)
                @foreach($errors->all() as $error)
                    <div class="bg-red-300 text-white w-full h-14 flex rounded-lg items-center"><div class="ml-4">{{$error}}</div></div>
                    @endforeach
            @endif
             @if(Cart::count() > 0)

            <div class="text-xl font-bold mt-4">{{Cart::count()}} Item(s) in your Shopping Cart</div>
            <hr class="mt-8">
                @foreach(Cart::content() as $item)
            <div class="flex items-center mt-2">
                <div><a href="{{route('front.show', $item->model->slug)}}">
                            <img class="w-20 h-12" src="{{asset($item->model->image)}}" alt="">
                    </a>
                </div>
                <div class="ml-4 text-xs">
                    <div ><a href="{{route('front.show', $item->model->slug)}}">{{$item->model->name}}</a></div>
                    <div class="text-gray-500">{{$item->model->details}}</div>
                </div>
                <div class="ml-24 text-xs">
                    <form action="{{route('cart.destroy', $item->rowId)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500" type="submit">Remove</button>
                    </form>
                    <form action="{{route('cart.switchToSaveForLater', $item->rowId)}}" method="POST">
                        @csrf
                        <button type="submit">Save for later</button>
                    </form>
                </div>
                <div class="ml-4 border border-gray-500">
                    <select name="quantity"class="quantity" data-id="{{$item->rowId}}" data-productQuantity="{{$item->model->quantity}}">
                        @for($i = 1; $i<5+1; $i++ )
                        <option {{$item->qty == $i ? 'selected':''}}>{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="ml-2 text-gray-500">{{presentPrice($item->subtotal)}} </div>
            </div>
            @endforeach
            <hr class="mt-2">

            <div class="h-36 bg-gray-200 mt-4 flex justify-between items-center">
                <div class="w-2/4 ml-2">Shipping is free because we are kind and think the client doesn't have to support this costs</div>
                <div>
                    <div class="flex mr-2">
                        <div>Subtotal</div>
                        <div class="ml-8">{{presentPrice(Cart::subtotal())}} </div>
                    </div>

                    <div class="flex relative">
                        <div>Tax(13%)</div>
                        <div class="ml-8 absolute right-2">{{presentPrice(Cart::tax())}} </div>
                    </div>
                    <div class="flex relative">
                        <div class="font-bold">Total</div>
                        <div class="ml-8 absolute right-2 font-bold">{{presentPrice(Cart::total())}} </div>
                    </div>

                </div>
            </div>
            <div class="flex justify-between mt-4">
                <a href="{{route('front.shop')}}"><div class="w-48 h-12 border-2 cursor-pointer border-gray-500 flex items-center justify-center hover:bg-gray-200"><div>Continue shopping</div></div></a>
                <a href="{{route('checkout.index')}}"><div class="w-48 h-12 bg-green-700 cursor-pointer text-white flex items-center justify-center hover:bg-green-500"><div>Proceed to checkout</div></div></a>
            </div>
                @else
                 <h3 class="h-12 w-full rounded-lg flex items-center text-red-500"><div>No items in the cart</div></h3>
                @endif
                @if(Cart::instance('saveForLater')->count()>0)
                    <div class="text-xl font-bold mt-4">{{Cart::instance('saveForLater')->count()}} Item(s) saved for later</div>

                    @foreach(Cart::instance('saveForLater')->content() as $item)
                        <div class="flex items-center mt-4">
                            <div><a href="{{route('front.show', $item->model->slug)}}">
                                        <img class="w-20 h-12" src="{{asset($item->model->image)}}" alt="">
                                </a>
                            </div>
                            <div class="ml-4 text-xs">
                                <div ><a href="{{route('front.show', $item->model->slug)}}">{{$item->model->name}}</a></div>
                                <div class="text-gray-500">{{$item->model->details}}</div>
                            </div>
                            <div class="ml-24 text-xs">
                                <form action="{{route('saveForLater.destroy', $item->rowId)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Remove</button>
                                </form>
                                <form action="{{route('saveForLater.switchToCart', $item->rowId)}}" method="POST">
                                    @csrf
                                    <button type="submit">Move to cart</button>
                                </form>
                            </div>
                            <div class="ml-4 border border-gray-500">
                                <select name="" id="">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                </select>
                            </div>
                            <div class="ml-2 text-gray-500">{{$item->model->presentPrice()}} </div>
                        </div>
                    @endforeach
                    <hr class="mt-2">
                @else
            <div class="mt-6 text-semibold">You have no items saved for later</div>
             @endif
        </div>

    </div>
    <div style="padding-bottom: 100px" id="home-blog" class="w-full bg-gray-200 mt-6 pb-12 position absolute ">
        <div class="text-center text-3xl font-semibold mt-8 ">You might also like...</div>
        <div class="grid grid-cols-4 gap-28 w-3/4 mx-auto mt-8">
            @foreach($mightAlsoLike as $product)
                <a href="{{route('front.show',$product->slug)}}">
                    <div class="h-80 w-64 bg-white border border-gray-500 flex items-center justify-center">
                        <div class="block text-center">
                            @if($product->image)
                                <img class="" src="{{asset('storage/'.$product->image)}}" alt="">
                            @endif
                            <div class="text-m font-bold mt-2 text-gray-500">{{$product->name}}</div>
                            <div class="text-m font-bold mt-2 text-gray-500">{{$product->presentPrice()}} </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
@section('cart-js')
    <script src="{{asset('js/app.js')}}"></script>
    <script>
        (function(){
            const classname = document.querySelectorAll('.quantity');
            Array.from(classname).forEach(function(element){
                element.addEventListener('change', function(){
                    const id = element.getAttribute('data-id')
                    const productQuantity = element.getAttribute('data-productQuantity')
                    axios.patch(`/cart/${id}`, {
                        quantity: this.value,
                        productQuantity: productQuantity
                    })
                        .then(function (response) {
                            console.log(response);
                            window.location.href = '{{route('front.cart')}}'
                        })
                        .catch(function (error) {
                            console.log(error);
                            window.location.href = '{{route('front.cart')}}'
                        });
                })
            })
        })();
    </script>
@endsection
@section('extra-js')
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{asset('js/algolia.js')}}"></script>
@endsection
