@extends('layouts.app')

@section('content')
<div class="py-10 bg-gradient-to-br from-blue-50 via-white to-blue-100 min-h-screen">
    <div class="max-w-5xl mx-auto">
        <div class="glass-card rounded-xl shadow-2xl p-8 mb-8 flex flex-col md:flex-row items-center justify-between animate__animated animate__fadeInDown" style="background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);">
            <div>
                <h1 class="text-2xl md:text-3xl font-extrabold text-blue-700 mb-2">Selamat datang, {{ auth()->user()->name }}!</h1>
                <p class="text-gray-600 mb-1">Email: <span class="font-semibold">{{ auth()->user()->email }}</span></p>
            </div>
            <div class="mt-6 md:mt-0">
                <img src="https://img.icons8.com/ios-filled/100/4e73df/train.png" alt="Kereta" class="w-20 h-20 mx-auto animate-bounce"/>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="glass-card rounded-xl shadow-xl p-6 flex flex-col items-center transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                <div class="text-3xl mb-2"><i class="bi bi-train-front-fill text-blue-700"></i></div>
                <div class="text-lg font-bold text-blue-700">Kereta</div>
                <div class="text-2xl font-extrabold badge bg-blue-600 text-white px-4 py-1 mt-1">{{ \App\Models\Train::count() }}</div>
            </div>
            <div class="glass-card rounded-xl shadow-xl p-6 flex flex-col items-center transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                <div class="text-3xl mb-2"><i class="bi bi-calendar2-week-fill text-green-700"></i></div>
                <div class="text-lg font-bold text-green-700">Jadwal</div>
                <div class="text-2xl font-extrabold badge bg-green-600 text-white px-4 py-1 mt-1">{{ \App\Models\Schedule::count() }}</div>
            </div>
            <div class="glass-card rounded-xl shadow-xl p-6 flex flex-col items-center transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                <div class="text-3xl mb-2"><i class="bi bi-ticket-perforated-fill text-yellow-700"></i></div>
                <div class="text-lg font-bold text-yellow-700">Booking</div>
                <div class="text-2xl font-extrabold badge bg-yellow-500 text-white px-4 py-1 mt-1">{{ \App\Models\Booking::count() }}</div>
            </div>
            <div class="glass-card rounded-xl shadow-xl p-6 flex flex-col items-center transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                <div class="text-3xl mb-2"><i class="bi bi-ticket-detailed-fill text-purple-700"></i></div>
                <div class="text-lg font-bold text-purple-700">Tiket</div>
                <div class="text-2xl font-extrabold badge bg-purple-600 text-white px-4 py-1 mt-1">{{ \App\Models\Ticket::count() }}</div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('schedules.index') }}" class="group block glass-card rounded-xl shadow-lg p-6 hover:bg-blue-100 transition transform hover:-translate-y-1 btn-animate">
                <div class="flex items-center mb-2">
                    <i class="bi bi-calendar2-week text-green-700 text-2xl"></i>
                    <span class="ml-3 text-lg font-bold text-green-700">Jadwal Kereta</span>
                </div>
                <p class="text-gray-500">Cek jadwal keberangkatan dan kedatangan</p>
            </a>
            <a href="{{ route('bookings.index') }}" class="group block glass-card rounded-xl shadow-lg p-6 hover:bg-green-100 transition transform hover:-translate-y-1 btn-animate">
                <div class="flex items-center mb-2">
                    <i class="bi bi-ticket-perforated text-yellow-700 text-2xl"></i>
                    <span class="ml-3 text-lg font-bold text-yellow-700">Booking Tiket</span>
                </div>
                <p class="text-gray-500">Kelola dan lihat riwayat pemesanan</p>
            </a>
            <a href="{{ route('tickets.index') }}" class="group block glass-card rounded-xl shadow-lg p-6 hover:bg-purple-100 transition transform hover:-translate-y-1 btn-animate">
                <div class="flex items-center mb-2">
                    <i class="bi bi-ticket-detailed text-purple-700 text-2xl"></i>
                    <span class="ml-3 text-lg font-bold text-purple-700">Tiket Saya</span>
                </div>
                <p class="text-gray-500">Lihat tiket yang sudah dibeli</p>
            </a>
        </div>
    </div>
</div>
@endsection
