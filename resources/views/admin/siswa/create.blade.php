@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow w-full lg:w-1/2 mx-auto">
    <h1 class="text-2xl font-bold mb-6 text-center">Tambah Data Siswa</h1>

    <form action="{{ route('admin.siswa.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- NIS -->
        <div>
            <label class="block mb-1 font-medium">NIS</label>
            <input type="text" name="nis"
                   value="{{ old('nis') }}"
                   class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200"
                   placeholder="Masukkan NIS" required>
            @error('nis')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Nama -->
        <div>
            <label class="block mb-1 font-medium">Nama</label>
            <input type="text" name="nama"
                   value="{{ old('nama') }}"
                   class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200"
                   placeholder="Masukkan Nama" required>
            @error('nama')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Kelas -->
        <div>
            <label class="block mb-1 font-medium">Kelas</label>
            <input type="text" name="kelas"
                   value="{{ old('kelas') }}"
                   class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200"
                   placeholder="Contoh: X-RPL" required>
            @error('kelas')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Jurusan -->
        <div>
            <label class="block mb-1 font-medium">Jurusan</label>
            <input type="text" name="jurusan"
                   value="{{ old('jurusan') }}"
                   class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200"
                   placeholder="Contoh: RPL" required>
            @error('jurusan')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tombol Submit -->
        <div class="text-right">
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
