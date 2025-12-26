@extends('layouts.app')

@section('content')
<div class="p-6">

    <!-- Header + Tombol Kembali -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Edit Kategori Pelanggaran</h2>

        <a href="{{ url()->previous() }}"
           class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">
            ← Kembali
        </a>
    </div>

    {{-- Form untuk update kategori --}}
    <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Nama Pelanggaran -->
        <div>
            <label class="block font-semibold mb-1">Nama Pelanggaran</label>
            <input 
                type="text" 
                name="nama_pelanggaran" 
                class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" 
                value="{{ old('nama_pelanggaran', $kategori->nama_pelanggaran) }}" 
                required
            >
        </div>

        <!-- Poin -->
        <div>
            <label class="block font-semibold mb-1">Poin</label>
            <input 
                type="number" 
                name="poin" 
                class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" 
                value="{{ old('poin', $kategori->poin) }}" 
                min="1" 
                required
            >
        </div>

        <!-- Kategori -->
        <div>
            <label class="block font-semibold mb-1">Kategori</label>
            <input 
                type="text" 
                name="kategori" 
                class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" 
                value="{{ old('kategori', $kategori->kategori) }}" 
                placeholder="Contoh: Disiplin, Kerapihan, Tata Tertib"
            >
        </div>

        <!-- Deskripsi -->
        <div>
            <label class="block font-semibold mb-1">Deskripsi</label>
            <textarea 
                name="deskripsi" 
                rows="3" 
                class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                placeholder="Masukkan deskripsi pelanggaran">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
        </div>

        <!-- Tombol Update -->
        <button 
            type="submit" 
            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
            Update
        </button>
    </form>

</div>
@endsection
