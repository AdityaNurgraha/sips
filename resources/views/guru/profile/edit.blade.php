@extends('layouts.guru')

@section('title', 'Edit Profile')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6">

    <h2 class="text-2xl font-bold text-gray-800 mb-4">Edit Profile</h2>
    <p class="text-sm text-gray-600 mb-6">
        Update informasi akun Anda termasuk nama, email, dan foto profil.
    </p>

    <form method="POST" action="{{ route('guru.profile.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PATCH')

        <!-- FOTO PROFIL -->
        <div class="flex items-center gap-5">
            <img id="imagePreview"
                 src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('default-avatar.png') }}"
                 class="w-24 h-24 object-cover rounded-full border"
                 alt="Foto Profil">

            <div>
                <label class="text-sm font-medium">Upload Foto Baru:</label>
                <input type="file" name="photo" accept="image/*"
                       class="block mt-2 border p-2 rounded w-full"
                       onchange="previewImage(event)">

                @error('photo')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror

                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, WEBP | Max 2MB</p>
            </div>
        </div>

        <!-- NAME -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
            <input type="text" id="name" name="name"
                   class="mt-1 block w-full p-2 border rounded"
                   value="{{ old('name', $user->name) }}" required>

            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- EMAIL -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email"
                   class="mt-1 block w-full p-2 border rounded"
                   value="{{ old('email', $user->email) }}" required>

            @error('email')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- BUTTON -->
        <div class="flex items-center gap-4">
            <button
                class="bg-blue-600 text-white px-5 py-2 rounded shadow hover:bg-blue-700 transition">
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
                <span class="text-green-600 text-sm">Perubahan berhasil disimpan!</span>
            @endif
        </div>
    </form>

</div>

<script>
    function previewImage(event) {
        let img = document.getElementById('imagePreview');
        img.src = URL.createObjectURL(event.target.files[0]);
    }
</script>
@endsection
