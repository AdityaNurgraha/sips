<x-guest-layout>
    <div class="space-y-6">

        <!-- Tombol Kembali -->
        <a href="{{ route('login') }}"
           class="inline-flex items-center text-blue-600 hover:text-blue-800 transition">
            ← Kembali
        </a>

        <h2 class="text-2xl font-bold text-center text-blue-600">
            Daftar Akun Baru
        </h2>
        <p class="text-center text-gray-600 text-sm">
            Buat akun untuk mengakses sistem pencatatan pelanggaran siswa
        </p>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nama Lengkap')" />
                <x-text-input id="name"
                    class="block mt-1 w-full rounded-lg border-gray-300 bg-white"
                    type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email"
                    class="block mt-1 w-full rounded-lg border-gray-300 bg-white"
                    type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- NUPTK -->
            <div>
                <x-input-label for="nuptk" :value="__('NUPTK')" />
                <x-text-input id="nuptk"
                    class="block mt-1 w-full rounded-lg border-gray-300 bg-white"
                    type="text" name="nuptk" :value="old('nuptk')" required />
                <x-input-error :messages="$errors->get('nuptk')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password"
                    class="block mt-1 w-full rounded-lg border-gray-300 bg-white"
                    type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                <x-text-input id="password_confirmation"
                    class="block mt-1 w-full rounded-lg border-gray-300 bg-white"
                    type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Tombol -->
            <div class="flex items-center justify-between mt-6">
                <a href="{{ route('login') }}"
                   class="text-sm text-gray-600 hover:text-blue-600 transition">
                    {{ __('Sudah punya akun? Login') }}
                </a>

                <x-primary-button class="px-6 py-2">
                    {{ __('Daftar') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
