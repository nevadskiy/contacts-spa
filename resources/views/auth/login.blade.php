@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center mx-auto h-full bg-gray-400">
    <div class="max-w-sm w-full p-6 bg-blue-900 rounded-lg shadow-xl">
        <h1 class="text-blue-100 text-3xl">Welcome back</h1>
        <h2 class="mt-2 text-blue-300">Enter your credentials below</h2>

        <form method="POST" action="{{ route('login') }}" class="mt-8">
            @csrf

            <div class="relative">
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
                    type="password"
                    class="w-full pt-8 pb-2 px-2 text-blue-100 bg-blue-800 rounded placeholder-gray-600 outline-none focus:bg-blue-700"
                    name="password"
                    required
                    autocomplete="current-password"
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

            <div class="mt-4">
                <input
                    type="checkbox"
                    name="remember"
                    id="remember"{{ old('remember') ? ' checked' : '' }}
                >
                <label class="text-blue-100" for="remember">Remember Me</label>
            </div>

            <div class="mt-4">
                <button type="submit" class="w-full py-2 px-2 bg-gray-400 uppercase rounded text-blue-800 font-bold hover:bg-gray-500">Login</button>
            </div>

            <div class="mt-4 flex justify-between">
                <a class="text-blue-100" href="{{ route('password.request') }}">Forgot Your Password?</a>
                <a class="text-blue-100" href="{{ route('register') }}">Register</a>
            </div>
        </form>
    </div>
</div>
@endsection
