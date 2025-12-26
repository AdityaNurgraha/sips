@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- Card Filter -->
    <div class="bg-white shadow rounded-lg border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 rounded-t-lg flex justify-between items-center">
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Laporan Data Pelanggaran</h2>
                <p class="text-sm text-gray-500">Gunakan form di bawah untuk menampilkan data sesuai kebutuhan.</p>
            </div>
        </div>

        <div class="p-6">
            <form method="GET" action="{{ route('laporan.index') }}" class="space-y-6">

                <!-- Input Manual -->
                <div>
                    <label for="keyword" class="block text-sm font-medium text-gray-700 mb-1">Cari (Nama / NISN / Kelas)</label>
                    <input type="text" id="keyword" name="keyword" value="{{ old('keyword', $keyword) }}"
                           placeholder="Ketik nama siswa, NISN, atau kelas..."
                           class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>

                <!-- Periode -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Periode:</label>
                    <div class="flex items-center space-x-2">
                        <input type="date" name="awal" value="{{ old('awal', $awal) }}"
                               class="flex-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <span class="text-gray-600 font-medium">S.D</span>
                        <input type="date" name="akhir" value="{{ old('akhir', $akhir) }}"
                               class="flex-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                    </div>
                </div>

                <!-- Tombol -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('laporan.index') }}"
                       class="px-4 py-2 rounded-md bg-red-600 text-white font-medium shadow hover:bg-red-700 focus:ring-2 focus:ring-offset-1 focus:ring-red-400">
                        Reset
                    </a>
                    <button type="submit"
                            class="px-4 py-2 rounded-md bg-blue-600 text-white font-medium shadow hover:bg-blue-700 focus:ring-2 focus:ring-offset-1 focus:ring-blue-400">
                        Submit
                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- Notif -->
    @if(isset($message) && $message)
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-md shadow">
            <p class="font-semibold">📢 Informasi:</p>
            <p>{{ $message }}</p>
        </div>
    @endif

    <!-- Card Hasil -->
    @if(isset($hasilAll) && $hasilAll->isNotEmpty())
        <div class="bg-white shadow rounded-lg border border-gray-200">
            <div class="px-6 py-3 border-b border-gray-200 bg-gray-50 rounded-t-lg flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-700">Pelanggaran Siswa</h2>

                <!-- Tombol Cetak PDF -->
                <form action="{{ route('laporan.pdf') }}" method="POST" target="_blank">
                    @csrf
                    <input type="hidden" name="keyword" value="{{ $keyword }}">
                    <input type="hidden" name="awal" value="{{ $awal }}">
                    <input type="hidden" name="akhir" value="{{ $akhir }}">
                    <button type="submit"
                        class="px-4 py-2 rounded-md bg-green-600 text-white font-medium shadow hover:bg-green-700 focus:ring-2 focus:ring-offset-1 focus:ring-green-400">
                        Cetak PDF
                    </button>
                </form>
            </div>
            <div class="p-6 space-y-6">

                <!-- Detail Siswa -->
                @if($hasilOne)
                <div class="bg-gray-50 border border-gray-200 rounded-md overflow-hidden">
                    <table class="w-full text-sm">
                        <tbody>
                            <tr class="border-b border-gray-200">
                                <td class="px-4 py-2 font-medium w-40">Kelas</td>
                                <td class="px-4 py-2">: {{ $hasilOne->kelas ?? '-' }}</td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <td class="px-4 py-2 font-medium">Nama Siswa</td>
                                <td class="px-4 py-2">: {{ $hasilOne->nama_siswa ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 font-medium">NISN</td>
                                <td class="px-4 py-2">: {{ $hasilOne->nisn ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endif

                <!-- Tabel Pelanggaran -->
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 text-sm divide-y divide-gray-200">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-left">#</th>
                                <th class="px-4 py-2 text-left">Kategori</th>
                                <th class="px-4 py-2 text-left">Nama Pelanggaran</th>
                                <th class="px-4 py-2 text-left">Deskripsi</th>
                                <th class="px-4 py-2 text-left">Catatan</th>
                                <th class="px-4 py-2 text-left">Dilaporkan Pada</th>
                                <th class="px-4 py-2 text-left">Poin</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($hasilAll as $i => $row)
                                @php
                                    $poin = $row->kategori_point ?? $row->poin ?? $row->point ?? 0;
                                    $warna = 'text-green-600 font-bold';
                                    if ($poin >= 51 && $poin <= 70) {
                                        $warna = 'text-yellow-600 font-bold';
                                    } elseif ($poin >= 71) {
                                        $warna = 'text-red-600 font-bold';
                                    }
                                @endphp
                                <tr>
                                    <td class="px-4 py-2">{{ $i+1 }}</td>
                                    <td class="px-4 py-2">{{ $row->kategori_label ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $row->kategori_name ?? $row->nama_pelanggaran ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $row->kategori_desc ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $row->catatan ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $row->created_at->format('Y-m-d') }}</td>
                                    <td class="px-4 py-2"><span class="{{ $warna }}">{{ $poin }}</span></td>
                                </tr>
                            @endforeach

                            <!-- Total -->
                            <tr class="bg-gray-50 font-semibold">
                                <td colspan="3" class="px-4 py-2">Jumlah Pelanggaran yang telah dilakukan</td>
                                <td colspan="2" class="px-4 py-2">{{ $hasilTotal->total_pelanggaran ?? 0 }}</td>
                                <td class="px-4 py-2">Jumlah Point</td>
                                <td class="px-4 py-2">{{ $hasilTotal->total_point ?? 0 }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    @endif

</div>
@endsection
