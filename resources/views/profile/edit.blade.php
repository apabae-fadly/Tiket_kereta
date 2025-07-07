<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto bg-white rounded-xl shadow-lg p-8">
            <div class="flex flex-col items-center mb-8">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=4e73df&color=fff&size=100" class="rounded-full shadow-lg mb-4" alt="Avatar">
                <h1 class="text-2xl font-extrabold text-blue-700 mb-2">Profil {{ auth()->user()->name }}</h1>
                <p class="text-gray-600">Kelola data akun Anda di sini.</p>
            </div>
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Nama</label>
                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-200" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-200" required>
            </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">Password Baru <span class="text-xs text-gray-400">(Opsional)</span></label>
                    <input type="password" name="password" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-200">
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded hover:bg-blue-700 transition">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</x-app-layout>
