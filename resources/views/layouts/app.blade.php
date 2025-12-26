<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        body {
            background-image: url('/bgutama.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
        }
        .main-wrapper {
            background-color: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(6px);
        }
    </style>
</head>

<body class="font-sans antialiased">

<div x-data="{ sidebarOpen: false }" class="min-h-screen flex main-wrapper">

    @auth
    @if(Auth::user()->role === 'admin')

    <!-- SIDEBAR -->
    <aside
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed z-40 inset-y-0 left-0 w-64 bg-gray-800 text-white transform transition-transform duration-300
        md:translate-x-0 md:static md:inset-0 md:flex md:flex-col bg-opacity-90 backdrop-blur-lg">

        <div class="p-6 text-xl font-bold border-b border-gray-700 flex justify-between items-center">
            <span>SIPS - Admin</span>
            <button @click="sidebarOpen = false" class="md:hidden">✕</button>
        </div>

        <!-- NAVIGATION -->
        <nav class="flex-1 p-4 space-y-2">

            <!-- DASHBOARD -->
            <a href="{{ route('admin.dashboard') }}"
               class="block px-3 py-2 rounded {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600' : 'hover:bg-blue-700' }}">
                Dashboard
            </a>

            <!-- DATA KATEGORI -->
            <div x-data="{ open: {{ request()->routeIs('admin.kategori.*') || request()->routeIs('admin.pelanggaran.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                        class="w-full flex justify-between items-center px-3 py-2 rounded hover:bg-gray-700
                        {{ request()->routeIs('admin.kategori.*') || request()->routeIs('admin.pelanggaran.*') ? 'bg-blue-600' : '' }}">
                    <span>Data Kategori</span>
                    <svg :class="{'rotate-90': open}" class="w-4 h-4 transform transition" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <div x-show="open" class="pl-6 space-y-1 mt-1">
                    <a href="{{ route('admin.kategori.index') }}"
                       class="block px-3 py-2 rounded {{ request()->routeIs('admin.kategori.*') ? 'bg-blue-600' : 'hover:bg-gray-700' }}">
                        Kategori Pelanggaran
                    </a>

                    <a href="{{ route('admin.pelanggaran.index') }}"
                       class="block px-3 py-2 rounded {{ request()->routeIs('admin.pelanggaran.*') ? 'bg-blue-600' : 'hover:bg-gray-700' }}">
                        List Pelanggaran
                    </a>
                </div>
            </div>

            <!-- ========================= -->
            <!-- DATA SISWA (NO DROPDOWN) -->
            <!-- ========================= -->
            <a href="{{ route('admin.siswa.index') }}"
               class="block px-3 py-2 rounded 
               {{ request()->routeIs('admin.siswa.*') ? 'bg-blue-600' : 'hover:bg-blue-700' }}">
                Data Siswa
            </a>

            <!-- PENGATURAN -->
            <div x-data="{ open: {{ request()->routeIs('admin.users.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                        class="w-full flex justify-between items-center px-3 py-2 rounded hover:bg-gray-700
                        {{ request()->routeIs('admin.users.*') ? 'bg-blue-600' : '' }}">
                    <span>Pengaturan</span>
                    <svg :class="{'rotate-90': open}" class="w-4 h-4 transform transition" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <div x-show="open" class="pl-6 space-y-1 mt-1">
                    <a href="{{ route('admin.users.index') }}"
                       class="block px-3 py-2 rounded {{ request()->routeIs('admin.users.*') ? 'bg-blue-600' : 'hover:bg-gray-700' }}">
                        Pengguna
                    </a>
                </div>
            </div>

            <!-- LAPORAN -->
            <a href="{{ route('laporan.index') }}"
               class="block px-3 py-2 rounded {{ request()->routeIs('laporan.*') ? 'bg-blue-600' : 'hover:bg-gray-700' }}">
                Laporan
            </a>

            <!-- LOGOUT -->
            <form action="{{ route('logout') }}" method="POST" class="mt-4">
                @csrf
                <button type="submit"
                        class="w-full text-left px-3 py-2 rounded bg-red-600 hover:bg-red-700">
                    Logout
                </button>
            </form>

        </nav>
    </aside>

    @endif
    @endauth

    <!-- MAIN AREA -->
    <div class="flex-1 flex flex-col min-h-screen w-full">

        <!-- HEADER -->
        <header class="bg-blue-600 text-white flex items-center justify-between px-6 py-4 bg-opacity-90 backdrop-blur-lg">
            <button @click="sidebarOpen = true" class="md:hidden text-2xl">☰</button>
            <div class="text-lg font-bold">SIPS</div>

            <!-- PROFILE -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                    <span>{{ Auth::user()->name ?? 'Guest' }}</span>
                    <img src="{{ Auth::user()->photo_url }}"
                         class="w-9 h-9 rounded-full object-cover border border-white shadow">
                </button>

                <div x-show="open"
                     @click.away="open = false"
                     class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg text-black py-2 z-50">

                    <a href="{{ route('profile.edit') }}"
                       class="block px-4 py-2 hover:bg-gray-100">
                        Profil Saya
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full text-left px-4 py-2 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>

                </div>
            </div>
        </header>

        <main class="flex-1 p-6">
            @yield('content')
        </main>

        <footer class="text-center text-sm text-gray-600 py-4 border-t bg-white bg-opacity-80 backdrop-blur-sm">
            © 2025 All rights reserved | SIPS
        </footer>

    </div>

</div>

</body>
</html>
