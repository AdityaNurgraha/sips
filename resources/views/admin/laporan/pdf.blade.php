<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Laporan Pelanggaran</title>
    <style>
        body { font-family: Cambria, sans-serif; font-size: 12px; line-height: 1.6; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background: #f2f2f2; }
        .kop { text-align: center; margin-bottom: 15px; }
        .kop img { width: 100%; max-height: 120px; }
        .content { margin-top: 10px; }
        .ttd { margin-top: 50px; text-align: right; }
    </style>
</head>
<body>

    <!-- KOP SURAT -->
    <div class="kop">
        <img src="{{ public_path('images/KopSurat.png') }}" alt="KOP Sekolah">
    </div>

    <!-- Isi Surat -->
    <div class="content">
        <h3 style="text-align:center; text-decoration: underline;">SURAT LAPORAN PELANGGARAN SISWA</h3>
        <p style="text-align:center;">Nomor: {{ date('Y') }}/LAP-PEL/{{ $hasilOne->id ?? 'XXX' }}</p>

        <p>Kepada Yth,</p>
        <p>Orang Tua/Wali dari:</p>

        <!-- Detail Siswa -->
        <table style="margin-top:10px; margin-bottom:15px; border: none;">
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

        <p>Berdasarkan catatan tata tertib sekolah, siswa atas nama tersebut di atas telah melakukan pelanggaran sebagai berikut:</p>

        <!-- Tabel Pelanggaran -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Nama Pelanggaran</th>
                    <th>Deskripsi</th>
                    <th>Tanggal</th>
                    <th>Poin</th>
                </tr>
            </thead>
            <tbody>
                @foreach($hasilAll as $i => $row)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $row->kategori_label ?? '-' }}</td>
                    <td>{{ $row->kategori_name ?? $row->nama_pelanggaran ?? '-' }}</td>
                    <td>{{ $row->kategori_desc ?? '-' }}</td>
                    <td>{{ $row->created_at->format('d-m-Y') }}</td>
                    <td>{{ $row->kategori_point ?? $row->poin ?? $row->point ?? 0 }}</td>
                </tr>
                @endforeach
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

        <p>Demikian surat laporan ini kami sampaikan sebagai bahan perhatian dan pembinaan lebih lanjut dari pihak orang tua/wali siswa.</p>

        <!-- Tanda Tangan -->
        <div class="ttd">
            <p>Tasikmalaya, {{ now()->translatedFormat('d F Y') }}</p>
            <br><br><br>
            <p><u>Kepala Sekolah</u></p>
        </div>
    </div>

</body>
</html>
