@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow w-full lg:w-1/2 mx-auto">
    <h1 class="text-2xl font-bold mb-4">Edit Data Siswa</h1>

    <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="block">NIS</label>
            <input type="text" name="nis" value="{{ $siswa->nis }}" class="border p-2 w-full" required>
        </div>

        <div class="mb-3">
            <label class="block">Nama</label>
            <input type="text" name="nama" value="{{ $siswa->nama }}" class="border p-2 w-full" required>
        </div>

        <div class="mb-3">
            <label class="block">Kelas</label>
            <input type="text" name="kelas" value="{{ $siswa->kelas }}" class="border p-2 w-full" required>
        </div>

        <div class="mb-3">
            <label class="block">Jurusan</label>
            <input type="text" name="jurusan" value="{{ $siswa->jurusan }}" class="border p-2 w-full" required>
        </div>

        <button class="bg-yellow-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
