@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-100 via-white to-green-200 py-10">
    <div class="max-w-xl mx-auto">
        <div class="flex flex-col items-center mb-8">
            <div class="bg-green-600 rounded-full p-4 shadow-lg mb-4 animate-bounce">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2" />
                </svg>
            </div>
            <h1 class="text-2xl font-extrabold text-green-700 mb-2 text-center drop-shadow">Tambah Jadwal Kereta</h1>
            <a href="{{ route('schedules.index') }}" class="text-green-700 hover:underline font-semibold">Kembali ke Jadwal</a>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-8 relative">
            @if(count($trains) === 0)
                <div class="text-red-600 font-semibold mb-4">
                    Belum ada data kereta. Silakan <a href="{{ route('trains.create') }}" class="underline text-blue-600">tambah kereta</a> terlebih dahulu.
                </div>
            @endif
            <form method="POST" action="{{ route('schedules.store') }}" class="space-y-6 pb-20">
                @csrf
                <div>
                    <label class="block font-semibold mb-1">Harga Tiket</label>
                    <input type="number" name="price" min="0" step="1000" class="w-full rounded border-gray-300 focus:ring-green-500 focus:border-green-500" required>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Kereta</label>
                    <select name="train_id" class="w-full rounded border-gray-300 focus:ring-green-500 focus:border-green-500" @if(count($trains) === 0) disabled @endif>
                        <option value="">Pilih Kereta</option>
                        @foreach($trains as $train)
                            <option value="{{ $train->id }}">{{ $train->name }} ({{ $train->type }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Tanggal</label>
                    <input type="date" name="date" class="w-full rounded border-gray-300 focus:ring-green-500 focus:border-green-500" required @if(count($trains) === 0) disabled @endif>
                </div>
                <div class="flex gap-4">
                    <div class="w-1/2">
                        <label class="block font-semibold mb-1">Waktu Berangkat</label>
                        <input type="time" name="departure_time" class="w-full rounded border-gray-300 focus:ring-green-500 focus:border-green-500" required @if(count($trains) === 0) disabled @endif>
                    </div>
                    <div class="w-1/2">
                        <label class="block font-semibold mb-1">Waktu Tiba</label>
                        <input type="time" name="arrival_time" class="w-full rounded border-gray-300 focus:ring-green-500 focus:border-green-500" required @if(count($trains) === 0) disabled @endif>
                    </div>
                </div>
                <!-- Tombol submit di dalam card, tidak sticky -->
                <div class="flex justify-end mt-8">
                    <button type="submit" class="inline-flex items-center px-8 py-4 bg-green-500 text-gray-900 rounded-xl shadow-xl text-lg font-bold transition hover:bg-green-300 hover:scale-105 hover:shadow-2xl focus:outline-none focus:ring-4 focus:ring-green-300 animate-pulse @if(count($trains) === 0) opacity-50 cursor-not-allowed @endif" @if(count($trains) === 0) disabled @endif>
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                        Simpan Jadwal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 