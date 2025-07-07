@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-yellow-100 via-white to-yellow-200 py-10">
    <div class="max-w-xl mx-auto bg-white rounded-xl shadow-lg p-8">
        <h1 class="text-2xl font-bold mb-4 text-yellow-700">Pesan Tiket</h1>
        <div class="mb-4">
            <strong>Kereta:</strong> {{ $schedule->train->name ?? 'Kereta #' . $schedule->train_id }}<br>
            <strong>Tanggal:</strong> {{ $schedule->date }}<br>
            <strong>Berangkat:</strong> {{ $schedule->departure_time }}<br>
            <strong>Tiba:</strong> {{ $schedule->arrival_time }}
        </div>
        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf
            <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
            <div class="mb-4">
                <label for="passenger_count" class="block font-semibold mb-1">Jumlah Penumpang</label>
                <input type="number" name="passenger_count" id="passenger_count" class="w-full border rounded px-3 py-2" min="1" value="1" required>
            </div>
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Pesan Tiket</button>
        </form>
    </div>
</div>
@endsection 