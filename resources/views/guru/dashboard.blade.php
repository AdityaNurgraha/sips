@extends('layouts.guru')

@section('content')
<div class="bg-white rounded-xl shadow-md p-4 md:p-6 space-y-6">

    <!-- Header -->
    <div>
        <h1 class="text-xl md:text-2xl font-bold">Guru Dashboard</h1>
        <p class="mt-1 text-sm md:text-base text-gray-600">
            Halo, <span class="font-semibold">{{ auth()->user()->name }}</span>!
            Anda login sebagai <strong>Guru</strong>.
        </p>
    </div>

    <!-- Note -->
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded text-sm md:text-base">
        <strong>Note:</strong> Jika siswa melebihi batas point dari database,
        maka akan diberi surat teguran.
    </div>

    <!-- Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

        <div class="bg-green-500 text-white p-5 rounded-xl shadow-md flex flex-col justify-between">
            <div class="text-3xl md:text-4xl font-bold">
                {{ $jumlahPelanggaran }}
            </div>
            <div class="text-sm md:text-base mt-1">
                Total Pelanggaran
            </div>
        </div>

        <div class="bg-red-500 text-white p-5 rounded-xl shadow-md flex flex-col justify-between">
            <div class="text-3xl md:text-4xl font-bold">
                {{ $siswaMelanggar }}
            </div>
            <div class="text-sm md:text-base mt-1">
                Siswa Melanggar
            </div>
        </div>

    </div>

    <!-- Top Pelanggaran -->
    <div class="bg-white rounded-xl shadow p-4 md:p-6">
        <h2 class="text-base md:text-lg font-semibold mb-4">
            Top Pelanggaran
        </h2>

        <!-- Responsive Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 text-sm">
                <thead class="bg-gray-100">
                    <tr class="text-left">
                        <th class="p-3 border">#</th>
                        <th class="p-3 border">Nama Pelanggaran</th>
                        <th class="p-3 border">Total</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($topPelanggaran as $index => $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-3 border">{{ $index + 1 }}</td>
                        <td class="p-3 border">
                            {{ $item->kategoriPelanggaran->nama_pelanggaran ?? 'Tidak Diketahui' }}
                        </td>
                        <td class="p-3 border font-semibold">
                            {{ $item->total }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="p-4 text-center text-gray-500">
                            Tidak ada data
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection