@extends('layouts.app')

@section('content')
<div class="p-6">
    <!-- Judul Halaman -->
    <h2 class="text-2xl font-bold mb-4">Kategori Pelanggaran</h2>

    <!-- Tombol Tambah Data -->
    <div class="mb-4">
        <a href="{{ route('admin.kategori.create') }}"
           class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
            + Tambah Data
        </a>
    </div>

    @php
        $grouped = $kategori->groupBy('kategori');
    @endphp

    @forelse($grouped as $kategoriName => $items)
        <div class="mb-8">
            <h3 class="text-xl font-semibold mb-3 border-b pb-1">
                {{ $kategoriName ?? 'Tidak Berkategori' }}
            </h3>

            <!-- Wrapper table (tambah bg-white agar tidak transparan) -->
            <div class="overflow-x-auto overflow-y-auto max-h-[500px] border rounded bg-white shadow">
                
                <table class="min-w-full border border-gray-300 text-sm bg-white">
                    <thead class="bg-gray-200 sticky top-0">
                        <tr>
                            <th class="px-4 py-2 text-center w-10">#</th>
                            <th class="px-4 py-2">Nama Pelanggaran</th>
                            <th class="px-4 py-2 text-center w-20">Poin</th>
                            <th class="px-4 py-2">Deskripsi</th>
                            <th class="px-4 py-2 text-center w-40">Aksi</th>
                        </tr>
                    </thead>

                    <!-- Tambah bg-white agar isi tabel tidak transparan -->
                    <tbody class="bg-white">
                        @foreach($items as $item)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2 text-center">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 whitespace-nowrap">{{ $item->nama_pelanggaran }}</td>
                                <td class="px-4 py-2 text-center">{{ $item->poin }}</td>
                                <td class="px-4 py-2">{{ $item->deskripsi ?? '-' }}</td>
                                <td class="px-4 py-2 text-center space-x-2">

                                    <a href="{{ route('admin.kategori.edit', $item->id) }}"
                                       class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.kategori.destroy', $item->id) }}"
                                          method="POST"
                                          class="inline-block"
                                          onsubmit="return confirm('Yakin hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                                            Hapus
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    @empty
        <p class="text-gray-500">Belum ada data kategori pelanggaran.</p>
    @endforelse
</div>
@endsection
