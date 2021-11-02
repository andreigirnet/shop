@extends('layouts.app')

@section('content')
    <div id="nav-bar" class="flex justify-between w-full h-20 bg-gray-500 items-center">
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

    <div class=" w-full">
        <div id="container-login" class=" flex justify-around mx-auto">
            <div id="left-login" class="">
                <div class="font-bold text-3xl text-gray-500 ml-8">Returning customer</div>
                <form method="POST" class="mt-4 ml-8" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="email" class="text-xl font-semibold text-gray-700">Email Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class=" border border-gray-500 w-96 h-12 pl-4 rounded-lg mt-2 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <div>
                                @error('email')
                                <span class="text-red-700" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="text-xl font-semibold text-gray-700 mt-2">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class=" border border-gray-500 w-96 h-12 pl-4 rounded-lg font-semibold mt-2 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="text-red-700" role="alert">
                                        <strong class="text-red-700">{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>



                    <div class="mt-8">
                        <div class="flex justify-between mr-40 ">
                            <button type="submit" class="w-32 h-12 bg-gray-900 rounded-lg text-white">
                                {{ __('Login') }}
                            </button>
                            <div class="mt-2">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="text-md text-gray-700" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="mt-4">
                            @if (Route::has('password.request'))
                                <a class="text-xs m" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>

            </div>
            <div class="vl"></div>
            <div id="right-login" class=>
                <div class="font-bold text-3xl text-gray-500">New Customer</div>
                <div class="font-bold text-gray-600 mt-8">Save time now.</div>
                <div class="text-gray-500">You don't need an account to check out</div>
                <div class="w-60 h-12 border border-gray-500 flex items-center justify-center font-semibold text-gray-700 hover:text-blue-500 mt-4">
                    <a href="{{route('guestCheckout')}}">Check Out as a Guest</a>
                </div>

                <div class="font-bold text-gray-600 mt-8">Save time later.</div>
                <div class="text-gray-500">Create an account for fast checkout and easy access to order history</div>
                <div class="w-60 h-12 border border-gray-500 flex items-center justify-center font-semibold text-gray-700 hover:text-blue-500 mt-4">
                    <a href="{{route('register')}}">Create an account</a>
                </div>
            </div>
        </div>
    </div>
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Login') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('login') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--                                    <label class="form-check-label" for="remember">--}}
{{--                                        {{ __('Remember Me') }}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-8 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Login') }}--}}
{{--                                </button>--}}

{{--                                @if (Route::has('password.request'))--}}
{{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                        {{ __('Forgot Your Password?') }}--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                                <a href="{{route('guestCheckout')}}">Check Out as a Guest</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@endsection
