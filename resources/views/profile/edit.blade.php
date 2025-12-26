@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="px-4 py-6 max-w-4xl mx-auto">

    <h2 class="text-2xl font-bold mb-6 text-center md:text-left">Edit Profil</h2>

    {{-- NOTIFIKASI --}}
    @if (session('status'))
        <div class="mb-6 p-4 rounded-lg text-white text-center text-sm sm:text-base
            @if(session('status') === 'profile-updated') bg-green-600 
            @elseif(session('status') === 'password-updated') bg-blue-600
            @elseif(session('status') === 'user-deleted') bg-red-600
            @endif">
            
            @if(session('status') === 'profile-updated')
                Informasi akun berhasil diperbarui!
            @elseif(session('status') === 'password-updated')
                Password berhasil diubah!
            @elseif(session('status') === 'user-deleted')
                Akun berhasil dihapus.
            @else
                Perubahan berhasil disimpan.
            @endif
        </div>
    @endif

    {{-- Informasi Akun --}}
    <div class="bg-white p-5 sm:p-7 rounded-lg shadow mb-6">
        <h3 class="text-lg font-semibold mb-4">Informasi Akun</h3>
        <div class="overflow-x-auto">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    {{-- Ubah Password --}}
    <div class="bg-white p-5 sm:p-7 rounded-lg shadow mb-6">
        <h3 class="text-lg font-semibold mb-4">Ubah Password</h3>
        <div class="overflow-x-auto">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    {{-- Hapus Akun --}}
    <div class="bg-white p-5 sm:p-7 rounded-lg shadow">
        <h3 class="text-lg font-semibold mb-4">Hapus Akun</h3>
        <div class="overflow-x-auto">
            @include('profile.partials.delete-user-form')
        </div>
    </div>

</div>
@endsection
