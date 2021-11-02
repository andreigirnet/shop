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
    <div>
        @if(session()->has('success'))

            <div class="bg-green-300 text-green-700 w-full h-14 flex justify-center  items-center"><div class="ml-4">{{session()->get('success')}}</div></div>
        @endif
        @if(count($errors)>0)
            @foreach($errors->all() as $error)
                <div class="bg-red-300 text-white w-full h-14 flex justify-center  items-center"><div class="ml-4">{!!$error!!}</div></div>
            @endforeach
        @endif
    </div>
    <div class="w-3/4 mx-auto pb-24">
        <hr class="mt-8" style="width: 80px; height:2px; background-color:gray">
        <div class="text-3xl font-bold mt-2">Checkout</div>
        <hr class="mt-2" style="width: 80px; height:3px; background-color:gray">
        <div class="flex justify-between">
            <div class="w-2/4">
                <form action="{{route('checkout.store')}}" method="post" id="payment-form">
                    @csrf
                    <div class="font-bold mt-8">Billing Details</div>
                    <div class="mt-4">
                        <div>
                            <label for="email">Email Address</label>
                            @if(auth()->user())
                                <input id="email" name="email" type="email" value="{{auth()->user()->email}}" class="border border-gray-500 py-4 h-8 w-full" readonly>
                            @else
                                <input id="email" name="email" type="email" value="{{old('email')}}" class="border border-gray-500 py-4 h-8 w-full" required>
                            @endif
                        </div>
                        <div class="mt-4">
                            <label  for="name" >Name</label>
                            <input id="name" name="name" type="name" value="{{old('name')}}" class="border border-gray-500 py-4 h-8 w-full" required>
                        </div>
                        <div class="mt-4">
                            <label  for="address" >Address</label>
                            <input id="address" name="address" type="name" value="{{old('address')}}" class="border border-gray-500 py-4 h-8 w-full" required>
                        </div>
                        <div class="flex">
                            <div class="mt-4">
                                <label  for="city">City</label>
                                <input id="city" name="city" type="name" value="{{old('city')}}" style="width: 225px" class="border border-gray-500 py-4 h-8 w-full" required>
                            </div>
                            <div class="mt-4">
                                <label  for="province" style="margin-left: 120px">Province</label>
                                <input id="province" name="province" style="width: 225px; margin-left: 120px" value="{{old('province')}}" type="name" class="border border-gray-500 py-4 h-8 w-full" required>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="mt-4">
                                <label  for="city">Post Code</label>
                                <input id="city" style="width: 225px" name="zip" type="name" value="{{old('zip')}}" class="border border-gray-500 py-4 h-8 w-full" required>
                            </div>
                            <div class="mt-4 ml-28">
                                <label  for="province" >Phone</label>
                                <input id="province" style="width: 225px" name="phone" value="{{old('phone')}}" type="name" class="border border-gray-500 py-4 h-8 w-full" required>
                            </div>
                        </div>

                    </div>

                    <!--Card payment section-->
                    <div>
                        <div class="font-bold mt-12">Payment Details</div>
                           <div class="form-group mt-4">
                               <label for="card-element">Credit or Debit Card</label>
                               <div id="card-element" class="mt-2"></div>
                               <div id="card-errors" role="alert"></div>
                           </div>
                    </div>
                    <button type="submit" id="complete-order" class="w-full w-full h-10 bg-green-500 text-white mt-4">Complete order</button>
                </form>
            </div>

            <div>
                <div class="font-bold mt-12">Your Order</div>
                <hr class="mt-8">
                @foreach(Cart::content() as $item)
                <div class="flex items-center mt-2">
                    <div>
                            <img class=" w-20 h-12" src="{{asset($item->model->image)}}" alt="">
                    </div>
                    <div class="ml-4 text-xs">
                        <div >{{$item->model->name}}</div>
                        <div class="text-gray-500">{{$item->model->details}}</div>
                    </div>
                    <div class="ml-4 ">
                        <div class="border border-green-500 px-2 rounded-lg"> {{$item->qty}}</div>
                    </div>
                    <div class="ml-2 text-gray-500">{{$item->model->presentPrice()}} </div>
                </div>
                @endforeach
                <hr class="mt-2">
                <div class="mt-4">
                    <div class="flex relative">
                        <div>Subtotal</div>
                        <div class="ml-8 absolute right-2">{{presentPrice(Cart::subtotal())}} </div>
                    </div>


                    <div class="flex relative">
                        <div>
                            @if(session()->has('coupon'))
                                <div class="flex">
                                    <div>  Discount({{session()->get('coupon')['name']}}) </div>
                                    <form action="{{route('coupon.destroy')}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="border border-red-500 rounded-lg bg-red-500 text-white px-2 ml-2">Remove</button>
                                    </form><br>
                                <hr>
                                </div>
                                <div class=" flex justify-between">
                                    <div>New Subtotal</div>
                                    <div class="ml-56">{{presentPrice($newSubtotal)}}</div>
                                </div>
                            @endif
                        </div>


                        @if(session()->has('coupon'))
                        <div class="ml-8 absolute right-2"> -{{presentPrice($discount)}}</div>
                        @endif
                    </div>
                        <hr class="mt-2">


                    <div class="flex relative">
                        <div>Tax</div>
                        <div class="ml-8 absolute right-2">{{presentPrice($newTax)}} </div>
                    </div>
                    <div class="flex relative">
                        <div class="font-bold">Total</div>
                        <div class="ml-8 absolute right-2 font-bold">{{presentPrice($newTotal)}} </div>
                    </div>
                </div>
                <hr class="mt-6">
                @if(!session()->has('coupon'))
                <div class="mt-4">Have a discount code?</div>
                <div class=" w-80 h-16 flex items-center justify-center mt-4">
                    <form action="{{route('coupon.store')}}"  method="POST">
                        @csrf
                        <input name="coupon_code" id="coupon_code" style="text-indent: 20px;" class="border border-gray-400  h-12 w-60 outline-none text-left" type="text" placeholder="Discount code">
                        <button type="submit"><div style="padding: 11px 13px 11px 13px" class="border border-gray-500   cursor-pointer font-semibold">Apply</div></button>
                    </form>
                </div>

                 @endif
            </div>
        </div>

    </div>

