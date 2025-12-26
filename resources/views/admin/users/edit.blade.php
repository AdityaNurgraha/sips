@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Edit User</h2>
        <a href="{{ route('admin.users.index') }}"
           class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">
            ← Back
        </a>
    </div>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6" x-data="{ role: '{{ old('role', $user->role) }}' }">
        @csrf
        @method('PUT')

        <!-- Nama -->
        <div>
            <label class="block mb-1 font-medium">Nama</label>
            <input type="text" name="name"
                   class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200"
                   value="{{ old('name', $user->name) }}" required>
            @error('name') 
                <p class="text-red-500 text-sm">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label class="block mb-1 font-medium">Email</label>
            <input type="email" name="email"
                   class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200"
                   value="{{ old('email', $user->email) }}" required>
            @error('email') 
                <p class="text-red-500 text-sm">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label class="block mb-1 font-medium">Password (opsional)</label>
            <input type="password" name="password"
                   class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200"
                   placeholder="Kosongkan jika tidak ingin mengubah">
            @error('password') 
                <p class="text-red-500 text-sm">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Konfirmasi Password (ditambahkan) -->
        <div>
            <label class="block mb-1 font-medium">Konfirmasi Password</label>
            <input type="password" name="password_confirmation"
                   class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200"
                   placeholder="Ulangi password jika ingin mengganti">
            
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
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="guru" {{ old('role', $user->role) == 'guru' ? 'selected' : '' }}>Guru</option>
            </select>
            @error('role') 
                <p class="text-red-500 text-sm">{{ $message }}</p> 
            @enderror
        </div>

        <!-- NUPTK (khusus Guru) -->
        <div x-show="role === 'guru'" x-cloak>
            <label class="block mb-1 font-medium">NUPTK</label>
            <input type="text" name="nuptk"
                   class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200"
                   value="{{ old('nuptk', $user->nuptk) }}">
            @error('nuptk') 
                <p class="text-red-500 text-sm">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Tombol -->
        <div class="flex justify-end space-x-2">
            <a href="{{ route('admin.users.index') }}"
               class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">
                Cancel
            </a>
            <button type="submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
