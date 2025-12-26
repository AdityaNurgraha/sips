@extends('layouts.app')

@section('content')
<div class="p-6">
    
    <!-- Header + Tombol Kembali -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Tambah Kategori Pelanggaran</h2>

        <a href="{{ url()->previous() }}"
           class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">
            ← Kembali
        </a>
    </div>

    <!-- Tampilkan pesan error jika ada -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <strong>Periksa kembali input Anda:</strong>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.kategori.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Nama Pelanggaran -->
        <div>
            <label for="nama_pelanggaran" class="block font-medium">Nama Pelanggaran</label>
            <input type="text" name="nama_pelanggaran" id="nama_pelanggaran"
                value="{{ old('nama_pelanggaran') }}"
                class="border rounded w-full p-2 @error('nama_pelanggaran') border-red-500 @enderror">
            @error('nama_pelanggaran')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Poin -->
        <div>
            <label for="poin" class="block font-medium">Poin</label>
            <input type="number" name="poin" id="poin"
                value="{{ old('poin') }}"
                class="border rounded w-full p-2 @error('poin') border-red-500 @enderror">
            @error('poin')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Kategori -->
        <div>
            <label for="kategori" class="block font-medium">Kategori</label>
            <input type="text" name="kategori" id="kategori"
                value="{{ old('kategori') }}"
                class="border rounded w-full p-2 @error('kategori') border-red-500 @enderror">
            @error('kategori')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Deskripsi -->
        <div>
            <label for="deskripsi" class="block font-medium">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="3"
                class="border rounded w-full p-2 @error('deskripsi') border-red-500 @enderror"
                placeholder="Masukkan deskripsi pelanggaran">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tombol Simpan -->
        <button type="submit"
            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
            Simpan
        </button>
    </form>
</div>
@endsection
