@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-yellow-100 via-white to-yellow-200 py-10">
    <div class="max-w-xl mx-auto bg-white rounded-xl shadow-lg p-8">
        <h1 class="text-2xl font-bold mb-4 text-yellow-700">Konfirmasi Booking</h1>
        <div class="mb-4">
            <strong>Nama:</strong> {{ $booking->user->name ?? '-' }}<br>
            <strong>Kereta:</strong> {{ $booking->schedule->train_id ?? '-' }}<br>
            <strong>Tanggal:</strong> {{ $booking->schedule->date ?? '-' }}<br>
            <strong>Nomor Kursi:</strong> {{ $booking->seat_number }}<br>
            <strong>Status Saat Ini:</strong> <span class="font-semibold">{{ $booking->status }}</span>
        </div>
        <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="status" class="block font-semibold mb-1">Status</label>
                <select name="status" id="status" class="w-full border rounded px-3 py-2">
                    <option value="Menunggu" @if($booking->status=='Menunggu') selected @endif>Menunggu</option>
                    <option value="Dikonfirmasi" @if($booking->status=='Dikonfirmasi') selected @endif>Dikonfirmasi</option>
                    <option value="Ditolak" @if($booking->status=='Ditolak') selected @endif>Ditolak</option>
                </select>
            </div>
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Simpan</button>
        </form>
        <a href="{{ route('bookings.index') }}" class="text-yellow-700 hover:underline mt-4 inline-block">Kembali ke Daftar Booking</a>
    </div>
</div>
@endsection 