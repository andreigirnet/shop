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

    <div class=" w-full">
        <div id="container-login" class=" flex justify-around mx-auto">
            <div id="left-login" class="">
                <div class="font-bold text-3xl text-gray-500 ml-8">Register</div>
                <form method="POST" class="mt-4 ml-8" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group row">
                      <label for="name" class="text-xl font-semibold text-gray-700">{{ __('Name') }}</label>
                        <div class="col-md-6"><input id="name" type="text" class="border border-gray-500 w-96 h-12 pl-4 rounded-lg mt-2 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="text-red-700" role="alert">
                                 <strong>{{ $message }}</strong>
                            </span>
                             @enderror
                               </div>
                        </div>

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
                    <div class="form-group row">
                      <label for="password-confirm" class="text-xl font-semibold text-gray-700 mt-2">{{ __('Confirm Password') }}</label>
                      <div class="col-md-6">
                           <input id="password-confirm" type="password" class="border border-gray-500 w-96 h-12 pl-4 rounded-lg font-semibold mt-2" name="password_confirmation" required autocomplete="new-password">
                      </div>
                    </div>



                    <div class="mt-8">
                        <div class="flex justify-between mr-32 ">
                            <button type="submit" class="w-32 h-12 bg-gray-900 rounded-lg text-white">
                                {{ __('Register') }}
                            </button>
                            <div class="mt-2">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <div class="text-xs">Already have and account?</div>
                                        <a href="{{route('login')}}" class="text-xs font-bold">Login</a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </form>

            </div>
            <div class="vl"></div>
            <div id="right-login" class=>
                <div class="font-bold text-3xl text-gray-500">Benefits</div>
                <div class="font-bold text-gray-600 mt-8">Save time now.</div>
                <div class="text-gray-500 text-xl mt-4 w-80">Creating an account will allow you to checkout faster and you will be able to easy checkout in future</div>

            </div>
        </div>
    </div>


{{--    <div id="nav-bar" class="flex justify-between w-full h-20 bg-gray-500 items-center">--}}
{{--        <div class="left flex items-center ml-20" style="margin-left: 100px">--}}
{{--            <a href="{{route('home')}}"> <div class="text-2xl font-bold text-white cursor-pointer " id="title">SHOP</div></a>--}}
{{--            <nav>--}}
{{--                {{menu('left','partials.menus.main')}}--}}
{{--            </nav>--}}
{{--        </div>--}}
{{--        <div class="right" style="margin-right: 100px">--}}
{{--            @include('partials.menus.main-right')--}}
{{--        </div>--}}
{{--    </div>--}}
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Register') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('register') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>--}}

{{--                                @error('name')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">--}}

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
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Register') }}--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@endsection
