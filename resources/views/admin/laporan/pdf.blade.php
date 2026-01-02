<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Laporan Pelanggaran</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.6;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #333;
            padding: 6px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #f2f2f2;
        }

        .kop {
            text-align: center;
            margin-bottom: 10px;
        }

        .kop img {
            width: 100%;
            max-height: 120px;
        }

        .content {
            margin-top: 10px;
        }

        .ttd {
            margin-top: 50px;
            text-align: right;
        }

        /* Hindari tabel terpotong antar halaman */
        tr {
            page-break-inside: avoid;
        }
    </style>
</head>
<body>

    {{-- KOP SURAT --}}
    <div class="kop">
        @if (file_exists(public_path('images/KopSurat.png')))
            <img src="{{ public_path('images/KopSurat.png') }}" alt="Kop Surat Sekolah">
        @endif
    </div>

    <div class="content">
        <h3 style="text-align:center; text-decoration: underline;">
            SURAT LAPORAN PELANGGARAN SISWA
        </h3>

        <p style="text-align:center;">
            Nomor: {{ date('Y') }}/LAP-PEL/{{ $hasilOne->id ?? 'XXX' }}
        </p>

        <p>Kepada Yth,</p>
        <p>Orang Tua / Wali dari:</p>

        {{-- DATA SISWA --}}
        <table style="border:none; margin-bottom:15px;">
            <tr>
                <td style="width:150px; border:none;">Nama Siswa</td>
                <td style="border:none;">: {{ $hasilOne->nama_siswa ?? '-' }}</td>
            </tr>
            <tr>
                <td style="border:none;">NISN</td>
                <td style="border:none;">: {{ $hasilOne->nisn ?? '-' }}</td>
            </tr>
            <tr>
                <td style="border:none;">Kelas</td>
                <td style="border:none;">: {{ $hasilOne->kelas ?? '-' }}</td>
            </tr>
        </table>

        <p>
            Berdasarkan catatan tata tertib sekolah, siswa atas nama tersebut di atas
            telah melakukan pelanggaran sebagai berikut:
        </p>

        {{-- TABEL PELANGGARAN --}}
        <table>
            <thead>
                <tr>
                    <th style="width:30px;">No</th>
                    <th>Kategori</th>
                    <th>Nama Pelanggaran</th>
                    <th>Deskripsi</th>
                    <th style="width:90px;">Tanggal</th>
                    <th style="width:60px;">Poin</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($hasilAll as $i => $row)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $row->kategori_label ?? '-' }}</td>
                        <td>{{ $row->kategori_name ?? $row->nama_pelanggaran ?? '-' }}</td>
                        <td>{{ $row->kategori_desc ?? '-' }}</td>
                        <td>{{ optional($row->created_at)->format('d-m-Y') }}</td>
                        <td>{{ $row->kategori_point ?? $row->poin ?? $row->point ?? 0 }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center;">
                            Tidak ada data pelanggaran.
                        </td>
                    </tr>
                @endforelse

                <tr>
                    <td colspan="5" style="text-align:right;"><strong>Total Pelanggaran</strong></td>
                    <td><strong>{{ $hasilTotal->total_pelanggaran ?? 0 }}</strong></td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align:right;"><strong>Total Poin</strong></td>
                    <td><strong>{{ $hasilTotal->total_point ?? 0 }}</strong></td>
                </tr>
            </tbody>
        </table>

        <p style="margin-top:15px;">
            Demikian surat laporan ini kami sampaikan sebagai bahan perhatian dan
            pembinaan lebih lanjut dari pihak orang tua/wali siswa.
        </p>

        {{-- TANDA TANGAN --}}
        <div class="ttd">
            <p>Tasikmalaya, {{ now()->translatedFormat('d F Y') }}</p>
            <br><br><br>
            <p><u>Kepala Sekolah</u></p>
        </div>
    </div>

</body>
</html>
