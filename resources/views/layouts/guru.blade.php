<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Guru</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        body {
            background-image: url('/bgutama.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            font-family: 'Inter', sans-serif;
        }

        .overlay {
            background-color: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(6px);
            min-height: 100vh;
        }

        aside {
            background-color: rgba(31, 41, 55, 0.95);
            backdrop-filter: blur(4px);
        }

        header {
            background-color: rgba(37, 99, 235, 0.95);
            backdrop-filter: blur(4px);
        }

        footer {
            background-color: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(3px);
        }
    </style>
</head>

<body class="font-sans antialiased">

    <div class="overlay min-h-screen flex" x-data="{ open: false }">

        @auth
        @if(Auth::user()->role === 'guru')

        <!-- OVERLAY (Mobile) -->
        <div x-show="open" @click="open = false" class="fixed inset-0 bg-black/40 z-20 lg:hidden"></div>

        <!-- SIDEBAR -->
        <aside
            class="fixed z-30 inset-y-0 left-0 w-64 transform 
            -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out
            flex flex-col text-white"
            :class="{ 'translate-x-0' : open }">

            <div class="p-6 text-xl font-bold border-b border-gray-700">
                SIPS - Guru
            </div>

            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('guru.dashboard') }}"
                   class="block px-3 py-2 rounded
                   {{ request()->routeIs('guru.dashboard') ? 'bg-blue-600' : 'hover:bg-blue-700' }}">
                   Dashboard
                </a>

                <a href="{{ route('guru.pelanggaran.index') }}"
                   class="block px-3 py-2 rounded
                   {{ request()->routeIs('guru.pelanggaran.*') ? 'bg-blue-600 ' : 'hover:bg-blue-700' }}">
                   List Pelanggaran
                </a>

                <a href="{{ route('guru.profile.edit') }}"
                   class="block px-3 py-2 rounded
                   {{ request()->routeIs('guru.profile.edit') ? 'bg-blue-600 ' : 'hover:bg-blue-700' }}">
                   Profil Saya
                </a>

                <form action="{{ route('logout') }}" method="POST" class="mt-6">
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

        <!-- MAIN WRAPPER -->
        <div class="flex-1 flex flex-col lg:ml-64 w-full">

            <!-- HEADER -->
            <header class="flex items-center justify-between px-4 md:px-6 py-4 text-white shadow-md">

                <!-- Toggle button (mobile) -->
                <button @click="open = true" class="lg:hidden">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <div class="text-lg font-bold hidden sm:block">
                    SIPS - Guru
                </div>

                <!-- PROFILE DROPDOWN -->
                <div x-data="{ openProfile: false }" class="relative">
                    <button @click="openProfile = !openProfile" class="flex items-center space-x-3">
                        <span class="hidden sm:block">{{ Auth::user()->name ?? 'Guest' }}</span>

                        <img src="{{ Auth::user()->photo_url }}"
                             class="w-9 h-9 rounded-full border-2 border-white object-cover"
                             alt="avatar">
                    </button>

                    <div x-show="openProfile"
                         @click.away="openProfile = false"
                         x-transition
                         class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg text-black py-2 z-50">

                        <a href="{{ route('guru.profile.edit') }}"
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

            <!-- CONTENT -->
            <main class="flex-1 p-4 md:p-6">
                @yield('content')
            </main>

            <!-- FOOTER -->
            <footer class="text-center text-xs md:text-sm text-gray-600 py-4 border-t">
                Copyright © {{ date('Y') }} | SIPS Guru
            </footer>

        </div>

    </div>

</body>

</html>
