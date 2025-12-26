@extends('layouts.app')

@section('title', 'Edit List Pelanggaran')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold mb-4">Edit List Pelanggaran</h2>

    <form action="{{ route('admin.pelanggaran.update', $pelanggaran->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Pilih Kelas -->
            <div>
                <label class="block font-semibold">Kelas</label>
                <select id="kelas-filter" class="w-full border rounded px-3 py-2">
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

            <!-- Pilih Siswa -->
            <div>
                <label class="block font-semibold">Nama Siswa</label>
                <select id="siswa-select" name="siswa_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">Pilih Siswa</option>
                    @foreach($siswa as $item)
                        <option value="{{ $item->id }}"
                            data-nis="{{ $item->nis }}"
                            data-nama="{{ $item->nama }}"
                            data-kelas="{{ $item->kelas }}"
                            {{ $pelanggaran->siswa_id == $item->id ? 'selected' : '' }}>
                            {{ $item->nama }} ({{ $item->kelas }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- NIS -->
            <div>
                <label class="block font-semibold">NIS</label>
                <input type="text" id="nis-input" class="w-full border rounded px-3 py-2" readonly>
            </div>

            <!-- Pelapor -->
            <div>
                <label class="block font-semibold">Pelapor</label>
                <select name="pelapor" class="w-full border rounded px-3 py-2">
                    <option value="">Pilih Salah Satu</option>
                    <option value="Guru BK" {{ $pelanggaran->pelapor == 'Guru BK' ? 'selected' : '' }}>Guru BK</option>
                    <option value="Wali Kelas" {{ $pelanggaran->pelapor == 'Wali Kelas' ? 'selected' : '' }}>Wali Kelas</option>
                    <option value="Guru" {{ $pelanggaran->pelapor == 'Guru' ? 'selected' : '' }}>Guru</option>
                </select>
            </div>

            <!-- Kategori Pelanggaran -->
            <div>
                <label class="block font-semibold">Kategori Pelanggaran</label>
                <select id="kategori-select" class="w-full border rounded px-3 py-2">
                    <option value="">Pilih Kategori</option>
                    @foreach($kategori->groupBy('kategori') as $kategoriNama => $items)
                        <option value="{{ $kategoriNama }}" {{ $items->contains('id', $pelanggaran->kategori_pelanggaran_id) ? 'selected' : '' }}>
                            {{ $kategoriNama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Pelanggaran -->
            <div>
                <label class="block font-semibold">Pelanggaran Dilakukan</label>
                <select name="kategori_pelanggaran_id" id="pelanggaran-select" class="w-full border rounded px-3 py-2" required>
                    <option value="">Pilih Pelanggaran</option>
                    @foreach($kategori as $item)
                        <option value="{{ $item->id }}" data-kategori="{{ $item->kategori }}" {{ $pelanggaran->kategori_pelanggaran_id == $item->id ? 'selected' : '' }}>
                            {{ $item->nama_pelanggaran }} ({{ $item->poin }} poin)
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Catatan -->
            <div class="md:col-span-2">
                <label class="block font-semibold">Catatan</label>
                <textarea name="note" rows="3" class="w-full border rounded px-3 py-2">{{ old('note', $pelanggaran->note) }}</textarea>
            </div>
        </div>

        <div class="flex space-x-2">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Update</button>
            <a href="{{ route('admin.pelanggaran.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Batal</a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const kelasFilter = document.getElementById('kelas-filter');
    const siswaSelect = document.getElementById('siswa-select');
    const nisInput = document.getElementById('nis-input');
    const allSiswaOptions = Array.from(siswaSelect.options);

    // Filter siswa berdasarkan kelas
    kelasFilter.addEventListener('change', function() {
        const selectedKelas = this.value;
        siswaSelect.innerHTML = '<option value="">Pilih Siswa</option>';

        allSiswaOptions.forEach(option => {
            if (!selectedKelas || option.dataset.kelas === selectedKelas) {
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

    // Trigger initial auto-fill
    const selectedSiswa = siswaSelect.querySelector('option[selected]');
    if(selectedSiswa) {
        nisInput.value = selectedSiswa.dataset.nis || '';
    }

    // Filter pelanggaran berdasarkan kategori
    const kategoriSelect = document.getElementById('kategori-select');
    const pelanggaranSelect = document.getElementById('pelanggaran-select');
    const pelanggaranOptions = Array.from(pelanggaranSelect.options);

    kategoriSelect.addEventListener('change', function () {
        const selectedKategori = this.value;
        pelanggaranSelect.innerHTML = '<option value="">Pilih Pelanggaran</option>';

        pelanggaranOptions.forEach(option => {
            if (!selectedKategori || option.dataset.kategori === selectedKategori) {
                pelanggaranSelect.appendChild(option.cloneNode(true));
            }
        });
    });
});
</script>
@endsection
