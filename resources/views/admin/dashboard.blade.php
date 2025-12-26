@extends('layouts.app')

@section('content')
<style>
    /* ===== Background transparan dari folder public ===== */
    body {
        background-image: url('/bglogin.jpg'); /* letakkan file tampilan1.jpg di folder public */
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        background-repeat: no-repeat;
    }

    /* Efek transparan di kontainer utama */
    .content-card {
        background-color: rgba(255, 255, 255, 0.9); /* Putih semi-transparan */
        backdrop-filter: blur(6px);
        border-radius: 0.75rem; /* rounded-lg */
        padding: 1.5rem; /* p-6 */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        margin-top: 1rem;
    }
</style>

<div class="content-card">
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6">
        <strong>Note:</strong> Jika Siswa Melebihi Batas Point dari database Maka Akan Diberi Surat Teguran!!!
    </div>

    <!-- Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-blue-500 text-white p-6 rounded-lg shadow">
            <div class="text-3xl font-bold">{{ $jumlahSiswaMelanggar }}</div>
            <div class="text-sm">Jumlah Siswa Melanggar</div>
        </div>
        <div class="bg-green-500 text-white p-6 rounded-lg shadow">
            <div class="text-3xl font-bold">{{ $jumlahPelanggaran }}</div>
            <div class="text-sm">Total Pelanggaran</div>
        </div>
        <div class="bg-gray-700 text-white p-6 rounded-lg shadow">
            <div class="text-3xl font-bold">{{ $jumlahUser }}</div>
            <div class="text-sm">Jumlah User</div>
        </div>
        <div class="bg-red-500 text-white p-6 rounded-lg shadow">
            <div class="text-3xl font-bold">{{ $jumlahGuru }}</div>
            <div class="text-sm">Jumlah Guru</div>
        </div>
    </div>

    <!-- Tables -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Top Pelanggaran -->
        <div class="bg-white rounded-lg shadow p-4">
            <h2 class="text-lg font-semibold mb-2">Top Pelanggaran</h2>
            <table class="w-full border">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="p-2 border">#</th>
                        <th class="p-2 border">Nama Pelanggaran</th>
                        <th class="p-2 border">Total Pelanggaran</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($topPelanggaran as $index => $item)
                        <tr>
                            <td class="p-2 border">{{ $index + 1 }}</td>
                            <td class="p-2 border">
                                {{ $item->kategoriPelanggaran->nama_pelanggaran ?? 'Tidak Diketahui' }}
                            </td>
                            <td class="p-2 border">{{ $item->total }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-2 text-center">No data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Top Siswa -->
        <div class="bg-white rounded-lg shadow p-4">
            <h2 class="text-lg font-semibold mb-2">Top Siswa</h2>
            <table class="w-full border">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="p-2 border">#</th>
                        <th class="p-2 border">Nama Siswa</th>
                        <th class="p-2 border">Total Poin</th>
                        <th class="p-2 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($topSiswa as $index => $siswa)
                        <tr>
                            <td class="p-2 border">{{ $index + 1 }}</td>
                            <td class="p-2 border">{{ $siswa->nama_siswa }}</td>
                            <td class="p-2 border">
                                @php
                                    $warna = 'text-green-600 font-bold';
                                    if ($siswa->total_poin >= 51 && $siswa->total_poin <= 70) {
                                        $warna = 'text-yellow-600 font-bold';
                                    } elseif ($siswa->total_poin >= 71) {
                                        $warna = 'text-red-600 font-bold';
                                    }
                                @endphp
                                <span class="{{ $warna }}">
                                    {{ $siswa->total_poin }}
                                </span>
                            </td>
                            <td class="p-2 border">
                                <a href="{{ route('admin.pelanggaran.index', ['nisn' => $siswa->nisn]) }}"
                                   class="text-blue-500 hover:underline">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-2 text-center">No data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
