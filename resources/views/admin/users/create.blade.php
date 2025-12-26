@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Tambah User</h2>
        <a href="{{ route('admin.users.index') }}"
           class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">
            ← Kembali
        </a>
    </div>

    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6" x-data="{ role: '{{ old('role') }}' }">
        @csrf

        <!-- Nama -->
        <div>
            <label class="block mb-1 font-medium">Nama</label>
            <input type="text" name="name"
                   class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200"
                   placeholder="Nama Lengkap" value="{{ old('name') }}" required>
            @error('name') 
                <p class="text-red-500 text-sm">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label class="block mb-1 font-medium">Email</label>
            <input type="email" name="email"
                   class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200"
                   placeholder="Alamat Email" value="{{ old('email') }}" required>
            @error('email') 
                <p class="text-red-500 text-sm">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label class="block mb-1 font-medium">Password</label>
            <input type="password" name="password"
                   class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200"
                   placeholder="Minimal 6 karakter" required>
            @error('password') 
                <p class="text-red-500 text-sm">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Konfirmasi Password (ditambahkan) -->
        <div>
            <label class="block mb-1 font-medium">Konfirmasi Password</label>
            <input type="password" name="password_confirmation"
                   class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200"
                   placeholder="Ulangi password" required>

            @error('password_confirmation')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Role -->
        <div>
            <label class="block mb-1 font-medium">Role</label>
            <select name="role" x-model="role"
                    class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200" required>
                <option value="">Pilih Role</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru</option>
            </select>
            @error('role') 
                <p class="text-red-500 text-sm">{{ $message }}</p> 
            @enderror
        </div>

        <!-- NUPTK (hanya untuk Guru) -->
        <div x-show="role === 'guru'" x-cloak>
            <label class="block mb-1 font-medium">NUPTK</label>
            <input type="text" name="nuptk"
                   class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200"
                   placeholder="Masukkan NUPTK" value="{{ old('nuptk') }}">
            @error('nuptk') 
                <p class="text-red-500 text-sm">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Tombol -->
        <div class="flex justify-end space-x-2">
            <button type="reset"
                    class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
                Reset
            </button>
            <button type="submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
