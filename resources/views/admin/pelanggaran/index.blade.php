@extends('layouts.app')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">List Pelanggaran</h2>

    <!-- Tombol Tambah -->
    <div class="mb-4 text-right">
        <a href="{{ route('admin.pelanggaran.create') }}"
           class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
            + Add Data
        </a>
    </div>

    <!-- Tabel -->
    <div class="overflow-x-auto bg-white shadow rounded">
        <table class="w-full border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-center">#</th>
                    <th class="px-4 py-2 text-center">NISN</th>
                    <th class="px-4 py-2">Nama Siswa</th>
                    <th class="px-4 py-2 text-center">Kelas</th>
                    <th class="px-4 py-2 text-center">Kategori Pelanggaran</th>
                    <th class="px-4 py-2 text-center">Nama Pelanggaran</th>
                    <th class="px-4 py-2 text-center">Poin</th>
                    <th class="px-4 py-2">Note</th>
                    <th class="px-4 py-2 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pelanggaran as $i => $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2 text-center">{{ $pelanggaran->firstItem() + $i }}</td>
                        <td class="px-4 py-2 text-center">{{ $item->nisn }}</td>
                        <td class="px-4 py-2">{{ $item->nama_siswa }}</td>
                        <td class="px-4 py-2 text-center">{{ $item->kelas }}</td>

                        <!-- Kategori Pelanggaran -->
                        <td class="px-4 py-2 text-center">
                            {{ $item->kategoriPelanggaran->kategori ?? '-' }}
                        </td>

                        <!-- Nama Pelanggaran -->
                        <td class="px-4 py-2 text-center">
                            {{ $item->kategoriPelanggaran->nama_pelanggaran ?? '-' }}
                        </td>

                        <!-- Poin -->
                        <td class="px-4 py-2 text-center">
                            {{ $item->kategoriPelanggaran->poin ?? '-' }}
                        </td>

                        <td class="px-4 py-2">{{ $item->note ?? '-' }}</td>

                        <td class="px-4 py-2 text-center space-x-2">
                            <a href="{{ route('admin.pelanggaran.edit', $item->id) }}"
                               class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">
                                Edit
                            </a>
                            <form action="{{ route('admin.pelanggaran.destroy', $item->id) }}" method="POST"
                                  class="inline-block"
                                  onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-4 py-2 text-center text-gray-500">
                            Belum ada data pelanggaran.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $pelanggaran->links() }}
    </div>
</div>
@endsection
