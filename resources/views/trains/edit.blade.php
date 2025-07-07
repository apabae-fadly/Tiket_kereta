@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-100 via-white to-blue-200 py-10 flex justify-center items-center">
    <div class="w-full max-w-lg bg-white rounded-xl shadow-lg p-8">
        <div class="flex flex-col items-center mb-6">
            <div class="bg-blue-600 rounded-full p-3 shadow-lg mb-3 animate-bounce">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-10 h-10">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 19.5l1.5-2.25m0 0A8.25 8.25 0 0112 3.75a8.25 8.25 0 018.25 13.5m-16.5 0l1.5 2.25m-1.5-2.25h16.5m0 0l1.5 2.25m-1.5-2.25l-1.5-2.25m-13.5 0l-1.5 2.25" />
                </svg>
            </div>
            <h1 class="text-2xl font-extrabold text-blue-700 mb-1 text-center drop-shadow">Edit Kereta</h1>
        </div>
        <form action="{{ route('trains.update', $train->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Nama Kereta</label>
                <input type="text" name="name" value="{{ $train->name }}" required class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-200">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Tipe</label>
                <input type="text" name="type" value="{{ $train->type }}" required class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-200">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-1">Jumlah Kursi</label>
                <input type="number" name="seat_count" value="{{ $train->seat_count }}" required class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-200">
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded hover:bg-blue-700 transition">Update</button>
        </form>
        <div class="mt-4 text-center">
            <a href="{{ route('trains.index') }}" class="text-blue-600 hover:underline font-semibold">Kembali</a>
        </div>
    </div>
</div>
@endsection 