@extends('layouts.guru')

@section('title', 'Edit Pelanggaran Siswa')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold">Edit Pelanggaran Siswa</h2>
        <a href="{{ route('guru.pelanggaran.index') }}"
           class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">
            ← Kembali
        </a>
    </div>

    <form action="{{ route('guru.pelanggaran.update', $pelanggaran->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Pilih Kelas -->
            <div>
                <label class="block mb-1 font-medium">Kelas</label>
                <select id="kelas-filter" class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                    <option value="">Pilih Kelas</option>
                    @php
                        $kelasList = $siswa->pluck('kelas')->unique();
                    @endphp
                    @foreach($kelasList as $kelas)
                        <option value="{{ $kelas }}" {{ $pelanggaran->kelas == $kelas ? 'selected' : '' }}>
                            {{ $kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Nama Siswa -->
            <div>
                <label class="block mb-1 font-medium">Nama Siswa</label>
                <select id="siswa-select" name="siswa_id"
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200" required>
                    <option value="">Pilih Siswa</option>
                    @foreach($siswa as $item)
                        <option value="{{ $item->id }}"
                                data-nis="{{ $item->nis }}"
                                data-kelas="{{ $item->kelas }}"
                                data-kelas-siswa="{{ $item->kelas }}"
                                {{ $pelanggaran->siswa_id == $item->id ? 'selected' : '' }}>
                            {{ $item->nama }} ({{ $item->kelas }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- NIS (otomatis terisi) -->
            <div>
                <label class="block mb-1 font-medium">NIS</label>
                <input type="text" id="nis-input" class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200" 
                       value="{{ $pelanggaran->nisn }}" readonly>
            </div>

            <!-- Pelapor -->
            <div>
                <label class="block mb-1 font-medium">Pelapor</label>
                <select name="pelapor" class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200" required>
                    <option value="">Pilih Salah Satu</option>
                    <option value="Guru BK" {{ $pelanggaran->pelapor == 'Guru BK' ? 'selected' : '' }}>Guru BK</option>
                    <option value="Wali Kelas" {{ $pelanggaran->pelapor == 'Wali Kelas' ? 'selected' : '' }}>Wali Kelas</option>
                    <option value="Guru" {{ $pelanggaran->pelapor == 'Guru' ? 'selected' : '' }}>Guru</option>
                </select>
            </div>

            <!-- Kategori Pelanggaran -->
            <div>
                <label class="block mb-1 font-medium">Kategori Pelanggaran</label>
                <select id="kategori-select" class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                    <option value="">Pilih Kategori</option>
                    @foreach($kategori->groupBy('kategori') as $kategoriNama => $items)
                        <option value="{{ $kategoriNama }}"
                            {{ $items->contains('id', $pelanggaran->kategori_pelanggaran_id) ? 'selected' : '' }}>
                            {{ $kategoriNama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Pelanggaran Dilakukan -->
            <div>
                <label class="block mb-1 font-medium">Pelanggaran Dilakukan</label>
                <select name="kategori_pelanggaran_id" id="pelanggaran-select"
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200" required>
                    <option value="">Pilih Pelanggaran</option>
                    @foreach($kategori as $item)
                        <option value="{{ $item->id }}" data-kategori="{{ $item->kategori }}"
                            {{ $pelanggaran->kategori_pelanggaran_id == $item->id ? 'selected' : '' }}>
                            {{ $item->nama_pelanggaran }} ({{ $item->poin }} poin)
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Catatan -->
            <div class="md:col-span-2">
                <label class="block mb-1 font-medium">Catatan</label>
                <textarea name="note" rows="3"
                          class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">{{ $pelanggaran->note }}</textarea>
            </div>
        </div>

        <div class="flex justify-end space-x-2 mt-4">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">Update</button>
            <a href="{{ route('guru.pelanggaran.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">Batal</a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Filter Pelanggaran berdasarkan kategori
    const kategoriSelect = document.getElementById('kategori-select');
    const pelanggaranSelect = document.getElementById('pelanggaran-select');
    const options = Array.from(pelanggaranSelect.options);

    kategoriSelect.addEventListener('change', function () {
        const selectedKategori = this.value;
        pelanggaranSelect.innerHTML = '<option value="">Pilih Pelanggaran</option>';
        options.forEach(option => {
            if (!selectedKategori || option.dataset.kategori === selectedKategori) {
                pelanggaranSelect.appendChild(option.cloneNode(true));
            }
        });
    });

    // Filter Siswa berdasarkan kelas
    const kelasFilter = document.getElementById('kelas-filter');
    const siswaSelect = document.getElementById('siswa-select');
    const nisInput = document.getElementById('nis-input');
    const allSiswaOptions = Array.from(siswaSelect.options);

    kelasFilter.addEventListener('change', function() {
        const selectedKelas = this.value;
        siswaSelect.innerHTML = '<option value="">Pilih Siswa</option>';
        allSiswaOptions.forEach(option => {
            if (!selectedKelas || option.dataset.kelasSiswa === selectedKelas) {
                siswaSelect.appendChild(option.cloneNode(true));
            }
        });
        nisInput.value = '';
    });

    // Auto-fill NIS
    siswaSelect.addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        nisInput.value = selectedOption.dataset.nis || '';
    });

    // Old value saat validasi gagal
    const oldSelected = siswaSelect.querySelector('option[selected]');
    if(oldSelected) {
        nisInput.value = oldSelected.dataset.nis || '';
    }
});
</script>
@endsection
