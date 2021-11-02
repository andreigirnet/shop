@extends('layouts.app')
@section('content')
    <div>
        <div id="nav-bar" class="flex justify-between w-full h-20 bg-black items-center">
            <div class="left flex items-center ml-20" style="margin-left: 100px">
                <a href="{{route('home')}}"> <div class="text-2xl font-bold text-white cursor-pointer " id="title">Shop</div></a>
                <nav>
                    {{menu('left','partials.menus.main')}}
                </nav>
            </div>
            <div class="right" style="margin-right: 100px">
                @include('partials.menus.main-right')
            </div>
        </div>
        @if(session()->has('success'))

            <div class="bg-green-300 text-green-700 w-full h-14 flex rounded-lg items-center"><div class="ml-4">{{session()->get('success')}}</div></div>
        @endif
        @if(count($errors)>0)
            @foreach($errors->all() as $error)
                <div class="bg-red-300 text-white w-full h-14 flex rounded-lg items-center"><div class="ml-4">{{$error}}</div></div>
            @endforeach
        @endif
        <div class="w-3/4 mx-auto flex mt-8 pb-64" id="content">

            <div class="w-64">
                <div class="font-bold">Your Dashboard</div>
                <div class="mt-2">
                    <ul>
                            <a class="" href="{{route('dashboard')}}"><li class="mt-4 text-gray-600 text-lg cursor-pointer text-gray-600 hover:text-gray-400">My Profile</li></a>
                             <a class="" href="{{route('orders.index')}}"><li class="mt-4 text-gray-600 text-lg cursor-pointer text-gray-600 hover:text-gray-400">My Orders</li></a>
                    </ul>
                </div>
                <div>
                </div>
            </div>
            <div class="w-full">
                <div>
                    <form method="POST" class="mt-4 ml-8" action="{{ route('user.update') }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label for="name" class="text-xl font-semibold text-gray-700">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" value="{{old('name', $user->name)}}" class="border border-gray-500 w-96 h-12 pl-4 rounded-lg mt-2 @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus>
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
                                <input id="email" type="email" value="{{old('email', $user->email)}}" class=" border border-gray-500 w-96 h-12 pl-4 rounded-lg mt-2 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
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
                                <input id="password" type="password" class=" border border-gray-500 w-96 h-12 pl-4 rounded-lg font-semibold mt-2 @error('password') is-invalid @enderror" name="password"  autocomplete="current-password">

                                @error('password')
                                <span class="text-red-700" role="alert">
                                        <strong class="text-red-700">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <small>Leave the field blank if you don't want to change the password</small>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="text-xl font-semibold text-gray-700 mt-2">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="border border-gray-500 w-96 h-12 pl-4 rounded-lg font-semibold mt-2" name="password_confirmation" autocomplete="new-password">
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
            </div>
        </div>
    </div>
@endsection

@section('extra-js')
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{asset('js/algolia.js')}}"></script>
@endsection

