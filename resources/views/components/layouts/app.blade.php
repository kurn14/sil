<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Sistem Informasi Layanan BPK Wilayah DIY' }}</title>

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Leaflet CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased text-gray-900 bg-gray-50 min-h-screen flex flex-col">
        
        <!-- Navbar -->
        <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="/" class="flex items-center gap-2">
                                <x-heroicon-s-building-library class="w-8 h-8 text-primary-600" />
                                <span class="font-bold text-xl tracking-tight text-gray-900">BPK <span class="text-primary-600">DIY</span></span>
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <a href="/" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out {{ request()->is('/') ? '!border-primary-500 !text-gray-900' : '' }}">
                                {{ __('Beranda') }}
                            </a>
                            <a href="/heritage-sites" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out {{ request()->is('heritage-sites*') ? '!border-primary-500 !text-gray-900' : '' }}">
                                {{ __('Katalog Situs') }}
                            </a>
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ms-6 gap-4">
                        <!-- Language Switcher -->
                        <div class="relative group">
                            <button type="button" class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-gray-700 font-medium">
                                <x-heroicon-m-language class="w-5 h-5" />
                                {{ strtoupper(app()->getLocale()) }}
                                <x-heroicon-s-chevron-down class="w-4 h-4" />
                            </button>
                            <div class="absolute right-0 mt-2 w-32 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 border border-gray-100">
                                <a href="/lang/id" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary-600 rounded-t-md {{ app()->getLocale() === 'id' ? 'bg-primary-50 text-primary-600' : '' }}">Indonesia (ID)</a>
                                <a href="/lang/en" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary-600 rounded-b-md {{ app()->getLocale() === 'en' ? 'bg-primary-50 text-primary-600' : '' }}">English (EN)</a>
                            </div>
                        </div>

                        @auth('applicant')
                            <a href="/applicant" class="text-sm text-gray-700 hover:text-gray-900 font-medium">Panel Pemohon</a>
                        @else
                            <a href="/applicant/login" class="text-sm text-gray-700 hover:text-gray-900 font-medium">Login Pemohon</a>
                        @endauth
                        <a href="/admin" class="text-sm bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700 transition font-medium">Admin</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-grow">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white mt-12 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <x-heroicon-s-building-library class="w-8 h-8 text-primary-400" />
                        <span class="font-bold text-xl tracking-tight">BPK <span class="text-primary-400">DIY</span></span>
                    </div>
                    <p class="text-gray-400 text-sm">
                        Balai Pelestarian Kebudayaan Wilayah X<br>
                        Daerah Istimewa Yogyakarta dan Jawa Tengah
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Tautan Cepat</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="/" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="/heritage-sites" class="hover:text-white transition">Katalog Situs Cagar Budaya</a></li>
                        <li><a href="/applicant" class="hover:text-white transition">Penggunaan Fasilitas</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li>Jl. Ndalem Jayadipuran No. 13, Yogyakarta</li>
                        <li>Telp: (0274) 373682</li>
                        <li>Email: bpkdiy@kemdikbud.go.id</li>
                    </ul>
                </div>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 pt-8 border-t border-gray-800 text-sm text-center text-gray-500">
                &copy; {{ date('Y') }} Balai Pelestarian Kebudayaan Wilayah X. Hak Cipta Dilindungi.
            </div>
        </footer>

        <!-- Leaflet JS -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        
        @livewireScripts
        @stack('scripts')
    </body>
</html>
