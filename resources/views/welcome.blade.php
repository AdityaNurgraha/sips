<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIPS - Sistem Informasi Pelanggaran Siswa</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ===== Background dari folder public ===== */
        body {
            background-image: url('/tampilan1.jpg'); /* Pastikan gambar ada di folder: public/tampilan1.jpg */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        /* ===== Efek transparan lembut ===== */
        .bg-blue-transparent {
            background-color: rgba(37, 99, 235, 0.85);
        }

        .bg-indigo-transparent {
            background: linear-gradient(to right, rgba(59, 130, 246, 0.85), rgba(79, 70, 229, 0.85));
        }

        .bg-footer-transparent {
            background-color: rgba(17, 24, 39, 0.85);
        }

        /* ===== Logo style ===== */
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo img {
            width: 45px;        /* ukuran logo */
            height: 45px;
            object-fit: contain;
            border-radius: 8px; /* sedikit rounded */
        }

        .logo span {
            font-size: 1.5rem;
            font-weight: bold;
        }
    </style>
</head>

<body class="antialiased text-gray-800">

    <!-- Header -->
    <header class="bg-blue-transparent text-white shadow">
        <div class="max-w-7xl mx-auto flex justify-between items-center py-4 px-6">
            
            <!-- ===== Logo Section ===== -->
            <div class="logo">
                <img src="/" alt="Logo SIPS" onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';">
                <span style="display:none;"> SIPS</span>
            </div>

            <div class="space-x-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="bg-white text-blue-600 px-4 py-2 rounded shadow hover:bg-gray-100 transition">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="px-4 py-2 bg-white text-blue-600 rounded shadow hover:bg-gray-100 transition">
                            Login
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="px-4 py-2 bg-yellow-400 text-white rounded shadow hover:bg-yellow-500 transition">
                                Register
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-indigo-transparent text-white py-20 shadow-md">
        <div class="max-w-7xl mx-auto text-center px-4">
            <h2 class="text-4xl font-bold mb-4">Sistem Informasi Pelanggaran Siswa</h2>
            <p class="text-lg mb-6">
                Mencatat, memantau, dan mengelola data pelanggaran siswa secara efektif dan transparan.
            </p>
            <a href="{{ route('login') }}"
               class="px-6 py-3 bg-white text-blue-600 rounded-lg shadow hover:bg-gray-100 transition">
               Mulai Sekarang
            </a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h3 class="text-2xl font-bold mb-10 text-white drop-shadow-lg">✨ Fitur Utama SIPS</h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                    <div class="text-blue-600 text-4xl mb-4">📋</div>
                    <h4 class="font-bold mb-2">Data Kategori Pelanggaran</h4>
                    <p class="text-gray-600">
                        Mengelola kategori pelanggaran dengan poin sesuai tingkat kesalahan.
                    </p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                    <div class="text-blue-600 text-4xl mb-4">👨‍🎓</div>
                    <h4 class="font-bold mb-2">List Pelanggaran Siswa</h4>
                    <p class="text-gray-600">
                        Mencatat detail pelanggaran yang dilakukan oleh siswa untuk monitoring.
                    </p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                    <div class="text-blue-600 text-4xl mb-4">📊</div>
                    <h4 class="font-bold mb-2">Laporan & Monitoring</h4>
                    <p class="text-gray-600">
                        Menyediakan laporan rekap pelanggaran dan poin siswa secara otomatis.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-16 bg-blue-transparent text-white text-center">
        <h3 class="text-2xl font-bold mb-4">
            Siap memulai monitoring pelanggaran di sekolah Anda?
        </h3>
        <p class="mb-6">
            Gabung sekarang dan kelola data pelanggaran dengan lebih mudah dan terstruktur.
        </p>
        <a href="{{ route('register') }}"
           class="px-6 py-3 bg-yellow-400 rounded-lg shadow hover:bg-yellow-500 transition">
           Daftar Sekarang
        </a>
    </section>

    <!-- Footer -->
    <footer class="bg-footer-transparent text-gray-300 text-sm py-6 text-center">
        <p>© {{ date('Y') }} SIPS - Sistem Informasi Pelanggaran Siswa. Semua Hak Dilindungi.</p>
    </footer>

</body>
</html>
