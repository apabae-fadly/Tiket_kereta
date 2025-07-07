@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-100 via-white to-purple-200 py-10">
    <div class="max-w-2xl mx-auto">
        <div class="flex flex-col items-center mb-8">
            <div class="bg-purple-600 rounded-full p-4 shadow-lg mb-4 animate-bounce">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
            </div>
            <h1 class="text-3xl font-extrabold text-purple-700 mb-2 text-center drop-shadow">Tiket Saya</h1>
            <p class="text-gray-600 text-center mb-2">Lihat dan kelola tiket kereta yang sudah kamu beli!</p>
            <a href="/" class="text-purple-700 hover:underline font-semibold">Kembali ke Beranda</a>
        </div>
        <div class="overflow-x-auto bg-white rounded-xl shadow-lg p-6 mt-4">
            <table class="min-w-full border rounded">
                <thead class="bg-purple-100">
                    <tr>
                        <th class="py-2 px-4 border">Kode Tiket</th>
                        <th class="py-2 px-4 border">Nama Pemesan</th>
                        <th class="py-2 px-4 border">Kereta</th>
                        <th class="py-2 px-4 border">Jadwal</th>
                        <th class="py-2 px-4 border">Harga</th>
                        <th class="py-2 px-4 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                    @php
                        $booking = $ticket->booking;
                        $user = $booking ? $booking->user : null;
                        $schedule = $booking ? $booking->schedule : null;
                        $train = $schedule ? $schedule->train : null;
                    @endphp
                    @if(auth()->user()->IsAdmin() || ($user && $user->id == auth()->id()))
                    <tr class="hover:bg-purple-50">
                        <td class="py-2 px-4 border">{{ $ticket->code }}</td>
                        <td class="py-2 px-4 border">{{ $user ? $user->name : '-' }}</td>
                        <td class="py-2 px-4 border font-semibold text-purple-700">{{ $train ? $train->name : '-' }}</td>
                        <td class="py-2 px-4 border text-sm">
                            @if($schedule)
                                <div><span class="font-semibold">{{ \App\Helpers\ValidationHelper::formatTanggal($schedule->date) }}</span></div>
                                <div>Berangkat: <span class="font-semibold">{{ \App\Helpers\ValidationHelper::formatWaktu($schedule->departure_time) }}</span></div>
                                <div>Tiba: <span class="font-semibold">{{ \App\Helpers\ValidationHelper::formatWaktu($schedule->arrival_time) }}</span></div>
                            @else
                                -
                            @endif
                        </td>
                        <td class="py-2 px-4 border">{{ $schedule ? \App\Helpers\ValidationHelper::formatRupiah($schedule->price) : '-' }}</td>
                        <td class="py-2 px-4 border">
                            <a href="{{ route('tickets.show', $ticket->id) }}" class="text-blue-600 hover:underline">Detail</a>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 