@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-yellow-100 via-white to-yellow-200 py-10">
    <div class="max-w-xl mx-auto bg-white rounded-xl shadow-lg p-8">
        <h1 class="text-2xl font-bold mb-4 text-yellow-700">Detail Booking</h1>
        <div class="mb-4">
            <strong>Nama:</strong> {{ $booking->user->name ?? '-' }}<br>
            <strong>Kereta:</strong> {{ $booking->schedule->train->name ?? '-' }}<br>
            <strong>Tanggal:</strong> {{ $booking->schedule->date ?? '-' }}<br>
            <strong>Berangkat:</strong> {{ $booking->schedule->departure_time ?? '-' }}<br>
            <strong>Tiba:</strong> {{ $booking->schedule->arrival_time ?? '-' }}<br>
            <strong>Jumlah Penumpang:</strong> {{ $booking->passenger_count }}<br>
            <strong>Total Harga:</strong> {{ \App\Helpers\ValidationHelper::formatRupiah(($booking->schedule->price ?? 0) * $booking->passenger_count) }}<br>
            <strong>Status:</strong> <span class="font-semibold">{{ $booking->status }}</span><br>
            <strong>Status Pembayaran:</strong> <span class="font-semibold">{{ $booking->payment_status ?? '-' }}</span>
        </div>
        @if($booking->payment_proof)
        <div class="mb-4">
            <strong>Bukti Pembayaran:</strong><br>
            <img src="{{ asset('storage/payment_proofs/' . $booking->payment_proof) }}" alt="Bukti Pembayaran" class="w-64 rounded shadow border mb-2">
        </div>
        @endif
        @if(auth()->check() && auth()->id() == $booking->user_id && $booking->payment_status === 'Belum Dibayar')
        <div class="mb-4">
            <form action="{{ route('bookings.bayar', $booking->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label class="block font-semibold mb-1">Upload Bukti Pembayaran (jpg/png, max 5MB):</label>
                <input type="file" name="payment_proof" accept="image/jpeg,image/png" class="mb-2" required>
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Upload Bukti</button>
            </form>
        </div>
        @elseif(auth()->check() && auth()->id() == $booking->user_id && $booking->payment_status === 'Menunggu Konfirmasi')
        <div class="mb-4 p-4 bg-yellow-100 rounded">
            <strong>Menunggu konfirmasi pembayaran dari admin.</strong><br>
            Silakan tunggu, admin akan memproses pembayaran Anda.
        </div>
        @endif
        @if(auth()->check() && auth()->user()->IsAdmin() && $booking->payment_status === 'Menunggu Konfirmasi')
        <div class="mb-4">
            <form action="{{ route('bookings.konfirmasiPembayaran', $booking->id) }}" method="POST">
                @csrf
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Konfirmasi Pembayaran</button>
            </form>
        </div>
        @endif
        @if($booking->ticket)
        <div class="mb-4 p-4 bg-green-100 rounded">
            <strong>Kode Tiket:</strong> <span class="text-green-700 text-lg">{{ $booking->ticket->code }}</span><br>
            <strong>Waktu Terbit:</strong> {{ $booking->ticket->issued_at }}<br>
            <a href="#" onclick="window.print()" class="mt-2 inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Download Invoice</a>
        </div>
        @endif
        <a href="{{ route('bookings.index') }}" class="text-yellow-700 hover:underline">Kembali ke Daftar Booking</a>
    </div>
</div>
@endsection 