@endsection
@section('extra-js')

    <script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
    <script>
        (function(){
            // Create a Stripe client
            var stripe = Stripe('pk_test_51HJHhqGuBOVjlmw2SvuuQUupgH3mgeOfUOTTMIqkaOpSboXJ2vtduS9a0o1KNtWDMcpuOAm8c2ROzTI0zFcSV9XS003c9c1q9E');
            // Create an instance of Elements
            var elements = stripe.elements();
            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
                base: {
                    color: '#32325d',
                    lineHeight: '18px',
                    fontFamily: '"Roboto", Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };
            // Create an instance of the card Element
            var card = elements.create('card', {
                style: style,
                hidePostalCode: true
            });
            // Add an instance of the card Element into the `card-element` <div>
            card.mount('#card-element');
            // Handle real-time validation errors from the card Element.
            card.addEventListener('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });
            // Handle form submission
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                // Disable the submit button to prevent repeated clicks
                document.getElementById('complete-order').disabled = true;
                //var options = {
               //     name: document.getElementById('name_on_card').value,
               //     address_line1: document.getElementById('address').value,
                //    address_city: document.getElementById('city').value,
                //    address_state: document.getElementById('province').value,
               //     address_zip: document.getElementById('postalcode').value
               // }
                stripe.createToken(card).then(function(result) {
                    if (result.error) {
                        // Inform the user if there was an error
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;

                        document.getElementById('complete-order').disabled = false;
                    } else {
                        // Send the token to your server
                        stripeTokenHandler(result.token);
                    }
                });
            });
            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);
                // Submit the form
                form.submit();
            }
        })();
    </script>
@endsection
