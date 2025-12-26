<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIPS - Sistem Informasi Pelanggaran Siswa') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ===== Background dari folder public ===== */
        body {
            background-image: url('/bglogin.jpg'); /* Pastikan ada di folder public */
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

        /* ===== Kartu login transparan ===== */
        .login-container {
            background-color: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(12px);
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-container:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body class="font-sans antialiased text-gray-900">

    <div class="min-h-screen flex items-center justify-center px-4 py-10">
        <div class="w-full max-w-5xl rounded-2xl overflow-hidden flex flex-col md:flex-row login-container">
            
            <!-- Bagian Kiri: Branding -->
            <div class="hidden md:flex md:w-1/2 bg-indigo-transparent text-white flex-col justify-center items-center p-10 space-y-4">
                <h2 class="text-2xl font-bold">SIPS - Sistem Informasi Pelanggaran Siswa</h2>
                <p class="text-center text-sm leading-relaxed max-w-xs">
                    Mencatat, memantau, dan mengelola pelanggaran siswa secara efektif dan transparan.
                </p>
            </div>

            <!-- Bagian Kanan: Slot Form -->
            <div class="w-full md:w-1/2 p-8 md:p-12 flex items-center justify-center">
                <div class="w-full">
                    
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>

</body>
</html>
