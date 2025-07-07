@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-100 via-white to-green-200 py-10">
    <div class="max-w-3xl mx-auto">
        <div class="flex flex-col items-center mb-8">
            <div class="bg-green-600 rounded-full p-4 shadow-lg mb-4 animate-bounce">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2" />
                </svg>
            </div>
            <h1 class="text-3xl font-extrabold text-green-700 mb-2 text-center drop-shadow">Jadwal Kereta</h1>
            <p class="text-gray-600 text-center mb-2">Cek jadwal keberangkatan dan kedatangan kereta favoritmu!</p>
            <a href="/" class="text-green-700 hover:underline font-semibold">Kembali ke Beranda</a>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6 mb-6 flex items-center gap-4">
            <svg class="w-10 h-10 text-green-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2" /></svg>
            <div>
                <div class="font-bold text-lg text-green-700">Total Jadwal: <span class="text-green-900">{{ count($schedules) }}</span></div>
                <div class="text-sm text-gray-500">Klik tombol <span class="font-semibold text-green-600">Pesan</span> untuk booking tiket!</div>
            </div>
            @if(auth()->check() && auth()->user()->IsAdmin())
                <a href="{{ route('schedules.create') }}" class="ml-auto inline-flex items-center px-4 py-2 bg-green-500 text-gray-900 rounded-lg shadow hover:bg-green-300 transition font-semibold">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                    Tambah Jadwal
                </a>
            @endif
        </div>
        <div class="overflow-x-auto bg-white rounded-xl shadow-lg p-6 mt-4">
            <table class="min-w-full border rounded">
                <thead class="bg-green-100">
                    <tr>
                        <th class="py-2 px-4 border">Kereta</th>
                        <th class="py-2 px-4 border">Tanggal</th>
                        <th class="py-2 px-4 border">Waktu Berangkat</th>
                        <th class="py-2 px-4 border">Waktu Tiba</th>
                        <th class="py-2 px-4 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($schedules as $schedule)
                    <tr class="hover:bg-green-50 transition">
                        <td class="py-2 px-4 border font-semibold text-green-800 flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-500 inline" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 19.5l1.5-2.25m0 0A8.25 8.25 0 0112 3.75a8.25 8.25 0 018.25 13.5m-16.5 0l1.5 2.25m-1.5-2.25h16.5m0 0l1.5 2.25m-1.5-2.25l-1.5-2.25m-13.5 0l-1.5 2.25" /></svg>
                            {{ $schedule->train->name ?? 'Kereta #' . $schedule->train_id }}
                        </td>
                        <td class="py-2 px-4 border">
                            <span class="inline-block bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-semibold">
                                {{ \App\Helpers\ValidationHelper::formatTanggal($schedule->date) }}
                            </span>
                        </td>
                        <td class="py-2 px-4 border">
                            <span class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-semibold">
                                {{ \App\Helpers\ValidationHelper::formatWaktu($schedule->departure_time) }}
                            </span>
                        </td>
                        <td class="py-2 px-4 border">
                            <span class="inline-block bg-purple-100 text-purple-800 px-2 py-1 rounded text-xs font-semibold">
                                {{ \App\Helpers\ValidationHelper::formatWaktu($schedule->arrival_time) }}
                            </span>
                        </td>
                        <td class="py-2 px-4 border">
                            @php
                                $userBooking = null;
                                if(auth()->check()) {
                                    $userBooking = \App\Models\Booking::where('user_id', auth()->id())
                                        ->where('schedule_id', $schedule->id)
                                        ->first();
                                }
                            @endphp

                            @if(auth()->check() && auth()->user()->IsAdmin())
                                <a href="{{ route('schedules.edit', $schedule->id) }}" class="inline-flex items-center px-2 py-1 bg-yellow-100 text-yellow-800 rounded hover:bg-yellow-200 transition mr-1 text-xs font-semibold">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13l6-6m2 2l-6 6m-2 2h6" /></svg>
                                    Edit
                                </a>
                                <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus jadwal ini?')" class="inline-flex items-center px-2 py-1 bg-red-100 text-red-800 rounded hover:bg-red-200 transition text-xs font-semibold">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                                        Hapus
                                    </button>
                                </form>
                            @else
                                @if($userBooking)
                                    @if($userBooking->status === 'Ditolak')
                                        <a href="{{ route('bookings.create', ['schedule_id' => $schedule->id]) }}" class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 rounded hover:bg-green-200 transition text-xs font-semibold">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                                            Pesan Tiket
                                        </a>
                                    @else
                                        <a href="{{ route('bookings.show', $userBooking->id) }}" class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-800 rounded hover:bg-blue-200 transition text-xs font-semibold">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                                            Lihat Booking
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route('bookings.create', ['schedule_id' => $schedule->id]) }}" class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 rounded hover:bg-green-200 transition text-xs font-semibold">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                                        Pesan Tiket
                                    </a>
                                @endif
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-400 py-8">
                            <div class="flex flex-col items-center">
                                <img src="https://img.icons8.com/ios-filled/50/cccccc/train.png" class="w-12 h-12 mb-2 opacity-60"/>
                                <div class="font-semibold">Belum ada jadwal kereta.</div>
                                <div class="text-xs text-gray-400">Silakan hubungi admin untuk menambah jadwal.</div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 