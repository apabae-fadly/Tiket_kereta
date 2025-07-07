@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-yellow-100 via-white to-yellow-200 py-10">
    <div class="max-w-2xl mx-auto">
        <div class="flex flex-col items-center mb-8">
            <div class="bg-yellow-500 rounded-full p-4 shadow-lg mb-4 animate-bounce">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.75v16.5m-9-16.5v16.5M3.75 7.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
                </svg>
            </div>
            <h1 class="text-3xl font-extrabold text-yellow-700 mb-2 text-center drop-shadow">Pemesanan Tiket</h1>
            <p class="text-gray-600 text-center mb-2">Kelola dan lihat riwayat pemesanan tiket kereta kamu!</p>
            <a href="/" class="text-yellow-700 hover:underline font-semibold">Kembali ke Beranda</a>
        </div>
    </div>
    <div class="overflow-x-auto bg-white rounded-xl shadow-lg p-6 mt-4">
        <table class="min-w-full border rounded">
            <thead class="bg-yellow-100">
                <tr>
                    <th class="py-2 px-4 border">Nama Pemesan</th>
                    <th class="py-2 px-4 border">Kereta</th>
                    <th class="py-2 px-4 border">Jadwal</th>
                    <th class="py-2 px-4 border">Status</th>
                    <th class="py-2 px-4 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                @if(auth()->user()->IsAdmin() || $booking->user_id == auth()->id())
                <tr class="hover:bg-yellow-50">
                    <td class="py-2 px-4 border">{{ $booking->user->name ?? '-' }}</td>
                    <td class="py-2 px-4 border font-semibold text-yellow-700">{{ $booking->schedule && $booking->schedule->train ? $booking->schedule->train->name : '-' }}</td>
                    <td class="py-2 px-4 border text-sm">
                        @if($booking->schedule)
                            <div><span class="font-semibold">{{ \App\Helpers\ValidationHelper::formatTanggal($booking->schedule->date) }}</span></div>
                            <div>Berangkat: <span class="font-semibold">{{ \App\Helpers\ValidationHelper::formatWaktu($booking->schedule->departure_time) }}</span></div>
                            <div>Tiba: <span class="font-semibold">{{ \App\Helpers\ValidationHelper::formatWaktu($booking->schedule->arrival_time) }}</span></div>
                        @else
                            -
                        @endif
                    </td>
                    <td class="py-2 px-4 border">{{ $booking->status }}</td>
                    <td class="py-2 px-4 border">
                        <a href="{{ route('bookings.show', $booking->id) }}" class="text-blue-600 hover:underline">Detail</a>
                        @if(auth()->user()->IsAdmin())
                            | <a href="{{ route('bookings.edit', $booking->id) }}" class="text-yellow-600 hover:underline">Konfirmasi</a>
                        @endif
                    </td>
                </tr>
                @endif
                @empty
                <tr>
                    <td colspan="5" class="text-center text-gray-400 py-8">
                        <div class="flex flex-col items-center">
                            <span class="text-2xl">😕</span>
                            <div class="font-semibold">Belum ada pemesanan tiket.</div>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection 