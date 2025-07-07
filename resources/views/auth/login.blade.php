@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-blue-100 via-white to-blue-200 py-10">
    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
        <div class="flex flex-col items-center mb-6">
            <div class="bg-blue-600 rounded-full p-3 shadow-lg mb-3 animate-bounce">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-10 h-10">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 19.5l1.5-2.25m0 0A8.25 8.25 0 0112 3.75a8.25 8.25 0 018.25 13.5m-16.5 0l1.5 2.25m-1.5-2.25h16.5m0 0l1.5 2.25m-1.5-2.25l-1.5-2.25m-13.5 0l-1.5 2.25" />
                </svg>
            </div>
            <h1 class="text-2xl font-extrabold text-blue-700 mb-1 text-center drop-shadow">Login</h1>
            <p class="text-gray-500 text-center">Masuk untuk memesan tiket kereta atau kelola data!</p>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-200">
                @error('email')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-semibold mb-1">Password</label>
                <input id="password" type="password" name="password" required class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-200">
                @error('password')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded hover:bg-blue-700 transition">Login</button>
        </form>
        <div class="mt-4 text-center">
            <span class="text-gray-600">Belum punya akun?</span>
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-semibold">Daftar</a>
        </div>
    </div>
</div>
@endsection
