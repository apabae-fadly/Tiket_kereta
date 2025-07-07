@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-100 via-white to-blue-200 py-10">
    <div class="max-w-3xl mx-auto">
        <!-- Hero Section -->
        <div class="flex flex-col items-center mb-8">
            <div class="bg-blue-600 rounded-full p-4 shadow-lg mb-4 animate-bounce">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-14 h-14">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 19.5l1.5-2.25m0 0A8.25 8.25 0 0112 3.75a8.25 8.25 0 018.25 13.5m-16.5 0l1.5 2.25m-1.5-2.25h16.5m0 0l1.5 2.25m-1.5-2.25l-1.5-2.25m-13.5 0l-1.5 2.25" />
                </svg>
            </div>
            <h1 class="text-4xl font-extrabold text-blue-700 mb-2 text-center drop-shadow">Selamat Datang di<br>Aplikasi Tiket Kereta</h1>
            <p class="text-gray-600 text-lg text-center mb-2">Pesan tiket kereta dengan mudah, cepat, dan aman!</p>
            @auth
                <span class="inline-block bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold mb-2">Halo, {{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
                @if(auth()->user()->IsAdmin())
                    <a href="{{ route('trains.index') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 shadow transition">Kelola Data Kereta (Admin)</a>
                @endif
                <form action="{{ route('logout') }}" method="POST" class="inline-block ml-2">
                    @csrf
                    <button type="submit" class="text-red-600 hover:underline">Logout</button>
                </form>
            @else
                <div class="mb-2">
                    <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-semibold">Login</a> |
                    <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-semibold">Register</a>
                </div>
            @endauth
        </div>
        <!-- Menu Card Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <a href="/trains" class="group block bg-white rounded-xl shadow-lg p-6 hover:bg-blue-50 transition transform hover:-translate-y-1">
                <div class="flex items-center mb-2">
                    <svg class="w-8 h-8 text-blue-600 group-hover:scale-110 transition" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 19.5l1.5-2.25m0 0A8.25 8.25 0 0112 3.75a8.25 8.25 0 018.25 13.5m-16.5 0l1.5 2.25m-1.5-2.25h16.5m0 0l1.5 2.25m-1.5-2.25l-1.5-2.25m-13.5 0l-1.5 2.25" /></svg>
                    <span class="ml-3 text-lg font-bold text-blue-700">Daftar Kereta</span>
                </div>
                <p class="text-gray-500">Lihat semua kereta yang tersedia</p>
            </a>
            <a href="/schedules" class="group block bg-white rounded-xl shadow-lg p-6 hover:bg-blue-50 transition transform hover:-translate-y-1">
                <div class="flex items-center mb-2">
                    <svg class="w-8 h-8 text-green-600 group-hover:scale-110 transition" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2" /></svg>
                    <span class="ml-3 text-lg font-bold text-green-700">Jadwal Kereta</span>
                </div>
                <p class="text-gray-500">Cek jadwal keberangkatan dan kedatangan</p>
            </a>
            <a href="/bookings" class="group block bg-white rounded-xl shadow-lg p-6 hover:bg-blue-50 transition transform hover:-translate-y-1">
                <div class="flex items-center mb-2">
                    <svg class="w-8 h-8 text-yellow-500 group-hover:scale-110 transition" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.75v16.5m-9-16.5v16.5M3.75 7.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" /></svg>
                    <span class="ml-3 text-lg font-bold text-yellow-700">Pemesanan</span>
                </div>
                <p class="text-gray-500">Kelola dan lihat riwayat pemesanan</p>
            </a>
            <a href="/tickets" class="group block bg-white rounded-xl shadow-lg p-6 hover:bg-blue-50 transition transform hover:-translate-y-1">
                <div class="flex items-center mb-2">
                    <svg class="w-8 h-8 text-purple-600 group-hover:scale-110 transition" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                    <span class="ml-3 text-lg font-bold text-purple-700">Tiket Saya</span>
                </div>
                <p class="text-gray-500">Lihat tiket yang sudah dibeli</p>
            </a>
        </div>
    </div>
</div>
@endsection 