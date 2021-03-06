@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center mx-auto h-full bg-gray-400">
        <div class="max-w-sm w-full p-6 bg-blue-900 rounded-lg shadow-xl">
            <h1 class="text-blue-100 text-3xl">Join Us</h1>
            <h2 class="mt-2 text-blue-300">Enter your information below</h2>

            <form method="POST" action="{{ route('register') }}" class="mt-8">
                @csrf

                <div class="relative">
                    <label for="name" class="absolute mt-2 ml-2 uppercase text-blue-500 text-xs font-bold">Full name</label>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        class="w-full pt-8 pb-2 px-2 text-blue-100 bg-blue-800 rounded placeholder-gray-600 outline-none focus:bg-blue-700"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        autofocus
                        placeholder="Your name"
                    >

                    @if ($errors->has('name'))
                        <div class="mt-1">
                            <span class="text-red-600 text-sm">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        </div>
                    @endif
                </div>

                <div class="relative mt-4">
                    <label for="email" class="absolute mt-2 ml-2 uppercase text-blue-500 text-xs font-bold">E-mail</label>
                    <input
                        id="email"
                        type="email"
                        class="w-full pt-8 pb-2 px-2 text-blue-100 bg-blue-800 rounded placeholder-gray-600 outline-none focus:bg-blue-700"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        autofocus
                        placeholder="your@email.com"
                    >

                    @if ($errors->has('email'))
                        <div class="mt-1">
                            <span class="text-red-600 text-sm">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        </div>
                    @endif
                </div>

                <div class="relative mt-4">
                    <label for="password" class="absolute mt-2 ml-2 uppercase text-blue-500 text-xs font-bold">Password</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="w-full pt-8 pb-2 px-2 text-blue-100 bg-blue-800 rounded placeholder-gray-600 outline-none focus:bg-blue-700"
                        required
                        autocomplete="new-password"
                        autofocus
                        placeholder="Password"
                    >

                    @if ($errors->has('password'))
                        <div class="mt-1">
                        <span class="text-red-600 text-sm">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        </div>
                    @endif
                </div>

                <div class="relative mt-4">
                    <label for="password_confirmation" class="absolute mt-2 ml-2 uppercase text-blue-500 text-xs font-bold">Password</label>
                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        class="w-full pt-8 pb-2 px-2 text-blue-100 bg-blue-800 rounded placeholder-gray-600 outline-none focus:bg-blue-700"
                        required
                        autocomplete="new-password"
                        autofocus
                        placeholder="Confirm"
                    >

                    @if ($errors->has('password'))
                        <div class="mt-1">
                        <span class="text-red-600 text-sm">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        </div>
                    @endif
                </div>

                <div class="mt-4">
                    <button type="submit" class="w-full py-2 px-2 bg-gray-400 uppercase rounded text-blue-800 font-bold hover:bg-gray-500">Register</button>
                </div>
            </form>

            <div class="mt-4 flex justify-between">
                <a class="text-blue-100 font-bold" href="{{ route('password.request') }}">Forgot Your Password?</a>
                <a class="text-blue-100 font-bold" href="{{ route('login') }}">Login</a>
            </div>
        </div>
    </div>
@endsection
