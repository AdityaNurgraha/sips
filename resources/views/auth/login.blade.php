<x-guest-layout>
    <style>
        /* ====== Background dari folder public ====== */
        body {
            background-image: url('/bglogin.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        /* ====== Kotak login transparan ====== */
        .login-card {
            background-color: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
        }

        /* ====== Input style ====== */
        .login-card input {
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid #d1d5db;
        }

        .login-card input:focus {
            border-color: #3b82f6;
            outline: none;
        }

        /* ====== Tombol login ====== */
        .btn-login {
            background-color: #2563eb;
            color: white;
            padding: 0.5rem 1.25rem;
            border-radius: 0.375rem;
            transition: background-color 0.3s ease;
        }

        .btn-login:hover {
            background-color: #1d4ed8;
        }

        /* Tombol kembali */
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            background-color: rgba(255, 255, 255, 0.6);
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.875rem;
            color: #374151;
            backdrop-filter: blur(5px);
            transition: 0.3s;
        }

        .btn-back:hover {
            background-color: rgba(255, 255, 255, 0.9);
        }
    </style>

    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-md p-8 login-card">

            <!-- Tombol Kembali -->
            <a href="{{ url('/') }}" class="btn-back mb-4 inline-block">
                ← Kembali
            </a>

            <!-- Logo / Judul -->
            <div class="text-center mb-6">
                <img src="{{ asset('bgatas1.png') }}" alt="Logo SIPS"
                    class="mx-auto w-16 h-16 mb-2"
                    onerror="this.style.display='none';">
                <h1 class="text-2xl font-bold text-gray-800">SIPS</h1>
                <p class="text-gray-600 text-sm">Sistem Informasi Pelanggaran Siswa</p>
            </div>

            <!-- Status Session -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Form Login -->
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email"
                        class="block mt-1 w-full rounded-md shadow-sm"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password"
                        class="block mt-1 w-full rounded-md shadow-sm"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring focus:ring-blue-200"
                        name="remember">
                    <label for="remember_me" class="ml-2 text-sm text-gray-600">
                        {{ __('Remember me') }}
                    </label>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between mt-4">
                    <button type="submit" class="btn-login">
                        {{ __('Log in') }}
                    </button>
                </div>
            </form>

            <!-- Divider -->
            <div class="mt-6 border-t pt-4 text-center text-sm text-gray-500">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-medium">
                    Daftar Sekarang
                </a>
            </div>

        </div>
    </div>
</x-guest-layout>
