@extends('layouts.app')

@section('content')
<div class="bg-white p-4 md:p-6 rounded-lg shadow">

    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-3 mb-4">
        <h1 class="text-xl md:text-2xl font-bold">Data Siswa</h1>

        <a href="{{ route('admin.siswa.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded text-center hover:bg-blue-700">
            + Tambah Siswa
        </a>
    </div>

    <!-- Wrapper agar tabel tidak melebar di mobile -->
    <div class="overflow-x-auto">
        <table class="w-full min-w-[600px] border-collapse border text-sm">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="border p-2">NIS</th>
                    <th class="border p-2">Nama</th>
                    <th class="border p-2">Kelas</th>

                    <!-- Jurusan disembunyikan di layar kecil -->
                    <th class="border p-2 hidden md:table-cell">Jurusan</th>

                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswa as $item)
                <tr class="hover:bg-gray-50">
                    <td class="border p-2">{{ $item->nis }}</td>
                    <td class="border p-2">{{ $item->nama }}</td>
                    <td class="border p-2">{{ $item->kelas }}</td>

                    <!-- Jurusan -->
                    <td class="border p-2 hidden md:table-cell">
                        {{ $item->jurusan }}
                    </td>

                    <td class="border p-2">
                        <div class="flex flex-col md:flex-row gap-2">
                            <a href="{{ route('admin.siswa.edit', $item->id) }}"
                               class="bg-yellow-500 text-white px-3 py-1 rounded text-center">
                                Edit
                            </a>

                            <form action="{{ route('admin.siswa.destroy', $item->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="bg-red-600 text-white px-3 py-1 rounded w-full">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
