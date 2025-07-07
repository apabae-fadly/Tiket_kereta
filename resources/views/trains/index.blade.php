@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-100 via-white to-blue-200 py-10">
    <div class="max-w-4xl mx-auto">
        <div class="flex flex-col items-center mb-8">
            <div class="bg-blue-600 rounded-full p-4 shadow-lg mb-4 animate-bounce">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 19.5l1.5-2.25m0 0A8.25 8.25 0 0112 3.75a8.25 8.25 0 018.25 13.5m-16.5 0l1.5 2.25m-1.5-2.25h16.5m0 0l1.5 2.25m-1.5-2.25l-1.5-2.25m-13.5 0l-1.5 2.25" />
                </svg>
            </div>
            <h1 class="text-3xl font-extrabold text-blue-700 mb-2 text-center drop-shadow">Daftar Kereta</h1>
            <p class="text-gray-600 text-center mb-2">Lihat dan kelola semua kereta yang tersedia di sistem.</p>
            <div class="flex gap-4">
                <a href="/" class="text-blue-700 hover:underline font-semibold">Kembali ke Beranda</a>
                <a href="{{ route('trains.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 shadow transition">Tambah Kereta</a>
            </div>
        </div>
        @if(session('success'))
            <div class="mb-4 p-2 bg-green-100 text-green-700 rounded text-center">{{ session('success') }}</div>
        @endif
        <div class="overflow-x-auto bg-white rounded-xl shadow-lg p-6">
            <table class="min-w-full border rounded">
                <thead class="bg-blue-100">
                    <tr>
                        <th class="py-2 px-4 border">Nama</th>
                        <th class="py-2 px-4 border">Tipe</th>
                        <th class="py-2 px-4 border">Jumlah Kursi</th>
                        <th class="py-2 px-4 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($trains as $train)
                    <tr class="hover:bg-blue-50">
                        <td class="py-2 px-4 border">{{ $train->name }}</td>
                        <td class="py-2 px-4 border">{{ $train->type }}</td>
                        <td class="py-2 px-4 border">{{ $train->seat_count }}</td>
                        <td class="py-2 px-4 border">
                            <a href="{{ route('trains.show', $train->id) }}" class="text-blue-600 hover:underline">Detail</a>
                            @if(auth()->check() && auth()->user()->isAdmin())
                            |
                            <a href="{{ route('trains.edit', $train->id) }}" class="text-yellow-600 hover:underline">Edit</a> |
                            <form action="{{ route('trains.destroy', $train->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin hapus?')" class="text-red-600 hover:underline bg-transparent border-none cursor-pointer">Hapus</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 