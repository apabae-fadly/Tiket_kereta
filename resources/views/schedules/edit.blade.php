@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-100 via-white to-green-200 py-10">
    <div class="max-w-xl mx-auto">
        <div class="flex flex-col items-center mb-8">
            <div class="bg-yellow-500 rounded-full p-4 shadow-lg mb-4 animate-bounce">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13l6-6m2 2l-6 6m-2 2h6" />
                </svg>
            </div>
            <h1 class="text-2xl font-extrabold text-yellow-700 mb-2 text-center drop-shadow">Edit Jadwal Kereta</h1>
            <a href="{{ route('schedules.index') }}" class="text-yellow-700 hover:underline font-semibold">Kembali ke Jadwal</a>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-8">
            <form method="POST" action="{{ route('schedules.update', $schedule->id) }}" class="space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <label class="block font-semibold mb-1">Kereta</label>
                    <select name="train_id" class="w-full rounded border-gray-300 focus:ring-yellow-500 focus:border-yellow-500">
                        <option value="">Pilih Kereta</option>
                        @foreach($trains as $train)
                            <option value="{{ $train->id }}" @if($schedule->train_id == $train->id) selected @endif>{{ $train->name }} ({{ $train->type }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Tanggal</label>
                    <input type="date" name="date" value="{{ $schedule->date }}" class="w-full rounded border-gray-300 focus:ring-yellow-500 focus:border-yellow-500" required>
                </div>
                <div class="flex gap-4">
                    <div class="w-1/2">
                        <label class="block font-semibold mb-1">Waktu Berangkat</label>
                        <input type="time" name="departure_time" value="{{ $schedule->departure_time }}" class="w-full rounded border-gray-300 focus:ring-yellow-500 focus:border-yellow-500" required>
                    </div>
                    <div class="w-1/2">
                        <label class="block font-semibold mb-1">Waktu Tiba</label>
                        <input type="time" name="arrival_time" value="{{ $schedule->arrival_time }}" class="w-full rounded border-gray-300 focus:ring-yellow-500 focus:border-yellow-500" required>
                    </div>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="submit" class="inline-flex items-center px-6 py-2 bg-yellow-500 text-white rounded-lg shadow hover:bg-yellow-600 transition font-semibold">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13l6-6m2 2l-6 6m-2 2h6" /></svg>
                        Update Jadwal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 